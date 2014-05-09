<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure extends CI_Controller {
    //Effective DataBase Switching in a constructor
    public function __construct() {
        parent::__construct();
        
        /*--------- DISABLE CACHE TO PREVENT BACK BUTTON OF BROWSER ---------- */
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        
        $this->load->library('session');
        
        /*If session does not contain username i.e. user is not logged in and router is not login
          then redirect to login page. */ 
        if(!$this->session->userdata('username') && $this->router->method!="login")
        {
            redirect('guest/loginpage');
        }
        /* If institute id is not their in session then set session with posted institute id */
        if(isset($_POST['institute_id']))
        {
            $institute_id = $_POST['institute_id'];
            $this->session->set_userdata('institute_id',$_POST['institute_id']);
        }
        elseif($this->session->userdata('institute_id'))
        {
            $institute_id = $this->session->userdata('institute_id');          
        }
        else {
            if($this->session->userdata('username'))
                $this->logout();
            redirect('guest/loginpage');
        }

        /* Fetch institute host, db, user, pass from CANN database via institute_id*/
        $this->load->database();
        $this->load->model("institutes");
        $institute_data = $this->institutes->institute_info($institute_id);
        /* Switch to particular institute database */
        $params['hostname'] = $institute_data->hostname;
        $params['username'] = $institute_data->dbusername;
        $params['password'] = $institute_data->dbpassword;
        $params['database'] = $institute_data->dbname;
        $params['dbdriver'] = 'mysql';
        $new_db = $this->load->database( $params, TRUE );
        $this->db = $new_db;
        
        /* Get Attendance Type of THE INSTITUTE and set in session */
        $this->load->model('secureAdmin');
        $institute_details = $this->secureAdmin->fetch_institute_details();
        if(isset($institute_details))
            if($institute_details->attendance_type!="")
                $this->session->set_userdata('atttype',$institute_details->attendance_type);
    }
            

    public function login()
    {
        $this->load->model('secureUsers');
        $result = $this->secureUsers->validate_user($_POST['username'],$_POST['password']);
        if(isset($result))
        {
            if($_POST['remember_me']=="yes")
            {
                $this->session->sess_expire_on_close = FALSE;
                $this->session->sess_update(); //Force an update to the session data
            }
            $userInfo = array('id'=>$result->id,'username'=>$result->username,'firstname'=>$result->firstname,'lastname'=>$result->lastname,'type'=>$result->type,'privilege'=>$result->privilege,'bioid'=>$result->bioid,'multilanguage'=>$result->multilanguage,'photourl'=>$result->photourl);
            $this->session->set_userdata($userInfo);

            echo "true";
        }
        else
        {
            echo "false";
        }
    }
    
    public function logout()
    {
        $userInfo = array('id'=>'','username'=>'','firstname'=>'','lastname'=>'','type'=>'','privilege'=>'','bioid'=>'','multilanguage'=>'','photourl'=>'');
        $this->session->unset_userdata($userInfo);
        $this->session->sess_destroy();
        redirect('guest/loginpage');
    }
    /*********************************************************************/
    /************************** PRIVILEGES CHECKER ***********************/
    /*********************************************************************/
    //Check Administrator Level Privilege
    public function is_PRV_admin()
    {
        if($this->session->userdata('privilege')==PRV_ADMIN)
            return true;
    }
    //Check Head Teacher Level Privilege
    public function is_PRV_head_teacher()
    {
        if($this->session->userdata('privilege')==PRV_HEAD_TEACHER)
            return true;
    }
    //Check GFM/Class Teacher Level Privilege
    public function is_PRV_GFM_teacher()
    {
        if($this->session->userdata('privilege')==PRV_GFM_TEACHER)
            return true;
    }
    //Check General/Subject Teacher Level Privilege
    public function is_PRV_GENERAL_teacher()
    {
        if($this->session->userdata('privilege')==PRV_GEN_TEACHER)
            return true;
    }
    /*********************************************************************/
    /*********************** END PRIVILEGES CHECKER **********************/
    /*********************************************************************/
    
    /*********************************************************************/
    /************************ USER TYPE CHECKER  *************************/
    /*********************************************************************/
    public function is_admin()
    {
        if($this->session->userdata('type')==ADMIN_TYPE)
            return true;
    }
    public function is_teacher()
    {
        if($this->session->userdata('type')==TEACHER_TYPE)
            return true;
    }
    public function is_student()
    {
        if($this->session->userdata('type')==STUDENT_TYPE)
            return true;
    }
    public function is_guardian()
    {
        if($this->session->userdata('type')==GUARDIAN_TYPE)
            return true;
    }
    /*********************************************************************/
    /********************** END USER TYPE CHECKER  ***********************/
    /*********************************************************************/
    
    public function index()
    {
        if($this->is_admin())
        {
            $this->load->model('secureAdmin');
            $data['institute_details'] = $this->secureAdmin->fetch_institute_details();
            $this->load->view('institute_setup',$data);
        }
        else
        {
            $this->user_manager();
        }
    }
    
    public function user_manager($mode = null)
    {
        $data['mode'] = $mode;
        $user_id = $this->session->userdata('id');
        $this->load->model('secureUsers');
        $data['user_details'] = $this->secureUsers->get_user_details($user_id);
        $this->load->view('user_manager',$data);
    }
    
    public function update_profile()
    {
        $user_id = $this->session->userdata('id');
        $this->save_profile($user_id,false);
        redirect('secure/user_manager/profile');
    }
    
    public function update_student_profile()
    {
        $user_id = $this->input->post('student_id');
        $this->save_profile($user_id,true);
        redirect('secure/manage_students_profile');
    }
    
    public function save_profile($user_id,$is_this_student)
    {
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $middleName = $this->input->post('middleName');
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $bloodGroup = $this->input->post('bloodGroup');
        $languages = $this->input->post('languages');
        $nationality = $this->input->post('nationality');
        $category = $this->input->post('category');
        $religion = $this->input->post('religion');
        $aboutMe = $this->input->post('aboutMe');
        $photo = "";
        
        $alphabet = lcfirst($firstName[0]);
        switch($alphabet)
        {
            case 'a':
                $dir = "a".rand(1,6);
                break;
            case 'b':
                $dir = "b".rand(1,2);
                break;
            case 'c':
                $dir = "c".rand(1,2);
                break;
            case 'd':
                $dir = "d".rand(1,2);
                break;
            case 'e':
                $dir = "e".rand(1,2);
                break;
            case 'f':
                $dir = "f".rand(1,2);
                break;
            case 'g':
                $dir = "g".rand(1,2);
                break;
            case 'h':
                $dir = "h".rand(1,2);
                break;
            case 'i':
                $dir = "i".rand(1,2);
                break;
            case 'j':
                $dir = "j".rand(1,2);
                break;
            case 'k':
                $dir = "k".rand(1,2);
                break;
            case 'l':
                $dir = "l".rand(1,2);
                break;
            case 'm':
                $dir = "m".rand(1,4);
                break;
            case 'n':
                $dir = "n".rand(1,2);
                break;
            case 'o':
                $dir = "o".rand(1,1);
                break;
            case 'p':
                $dir = "p".rand(1,2);
                break;
            case 'q':
                $dir = "q".rand(1,1);
                break;
            case 'r':
                $dir = "r".rand(1,4);
                break;
            case 's':
                $dir = "s".rand(1,4);
                break;
            case 't':
                $dir = "t".rand(1,1);
                break;
            case 'u':
                $dir = "u".rand(1,1);
                break;
            case 'v':
                $dir = "v".rand(1,1);
                break;
            case 'w':
                $dir = "w".rand(1,1);
                break;
            case 'x':
                $dir = "x".rand(1,1);
                break;
            case 'y':
                $dir = "y".rand(1,1);
                break;
            case 'z':
                $dir = "z".rand(1,1);
                break;
        }
        $this->load->helper('form');
        
        $config['upload_path'] = './uploads/profiles/'.$dir;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']	= '2048';
        $config['overwrite'] = false;
	$config['remove_spaces'] = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
                $error = array('error' => $this->upload->display_errors());
                if($error['error']=="<p>You did not select a file to upload.</p>")
                    $error['error'] = "";
                else
                {
                    $this->session->set_flashdata('upload_error1',$error['error']);
                }
        }
        else
        {
            //Image Resizing
		$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 180;
                $config['height'] = 180;
                
		$this->load->library('image_lib', $config);

		if ( ! $this->image_lib->resize()){
			$this->session->set_flashdata('upload_error2', $this->image_lib->display_errors());
		}
                else
                {
                    $photo = "/".$dir."/".$this->upload->file_name;
                    $this->session->set_flashdata('upload_success',"Information Saved!");
                }
                //$data = array('upload_data' => $this->upload->data());
        }
        if($photo=="")
            $this->session->set_flashdata('upload_success',"Information Saved!");
        $this->load->model('secureUsers');
        
        $this->secureUsers->set_user_details($user_id,$firstName,$lastName,$middleName,$dob,$gender,$email,$phone,$address,$bloodGroup,$languages,$nationality,$category,$religion,$aboutMe,$photo,$is_this_student);
    }
    
    public function institute_setup()
    {
        if($this->is_admin())
        {
            $this->session->set_userdata('selected_menu','institute_setup');
            $this->load->model('secureAdmin');
            $data['institute_details'] = $this->secureAdmin->fetch_institute_details();
            $this->load->view('institute_setup',$data);
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }
    
    public function updateInstituteDetails()
    {
        if($this->is_admin())
        {
            $this->load->model('secureAdmin');
            if($_POST['atttype']!="")
                $this->session->set_userdata('atttype',$_POST['atttype']);
            if($this->secureAdmin->save_institute_details($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['address'],$_POST['atttype']))
                echo "all_good";
            else
                echo "Please contact support team to change attendance type";
        }
        else
        {
            redirect('secure');
        }
    }
    
    public function update_account()
    {
        $currUsername = $this->input->post('currUsername');
        $currPassword = $this->input->post('currPassword');
        $multilanguage = $this->input->post('multilanguage');
        
        if($this->input->post('newUsername'))
            $newUsername = $this->input->post('newUsername');
        else
            $newUsername = null;
        
        if($this->input->post('newPassword'))
            $newPassword = $this->input->post('newPassword');
        else
            $newPassword = null;
        
        $this->load->model('secureUsers');
        $user_id = $this->session->userdata('id');
        if($this->secureUsers->update_account($user_id,$currUsername,$currPassword,$multilanguage,$newUsername,$newPassword))
        {
            echo "all_good";
        }
        else
        {
            echo "Your Username or Password did not match our records";
        }
    }
    
    public function view_departments()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','view_departments');
            $this->load->model('secureAdmin');
            $data['departments'] = $this->secureAdmin->get_departments();
            if(isset($data['departments']))
            {
                if($this->input->post('thisdeptid'))
                {
                    $data['thisdeptid'] = $this->input->post('thisdeptid');
                    $data['department_classes'] = $this->secureAdmin->get_department_classes($this->input->post('thisdeptid'));
                    $data['department_teachers'] = $this->secureAdmin->get_department_teachers($this->input->post('thisdeptid'));
                }
                else
                {
                    $data['thisdeptid'] = $data['departments'][0]['id'];
                    $data['department_classes'] = $this->secureAdmin->get_department_classes($data['departments'][0]['id']);
                    $data['department_teachers'] = $this->secureAdmin->get_department_teachers($data['departments'][0]['id']);
                }
            }

            $this->load->view('view_departments',$data);
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }
    
    public function create_department()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','create_department');
            $this->load->model('secureUsers');
            $data['classes'] = $this->secureUsers->get_classes();
            $data['teachers'] = $this->secureUsers->get_teachers();
             $this->load->view('create_department',$data);
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }
    
    public function add_department()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','create_department');
            $deptname = $this->input->post('deptname');
            $multi_classes = $this->input->post('multi_classes');
            $multi_teachers = $this->input->post('multi_teachers');
            $this->load->model('secureAdmin');
            $data = $this->secureAdmin->add_department($deptname,$multi_classes,$multi_teachers);
            if($data=="all_good")
            {
                $this->session->set_flashdata('success_msg','Department Successfully Created');
            }
            else
            {
                $this->session->set_flashdata('error_msg',$data);
            }
            redirect('secure/create_department');
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }
    public function update_department()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','update_department');
             $this->load->model('secureAdmin');
             $this->load->model('secureUsers');
            $data['departments'] = $this->secureAdmin->get_departments();
            if(isset($data['departments']))
            {
                    $data['thisdeptid'] = $data['departments'][0]['id'];
                    $data['classes'] = $this->secureUsers->get_classes();
                    $data['teachers'] = $this->secureUsers->get_teachers();
                    $data['department_classes'] = $this->secureAdmin->get_department_classes($data['departments'][0]['id']);
                    $data['department_teachers'] = $this->secureAdmin->get_department_teachers($data['departments'][0]['id']);
            }
            $this->load->view('update_department',$data);
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }

    public function edit_department()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','update_department');
            $thisdeptid = $this->input->post('thisdeptid');
            $multi_classes = $this->input->post('multi_classes');
            $multi_teachers = $this->input->post('multi_teachers');
            $this->load->model('secureAdmin');
            $data = $this->secureAdmin->update_department($thisdeptid,$multi_classes,$multi_teachers);
            if($data=="all_good")
            {
                $this->session->set_flashdata('success_msg','Department Successfully Updated');
            }
            else
            {
                $this->session->set_flashdata('error_msg',$data);
            }
            redirect('secure/update_department');
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }

    public function monitor_inouttime()
    {
        $this->session->set_userdata('selected_menu','monitor_inouttime');
        $this->load->model('secureUsers');
        $data['classes'] = $this->secureUsers->get_classes();
        if(isset($data['classes']))
            {
                if($this->input->post('thisclasscode'))
                {
                    $data['thisdate'] = date_create($this->input->post('thisdate'));
                    $data['thisdate'] = date_format($data['thisdate'],'Y-m-d');
                    $data['thisclasscode'] = $this->input->post('thisclasscode');
                    $data['students_inouttime_details'] = $this->secureUsers->get_students_inouttime_details($this->input->post('thisclasscode'),$data['thisdate']);
                    //var_dump($data);
                }
                else
                {
                    $data['thisdate'] = date("Y-m-d");
                    $data['thisclasscode'] = $data['classes'][0]['class_code'];
                    $data['students_inouttime_details'] = $this->secureUsers->get_students_inouttime_details($data['classes'][0]['class_code'],$data['thisdate']);
                }
            }
            else //When there is no class in database
            {
                $data['thisdate'] = date("Y-m-d");
            }
        $this->load->view('monitor_inouttime',$data);
    }
    
    public function get_students_ofa_class()
    {
        $this->load->model('secureUsers');
        
        echo json_encode($this->secureUsers->get_students_ofa_class($this->input->post('class_code')));
    }
    
    public function intime_stats()
    {
        $this->session->set_userdata('selected_menu','intime_stats');
        $this->load->model('secureUsers');
        $data['classes'] = $this->secureUsers->get_classes();
        if(isset($data['classes']))
        {
            $data['thisclasscode'] = $data['classes'][0]['class_code'];
            $data['students'] = $this->secureUsers->get_students_ofa_class($data['classes'][0]['class_code']);
        }
        $this->load->view('intime_stats',$data);
    }
    
    public function get_intime_ofa_student()
    {
        $this->load->model('secureUsers');
        echo json_encode($this->secureUsers->get_intime_ofa_student($this->input->post('class_code'),$this->input->post('bio_id'),$this->input->post('date_from'),$this->input->post('date_to')));
    }
    
    public function outtime_stats()
    {
        $this->session->set_userdata('selected_menu','outtime_stats');
        $this->load->model('secureUsers');
        $data['classes'] = $this->secureUsers->get_classes();
        if(isset($data['classes']))
        {
            $data['thisclasscode'] = $data['classes'][0]['class_code'];
            $data['students'] = $this->secureUsers->get_students_ofa_class($data['classes'][0]['class_code']);
        }
        $this->load->view('outtime_stats',$data);
    }
    
    public function get_outtime_ofa_student()
    {
        $this->load->model('secureUsers');
        echo json_encode($this->secureUsers->get_outtime_ofa_student($this->input->post('class_code'),$this->input->post('bio_id'),$this->input->post('date_from'),$this->input->post('date_to')));
    }
    
    public function manage_students_profile()
    {
        $this->session->set_userdata('selected_menu','my_childs_profile');
        if($this->is_guardian())
        {
            $student_bioid = $this->session->userdata('bioid');
        }
        $this->load->model('secureUsers');
        $data['student_details'] = $this->secureUsers->get_student_details($student_bioid);
        $this->load->view('student_profile',$data);
    }
            
    
}