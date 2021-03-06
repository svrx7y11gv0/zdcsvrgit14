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
        //Set $cookie_data as null: Used for "stay signed in feature"
        $cookie_data = null;
        if(!$this->session->userdata('username') && $this->router->method!="login")
        {
            if($this->input->cookie('remember_me_token_eb'))
            {
                 $cookie_data = explode(":",$this->input->cookie('remember_me_token_eb'));
                 $this->session->set_userdata('institute_id',$cookie_data[0]);
            }
            else
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

        // Fetch institute host, db, user, pass from CANN database via institute_id //
        $this->load->database();
        $this->load->model("institutes");
        $institute_data = $this->institutes->institute_info($institute_id);
        // Switch to particular institute database //
        $params['hostname'] = $institute_data->hostname;
        $params['username'] = $institute_data->dbusername;
        $params['password'] = $institute_data->dbpassword;
        $params['database'] = $institute_data->dbname;
        $params['dbdriver'] = 'mysql';
        $new_db = $this->load->database( $params, TRUE );
        $this->db = $new_db;
        
        // Get Attendance Type of THE INSTITUTE and set in session //
        $this->load->model('secureadmin');
        $institute_details = $this->secureadmin->fetch_institute_details();
        if(isset($institute_details))
            if($institute_details->attendance_type!="")
                $this->session->set_userdata('atttype',$institute_details->attendance_type);
            
        //If user had checked stay signed in then cookie containg institute_id and username
        // is stored as present in login function, next time if user opens browser, the cookie
        // is checked and cookie data is set as above. So if cookie data is not null then get
        // all userdata and create user session.
        $this->load->model('secureusers');
        if($cookie_data!=null)
        {
            $result = $this->secureusers->validate_username($cookie_data[1]);
            if(isset($result))
            {
                $userInfo = array('id'=>$result->id,'username'=>$result->username,'firstname'=>$result->firstname,'lastname'=>$result->lastname,'type'=>$result->type,'privilege'=>$result->privilege,'bioid'=>$result->bioid,'multilanguage'=>$result->multilanguage,'photourl'=>$result->photourl);
                $this->session->set_userdata($userInfo);
                $this->session->set_userdata('notifications_count',$this->secureusers->get_unread_notifications_count());
            }
        }
    }
            

    public function login()
    {
        $this->load->model('secureusers');
        $result = $this->secureusers->validate_user($_POST['username'],$_POST['password']);
        if(isset($result))
        {
            if($_POST['remember_me']=="yes")
            {
                $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                $cookie = array(
                    'name'   => 'remember_me_token_eb',
                    'value'  => $this->session->userdata('institute_id').":".$_POST['username'],
                    'expire' => '1209600',  // Two weeks
                    'domain' => $domain,
                    'path'   => '/'
                );

                $this->input->set_cookie($cookie);
            }
            $userInfo = array('id'=>$result->id,'username'=>$result->username,'firstname'=>$result->firstname,'lastname'=>$result->lastname,'type'=>$result->type,'privilege'=>$result->privilege,'bioid'=>$result->bioid,'multilanguage'=>$result->multilanguage,'photourl'=>$result->photourl);
            $this->session->set_userdata($userInfo);
            $this->session->set_userdata('notifications_count',$this->secureusers->get_unread_notifications_count());
            echo "true";
        }
        else
        {
            echo "false";
        }
    }
    
    public function logout()
    {
        delete_cookie("remember_me_token_eb");
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
            if(!$this->session->userdata('atttype'))
            {
                $this->load->model('secureadmin');
                $data['institute_details'] = $this->secureadmin->fetch_institute_details();
                $this->load->view('institute_setup',$data);
            }
            else
                $this->admin_dashboard();
        }
        else
        {
            $this->user_manager();
        }
    }
    
    public function user_manager($mode = null)
    {
        $this->session->set_userdata('selected_menu','');
        $data['mode'] = $mode;
        $user_id = $this->session->userdata('id');
        $this->load->model('secureusers');
        $data['user_details'] = $this->secureusers->get_user_details($user_id);
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
        $this->load->model('secureusers');
        
        $this->secureusers->set_user_details($user_id,$firstName,$lastName,$middleName,$dob,$gender,$email,$phone,$address,$bloodGroup,$languages,$nationality,$category,$religion,$aboutMe,$photo,$is_this_student);
    }
    
    public function institute_setup()
    {
        if($this->is_admin())
        {
            $this->session->set_userdata('selected_menu','institute_setup');
            $this->load->model('secureadmin');
            $data['institute_details'] = $this->secureadmin->fetch_institute_details();
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
            $this->load->model('secureadmin');
            if($_POST['atttype']!="")
                $this->session->set_userdata('atttype',$_POST['atttype']);
            if($this->secureadmin->save_institute_details($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['address'],$_POST['atttype']))
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
        
        $this->load->model('secureusers');
        $user_id = $this->session->userdata('id');
        if($this->secureusers->update_account($user_id,$currUsername,$currPassword,$multilanguage,$newUsername,$newPassword))
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
            $this->load->model('secureadmin');
            $data['departments'] = $this->secureadmin->get_departments();
            if(isset($data['departments']))
            {
                if($this->input->post('thisdeptid'))
                {
                    $data['thisdeptid'] = $this->input->post('thisdeptid');
                    $data['department_classes'] = $this->secureadmin->get_department_classes($this->input->post('thisdeptid'));
                    $data['department_teachers'] = $this->secureadmin->get_department_teachers($this->input->post('thisdeptid'));
                }
                else
                {
                    $data['thisdeptid'] = $data['departments'][0]['id'];
                    $data['department_classes'] = $this->secureadmin->get_department_classes($data['departments'][0]['id']);
                    $data['department_teachers'] = $this->secureadmin->get_department_teachers($data['departments'][0]['id']);
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
            $this->load->model('secureusers');
            $data['classes'] = $this->secureusers->get_classes();
            $data['teachers'] = $this->secureusers->get_teachers();
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
            $dept_head_bioid = $this->input->post('dept_head');
            $multi_teachers = $this->input->post('multi_teachers');
            $this->load->model('secureadmin');
            $data = $this->secureadmin->add_department($deptname,$multi_classes,$multi_teachers,$dept_head_bioid);
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
    public function update_department($thisdeptid=null)
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','update_department');
             $this->load->model('secureadmin');
             $this->load->model('secureusers');
            $data['departments'] = $this->secureadmin->get_departments();
            if(isset($data['departments']))
            {
                if($thisdeptid==null)
                {
                    $data['thisdeptid'] = $data['departments'][0]['id'];
                    $data['department_classes'] = $this->secureadmin->get_department_classes($data['departments'][0]['id']);
                    $data['department_teachers'] = $this->secureadmin->get_department_teachers($data['departments'][0]['id']);
                }
                else
                {
                    $data['thisdeptid'] = $thisdeptid;
                    $data['department_classes'] = $this->secureadmin->get_department_classes($thisdeptid);
                    $data['department_teachers'] = $this->secureadmin->get_department_teachers($thisdeptid);
                }
                $data['classes'] = $this->secureusers->get_classes();
                $data['teachers'] = $this->secureusers->get_teachers();
            }
            $this->load->view('update_department',$data);
        }
        else
        {
            $this->session->set_userdata('selected_menu','');
            redirect('secure');
        }
    }
    
    public function get_dept_classes()
    {
        echo json_encode($this->secureadmin->get_department_classes($this->input->post('deptid')));
    }
    
    public function get_dept_teachers()
    {
        echo json_encode($this->secureadmin->get_department_teachers($this->input->post('deptid')));
    }

    public function edit_department()
    {
        if($this->is_PRV_admin())
        {
            $this->session->set_userdata('selected_menu','update_department');
            $thisdeptid = $this->input->post('thisdeptid');
            $multi_classes = $this->input->post('multi_classes');
            $dept_head_bioid = $this->input->post('dept_head');
            $multi_teachers = $this->input->post('multi_teachers');
            $this->load->model('secureadmin');
            $data = $this->secureadmin->update_department($thisdeptid,$multi_classes,$multi_teachers,$dept_head_bioid);
            if($data=="all_good")
            {
                $this->session->set_flashdata('success_msg','Department Successfully Updated');
            }
            else
            {
                $this->session->set_flashdata('error_msg',$data);
            }
            redirect('secure/update_department/'.$thisdeptid);
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
        $this->load->model('secureadmin');  //For getting departments 
        $this->load->model('secureusers');  //For getting classes
        
        $data = $this->get_departments_and_classes();
        
        if(isset($data['classes']))
        {
            if($this->input->post('thisclasscode'))
            {
                $data['thisdate'] = date_create($this->input->post('thisdate'));
                $data['thisdate'] = date_format($data['thisdate'],'Y-m-d');
                $data['thisclasscode'] = $this->input->post('thisclasscode');
                $data['students_inouttime_details'] = $this->secureusers->get_students_inouttime_details($this->input->post('thisclasscode'),$data['thisdate']);
            }
            else
            {
                $data['thisdate'] = date("Y-m-d");
                $data['thisclasscode'] = $data['classes'][0]['class_code'];
                $data['students_inouttime_details'] = $this->secureusers->get_students_inouttime_details($data['classes'][0]['class_code'],$data['thisdate']);
            }
        }
        else //When there is no class in database
        {
            $data['thisdate'] = date("Y-m-d");
        }
        //var_dump($data);
        $this->load->view('monitor_inouttime',$data);
    }
    
    public function get_selective_classes()
    {
        $this->load->model('secureusers');  //For getting classes
        $this->load->model('secureadmin');  //For getting departments 
        if($this->input->post('deptid')=="others")
        {
            if($this->is_PRV_admin()) //If the user is admin get all non department classes
                echo json_encode($this->secureadmin->get_non_department_classes());
            else
                echo json_encode($this->secureusers->get_selective_non_dept_classes($this->session->userdata('bioid')));
        }
        else
        {
            if($this->is_PRV_admin()) //If the user is admin get all classes
                echo json_encode($this->secureadmin->get_department_classes($this->input->post('deptid')));
            else if($this->secureusers->is_hod_of_dept($this->input->post('deptid'),$this->session->userdata('bioid')))
                echo json_encode($this->secureadmin->get_department_classes($this->input->post('deptid')));
            else
                echo json_encode($this->secureusers->get_selective_dept_classes($this->input->post('deptid'),$this->session->userdata('bioid')));
        }
    }
    
    public function get_students_ofa_class()
    {
        $this->load->model('secureusers');
        echo json_encode($this->secureusers->get_students_ofa_class($this->input->post('class_code')));
    }
    
    public function get_departments_and_classes()
    {
        if($this->is_PRV_admin())   //If the user is admin
            $data['departments'] = $this->secureadmin->get_departments();
        else //If the user is a teacher and not admin
        {
            $data['departments'] = $this->secureusers->get_selective_departments($this->session->userdata('bioid'));
        }
        
        if(isset($data['departments']))
        {
            if($this->input->post('thisdeptid') && $this->input->post('thisdeptid')!="others")
            {
                    $data['thisdeptid'] = $this->input->post('thisdeptid');
                    if($this->is_PRV_admin()) //If the user is admin get all classes
                        $data['classes'] = $this->secureadmin->get_department_classes($this->input->post('thisdeptid'));
                    else if($this->secureusers->is_hod_of_dept($this->input->post('thisdeptid'),$this->session->userdata('bioid')))
                        $data['classes'] = $this->secureadmin->get_department_classes($this->input->post('thisdeptid'));
                    else
                        $data['classes'] = $this->secureusers->get_selective_dept_classes($this->input->post('thisdeptid'),$this->session->userdata('bioid'));
            }
            else if($this->input->post('thisdeptid') && $this->input->post('thisdeptid')=="others")
            {
                $data['thisdeptid'] = $this->input->post('thisdeptid');
                if($this->is_PRV_admin()) //If the user is admin get all non department classes
                    $data['classes'] = $this->secureadmin->get_non_department_classes();
                else
                    $data['classes'] = $this->secureusers->get_selective_non_dept_classes($this->session->userdata('bioid'));
            }
            else
            {
                $data['thisdeptid'] = $data['departments'][0]['id'];
                if($this->is_PRV_admin()) //If the user is admin get all classes
                    $data['classes'] = $this->secureadmin->get_department_classes($data['departments'][0]['id']);
                else if($this->secureusers->is_hod_of_dept($data['departments'][0]['id'],$this->session->userdata('bioid')))
                    $data['classes'] = $this->secureadmin->get_department_classes($data['departments'][0]['id']);
                else
                    $data['classes'] = $this->secureusers->get_selective_dept_classes($data['departments'][0]['id'],$this->session->userdata('bioid'));
            }
        }
        else
        {
            $data['thisdeptid'] = "others";
            if($this->is_PRV_admin()) //If the user is admin get all non department classes
                $data['classes'] = $this->secureadmin->get_non_department_classes();
            else
                $data['classes'] = $this->secureusers->get_selective_non_dept_classes($this->session->userdata('bioid'));
        }
        return $data;
    }
    public function intime_stats()
    {
        $this->session->set_userdata('selected_menu','intime_stats');
        $this->load->model('secureusers');  //For getting classes
        $this->load->model('secureadmin');  //For getting departments 
        
        $data = $this->get_departments_and_classes();
        
        if(isset($data['classes']))
        {
            $data['thisclasscode'] = $data['classes'][0]['class_code'];
            $data['students'] = $this->secureusers->get_students_ofa_class($data['classes'][0]['class_code']);
        }
        $this->load->view('intime_stats',$data);
    }
        
    public function outtime_stats()
    {
        $this->session->set_userdata('selected_menu','outtime_stats');
        $this->load->model('secureusers');
        $this->load->model('secureadmin');  //For getting departments 
        
        $data = $this->get_departments_and_classes();
        
        if(isset($data['classes']))
        {
            $data['thisclasscode'] = $data['classes'][0]['class_code'];
            $data['students'] = $this->secureusers->get_students_ofa_class($data['classes'][0]['class_code']);
        }
        $this->load->view('outtime_stats',$data);
    }
    
    public function get_intime_ofa_student()
    {
        $this->load->model('secureusers');
        echo json_encode($this->secureusers->get_intime_ofa_student($this->input->post('class_code'),$this->input->post('bio_id'),$this->input->post('date_from'),$this->input->post('date_to')));
    }
    
    public function get_outtime_ofa_student()
    {
        $this->load->model('secureusers');
        echo json_encode($this->secureusers->get_outtime_ofa_student($this->input->post('class_code'),$this->input->post('bio_id'),$this->input->post('date_from'),$this->input->post('date_to')));
    }
    
    public function manage_students_profile()
    {
        $this->session->set_userdata('selected_menu','my_childs_profile');
        if($this->is_guardian())
        {
            $student_bioid = $this->session->userdata('bioid');
        }
        $this->load->model('secureusers');
        $data['student_details'] = $this->secureusers->get_student_details($student_bioid);
        $this->load->view('student_profile',$data);
    }
    
    public function get_subjects_ofa_class()
    {
        $this->load->model('secureusers');
        echo json_encode($this->secureusers->get_subjects_ofa_class($this->input->post('class_code')));
    }
            
    public function manage_classes()
    {
        $this->session->set_userdata('selected_menu','manage_classes');
        $this->load->model('secureadmin');  //For getting departments 
        $this->load->model('secureusers');  //For getting classes
        
        $data = $this->get_departments_and_classes();
        
        if(isset($data['classes']))
        {
            if($this->input->post('thisclasscode'))
            {
                $data['date_from'] = $this->input->post('year')."-".$this->input->post('month')."-01";
                $data['date_to'] = $this->input->post('year')."-".$this->input->post('month')."-31";
                $data['students'] = $this->secureusers->get_students_ofa_class($this->input->post('thisclasscode'));
                if($this->session->userdata('atttype')=="inout")
                {
                    $data['inout_att_records'] = $this->secureusers->get_inout_att_records($this->input->post('thisclasscode'),$data['date_from'],$data['date_to']);
                }
                elseif($this->session->userdata('atttype')=="lecturewise")
                {
                    if($this->is_PRV_admin() || $this->is_PRV_GFM_teacher() || $this->is_PRV_head_teacher()) //If the user is admin, GFM or head get all subjects of the class
                        $data['subjects_of_this_class'] = $this->secureusers->get_all_subjects_of_this_class($this->input->post('thisclasscode'));
                    elseif($this->is_PRV_GENERAL_teacher())
                        $data['subjects_of_this_class'] = $this->secureusers->get_selective_subjects_of_this_class($this->input->post('thisclasscode'));
                    $data['thissubject'] = $this->input->post('thissubject');
                    if(isset($data['thissubject']))
                    {
                        $data['subj_att_records'] = $this->secureusers->get_subj_att_records($this->input->post('thisclasscode'),$data['thissubject'],$data['date_from'],$data['date_to']);
                    }
                }
                $data['thisclasscode'] = $this->input->post('thisclasscode');
                $data['thismonth'] = $this->input->post('month');
                $data['thisyear'] = $this->input->post('year');
            }
            else
            {
                $data['date_from'] = date('Y')."-".date('m')."-01";
                $data['date_to'] = date('Y')."-".date('m')."-31";
                $data['students'] = $this->secureusers->get_students_ofa_class($data['classes'][0]['class_code']);
                if($this->session->userdata('atttype')=="inout")
                {
                    $data['inout_att_records'] = $this->secureusers->get_inout_att_records($data['classes'][0]['class_code'],$data['date_from'],$data['date_to']);
                }
                elseif($this->session->userdata('atttype')=="lecturewise")
                {
                    if($this->is_PRV_admin() || $this->is_PRV_GFM_teacher() || $this->is_PRV_head_teacher()) //If the user is admin, GFM or head get all subjects of the class
                        $data['subjects_of_this_class'] = $this->secureusers->get_all_subjects_of_this_class($data['classes'][0]['class_code']);
                    elseif($this->is_PRV_GENERAL_teacher())
                        $data['subjects_of_this_class'] = $this->secureusers->get_selective_subjects_of_this_class($data['classes'][0]['class_code']);
                    if(isset($data['subjects_of_this_class']))
                    {
                        $data['thissubject'] = $data['subjects_of_this_class'][0]['subject'];
                        $data['subj_att_records'] = $this->secureusers->get_subj_att_records($data['classes'][0]['class_code'],$data['subjects_of_this_class'][0]['subject'],$data['date_from'],$data['date_to']);
                    }
                }
                $data['thisclasscode'] = $data['classes'][0]['class_code'];
                $data['thismonth'] = date('m');
                $data['thisyear'] = date('Y');
            }
        }
        //var_dump($data);
        $this->load->view('manage_classes',$data);
        
    }
    
    public function faq()
    {
        $this->session->set_userdata('selected_menu','faq');
        $this->load->view('faq');
    }
    
    public function dashboard()
    {
        $this->session->set_userdata('selected_menu','dashboard');
        if($this->is_admin() || $this->is_PRV_head_teacher())
            $this->admin_dashboard();
        if($this->is_PRV_GFM_teacher() || $this->is_PRV_GENERAL_teacher())
            $this->teacher_dashboard();
        if($this->is_student() || $this->is_guardian())
            $this->student_dashboard();
    }
    
    public function admin_dashboard()
    {
        $this->load->model('secureadmin');
        $this->load->model('secureusers');  //For getting classes
        
        $data = $this->get_departments_and_classes();
        
        $data['total_students'] = $this->secureadmin->get_total_nof_students();
        $data['todays_present_students'] = $this->secureadmin->get_todays_all_present_students();
        $data['total_teachers'] = $this->secureadmin->get_total_nof_teachers();
        $data['gauge_data'] = $this->secureadmin->get_gauge_data($data['classes']);
        $this->load->view('admin_dashboard',$data);
        //var_dump($data);
    }
    
    public function teacher_dashboard()
    {
        $this->load->model('secureusers');  //For getting classes
        
        $data = $this->get_departments_and_classes();
        
        $data['gauge_data'] = $this->secureusers->get_gauge_teacher_dashboard($data['classes']);
        //var_dump($data);
        $this->load->view('teacher_dashboard',$data);
    }
    
    public function mark_attendance()
    {
        $this->load->model('secureadmin');
        if($this->session->userdata('atttype')=="inout")
            $this->secureadmin->mark_inout_attendance($this->input->post('bio_id'),$this->input->post('date'),$this->input->post('in_time'),$this->input->post('out_time'),$this->input->post('class_code'));
        elseif($this->session->userdata('atttype')=="lecturewise")
            $this->secureadmin->mark_lecturewise_attendance($this->input->post('bio_id'),$this->input->post('date'),$this->input->post('time'),$this->input->post('att_slot'),$this->input->post('class_code'),$this->input->post('subject'));
    }
    
    public function assign_rollnos()
    {
        $this->load->model('secureadmin');
        $this->secureadmin->assign_rollnos($this->input->post('class_code'));
    }
    
    public function generate_lec_att_report($class_code,$subject,$date_from,$date_to)
    {
        $dateTime = new DateTime($date_from);
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');
        $this->load->model('secureusers');
        $students = $this->secureusers->get_students_ofa_class($class_code);
        $subject = str_replace('%20', ' ', $subject);
        
        $total_no_classes = $this->secureusers->get_total_no_classes($class_code,$subject,$date_from,$date_to);
        
        $table = "<table style='border: 1px solid black;'><thead>";
        $table .= "<tr style='border: 1px solid black;'><th></th>";
        for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
        {
            $timestamp = strtotime($year."-".$month."-".$i);
            $table .= "<th style='text-align:center;'><h5 style='margin: 5px 0 5px 0;'><strong>".date('D',$timestamp)."</strong></h5><h5 style='margin: 10px 0 10px 0;'>".$i."</h5></th>";
        }
        $table .= "<th style='text-align:center;'><h5><strong>Total</strong></h5></th>";
        $table .= "<th style='text-align:center;'><h5><strong>Attended</strong></h5></th>";
        $table .= "<th style='text-align:center;'><h5><strong>Percentage</strong></h5></th>";
        $table .= "</tr></thead><tbody>";
        foreach($students as $student)
        {
            $table .= "<tr style='border: 1px solid black;'>";
            $table .= "<td>".$student['firstname']." ".$student['lastname']."</td>";
            $his_or_her_attcount = 0;
            for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
            {
                $day = sprintf("%02s", $i);
                $thisdate = $year."-".$month."-".$day;
                $subj_att_records = $this->secureusers->get_this_subj_date_bioid_att($class_code,$subject,$thisdate,$student['bioid']);
                if(count($subj_att_records)>0)
                {
                    $table .= "<td style='border: 1px solid black;'>";
                    foreach($subj_att_records as $record)
                    {
                        $his_or_her_attcount++;
                        $time = "<h6 style='margin: 10px 0 10px 0;'><span style='color:#942170;font-weight:600;'>".substr($record['time'],0,5)."</span></h6>";
                        
                        if($record['slot']=="0")
                            $slot="";
                        else
                            $slot = "<h6 style='margin: 10px 0 10px 0;'><strong>Slot </strong><span style='color:#942170;font-weight:600;'>".$record['slot']."</span></h6>"; 
                        
                        $table .= $time.$slot;
                    }
                    $table .= "</td>";
                }
                else
                    $table .= "<td style='border: 1px solid black;'></td>";
            }
            $table .= "<td>".$total_no_classes['count']."</td>";
            $table .= "<td>".$his_or_her_attcount."</td>";
            if($total_no_classes['count'] == 0)
                $table .= "<td>-</td>";
            else
                $table .= "<td>".(($his_or_her_attcount/$total_no_classes['count'])*100)."%</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody></table>";
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML("<h3><strong>Class : </strong>".$class_code."<strong> Subject : </strong>".$subject."</h3>");
        $this->mpdf->WriteHTML("<span style='float:left;'>Month & Year: <strong>".$dateTime->format('M').$dateTime->format('Y')."</strong></span>");
        $this->mpdf->WriteHTML($table);
        $this->mpdf->Output();
    }
    
    public function generate_lec_att_report_forall($month,$year)
    {
        $this->load->library('mpdf');
        $date_from = $year."-".$month."-01";
        $date_to = $year."-".$month."-31";
        $dateTime = new DateTime($date_from);
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');
        $this->load->model('secureadmin');  //For getting departments 
        $this->load->model('secureusers');  //For getting classes
        
        if($this->is_PRV_admin())   //If the user is admin
            $departments = $this->secureadmin->get_departments();
        else //If the user is a teacher and not admin
        {
            $departments = $this->secureusers->get_selective_departments($this->session->userdata('bioid'));
        }
        
        if(isset($departments))
        {
            foreach($departments as $department)
            {
                if($this->is_PRV_admin()) //If the user is admin get all classes
                    $classes = $this->secureadmin->get_department_classes($department['id']);
                else if($this->secureusers->is_hod_of_dept($department['id'],$this->session->userdata('bioid')))
                    $classes = $this->secureadmin->get_department_classes($department['id']);
                else
                    $classes = $this->secureusers->get_selective_dept_classes($department['id'],$this->session->userdata('bioid'));
                if(isset($classes))
                {
                    foreach($classes as $class)
                    {
                        $students = $this->secureusers->get_students_ofa_class($class['class_code']);
                        if($this->session->userdata('atttype')=="lecturewise")
                        {
                            if($this->is_PRV_admin() || $this->is_PRV_GFM_teacher() || $this->is_PRV_head_teacher()) //If the user is admin, GFM or head get all subjects of the class
                                $subjects_of_this_class = $this->secureusers->get_all_subjects_of_this_class($class['class_code']);
                            elseif($this->is_PRV_GENERAL_teacher())
                                $subjects_of_this_class = $this->secureusers->get_selective_subjects_of_this_class($class['class_code']);
                            if(isset($subjects_of_this_class))
                            {
                                foreach($subjects_of_this_class as $subject)
                                {
                                    $total_no_classes = $this->secureusers->get_total_no_classes($class['class_code'],$subject['subject'],$date_from,$date_to);
        
                                    $table = "<table style='border: 1px solid black;'><thead>";
                                    $table .= "<tr style='border: 1px solid black;'><th></th>";
                                    for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
                                    {
                                        $timestamp = strtotime($year."-".$month."-".$i);
                                        $table .= "<th style='text-align:center;'><h5 style='margin: 5px 0 5px 0;'><strong>".date('D',$timestamp)."</strong></h5><h5 style='margin: 10px 0 10px 0;'>".$i."</h5></th>";
                                    }
                                    $table .= "<th style='text-align:center;'><h5><strong>Total</strong></h5></th>";
                                    $table .= "<th style='text-align:center;'><h5><strong>Attended</strong></h5></th>";
                                    $table .= "<th style='text-align:center;'><h5><strong>Percentage</strong></h5></th>";
                                    $table .= "</tr></thead><tbody>";
                                    foreach($students as $student)
                                    {
                                        $table .= "<tr style='border: 1px solid black;'>";
                                        $table .= "<td>".$student['firstname']." ".$student['lastname']."</td>";
                                        $his_or_her_attcount = 0;
                                        for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
                                        {
                                            $day = sprintf("%02s", $i);
                                            $thisdate = $year."-".$month."-".$day;
                                            $subj_att_records = $this->secureusers->get_this_subj_date_bioid_att($class['class_code'],$subject['subject'],$thisdate,$student['bioid']);
                                            if(count($subj_att_records)>0)
                                            {
                                                $table .= "<td style='border: 1px solid black;'>";
                                                foreach($subj_att_records as $record)
                                                {
                                                    $his_or_her_attcount++;
                                                    $time = "<h6 style='margin: 10px 0 10px 0;'><span style='color:#942170;font-weight:600;'>".substr($record['time'],0,5)."</span></h6>";

                                                    if($record['slot']=="0")
                                                        $slot="";
                                                    else
                                                        $slot = "<h6 style='margin: 10px 0 10px 0;'><strong>Slot </strong><span style='color:#942170;font-weight:600;'>".$record['slot']."</span></h6>"; 

                                                    $table .= $time.$slot;
                                                }
                                                $table .= "</td>";
                                            }
                                            else
                                                $table .= "<td style='border: 1px solid black;'></td>";
                                        }
                                        $table .= "<td>".$total_no_classes['count']."</td>";
                                        $table .= "<td>".$his_or_her_attcount."</td>";
                                        if($total_no_classes['count'] == 0)
                                            $table .= "<td>-</td>";
                                        else
                                            $table .= "<td>".(($his_or_her_attcount/$total_no_classes['count'])*100)."%</td>";
                                        $table .= "</tr>";
                                    }
                                    $table .= "</tbody></table>";
                                    
                                    $this->mpdf->WriteHTML("<h2><strong>Department : </strong>".$department['department_name']."</strong></h2>");
                                    $this->mpdf->WriteHTML("<h3><strong>Class : </strong>".$class['classname'].$class['section']."<strong> Subject : </strong>".$subject['subject']."</h3>");
                                    $this->mpdf->WriteHTML("<span style='float:left;'>Month & Year: <strong>".$dateTime->format('M').$dateTime->format('Y')."</strong></span>");
                                    $this->mpdf->WriteHTML($table);
                                }
                            }
                        }
                    }
                }
            }
        }
        else
        {
            if($this->is_PRV_admin()) //If the user is admin get all non department classes
                $classes = $this->secureadmin->get_non_department_classes();
            else
                $classes = $this->secureusers->get_selective_non_dept_classes($this->session->userdata('bioid'));
            
            if(isset($classes))
                {
                    foreach($classes as $class)
                    {
                        $students = $this->secureusers->get_students_ofa_class($class['class_code']);
                        if($this->session->userdata('atttype')=="lecturewise")
                        {
                            if($this->is_PRV_admin() || $this->is_PRV_GFM_teacher() || $this->is_PRV_head_teacher()) //If the user is admin, GFM or head get all subjects of the class
                                $subjects_of_this_class = $this->secureusers->get_all_subjects_of_this_class($class['class_code']);
                            elseif($this->is_PRV_GENERAL_teacher())
                                $subjects_of_this_class = $this->secureusers->get_selective_subjects_of_this_class($class['class_code']);
                            if(isset($subjects_of_this_class))
                            {
                                foreach($subjects_of_this_class as $subject)
                                {
                                    $total_no_classes = $this->secureusers->get_total_no_classes($class['class_code'],$subject['subject'],$date_from,$date_to);
        
                                    $table = "<table style='border: 1px solid black;'><thead>";
                                    $table .= "<tr style='border: 1px solid black;'><th></th>";
                                    for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
                                    {
                                        $timestamp = strtotime($year."-".$month."-".$i);
                                        $table .= "<th style='text-align:center;'><h5 style='margin: 5px 0 5px 0;'><strong>".date('D',$timestamp)."</strong></h5><h5 style='margin: 10px 0 10px 0;'>".$i."</h5></th>";
                                    }
                                    $table .= "<th style='text-align:center;'><h5><strong>Total</strong></h5></th>";
                                    $table .= "<th style='text-align:center;'><h5><strong>Attended</strong></h5></th>";
                                    $table .= "<th style='text-align:center;'><h5><strong>Percentage</strong></h5></th>";
                                    $table .= "</tr></thead><tbody>";
                                    foreach($students as $student)
                                    {
                                        $table .= "<tr style='border: 1px solid black;'>";
                                        $table .= "<td>".$student['firstname']." ".$student['lastname']."</td>";
                                        $his_or_her_attcount = 0;
                                        for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++)
                                        {
                                            $day = sprintf("%02s", $i);
                                            $thisdate = $year."-".$month."-".$day;
                                            $subj_att_records = $this->secureusers->get_this_subj_date_bioid_att($class['class_code'],$subject['subject'],$thisdate,$student['bioid']);
                                            if(count($subj_att_records)>0)
                                            {
                                                $table .= "<td style='border: 1px solid black;'>";
                                                foreach($subj_att_records as $record)
                                                {
                                                    $his_or_her_attcount++;
                                                    $time = "<h6 style='margin: 10px 0 10px 0;'><span style='color:#942170;font-weight:600;'>".substr($record['time'],0,5)."</span></h6>";

                                                    if($record['slot']=="0")
                                                        $slot="";
                                                    else
                                                        $slot = "<h6 style='margin: 10px 0 10px 0;'><strong>Slot </strong><span style='color:#942170;font-weight:600;'>".$record['slot']."</span></h6>"; 

                                                    $table .= $time.$slot;
                                                }
                                                $table .= "</td>";
                                            }
                                            else
                                                $table .= "<td style='border: 1px solid black;'></td>";
                                        }
                                        $table .= "<td>".$total_no_classes['count']."</td>";
                                        $table .= "<td>".$his_or_her_attcount."</td>";
                                        if($total_no_classes['count'] == 0)
                                            $table .= "<td>-</td>";
                                        else
                                            $table .= "<td>".(($his_or_her_attcount/$total_no_classes['count'])*100)."%</td>";
                                        $table .= "</tr>";
                                    }
                                    $table .= "</tbody></table>";
                                    
                                    $this->mpdf->WriteHTML("<h2><strong>Department : </strong>".$department['department_name']."</strong></h2>");
                                    $this->mpdf->WriteHTML("<h3><strong>Class : </strong>".$class['classname'].$class['section']."<strong> Subject : </strong>".$subject['subject']."</h3>");
                                    $this->mpdf->WriteHTML("<span style='float:left;'>Month & Year: <strong>".$dateTime->format('M').$dateTime->format('Y')."</strong></span>");
                                    $this->mpdf->WriteHTML($table);
                                }
                            }
                        }
                    }
                }
        }
        
        $this->mpdf->Output();
    }
    
    public function create_quiz()
    {
        $this->session->set_userdata('selected_menu','create_quiz');
        
        $this->load->model('secureadmin');  //For getting departments 
        $this->load->model('secureusers');  //For getting classes
        
        $data = $this->get_departments_and_classes();
        
        $this->load->view('create_quiz',$data);
    }
    
    public function edit_quiz($quiz_id = NULL)
    {
        $this->session->set_userdata('selected_menu','edit_quiz');
        $this->load->model('secureusers');
        
        $data['quizes'] = $this->secureusers->get_created_quizes($this->session->userdata('username')); //Get quizes created by logged in user
        if(! isset($quiz_id) && count($data['quizes'])>0)
        {
            $quiz_id = $data['quizes'][0]['quiz_id'];
        }
        $data['thisquizid'] = $quiz_id;
        $data['quiz_details'] = $this->secureusers->get_quiz_details($quiz_id);
        if(count($data['quizes'])>0)
            $data['quiz_question_numbers'] = $this->secureusers->get_question_numbers($quiz_id);
        $this->load->view('edit_quiz',$data);
    }
    
    public function get_created_quizes()
    {
        $this->load->model('secureusers');
        $data['quiz_details'] = $this->secureusers->get_quiz_details($this->input->post('quiz_id'));
        $data['quiz_question_numbers'] = $this->secureusers->get_question_numbers($this->input->post('quiz_id'));
        echo json_encode($data);
    }
    
    public function update_quiz_db()
    {
        $quiz_id = $this->input->post('quiz_id');
        $quiz_type = $this->input->post('quiz_type');
        $quiz_title = $this->input->post('quiz_title');
        $num_questions = $this->input->post('num_questions');
        $is_timed = $this->input->post('is_timed');
        $time_period = $this->input->post('time_period');
        $is_active = $this->input->post('is_active');
        $this->load->model('secureusers');
        
        $this->secureusers->update_quiz_db($quiz_id,$quiz_type,$quiz_title,$num_questions,$is_timed,$time_period,$is_active);
        
        echo "success";
    }
    
    public function create_quiz_db()
    {
        $multi_classes = $this->input->post('multi_classes');
        $quiz_type = $this->input->post('quiz_type');
        $quiz_title = $this->input->post('quiz_title');
        $num_questions = $this->input->post('num_questions');
        $is_timed = $this->input->post('is_timed');
        $time_period = $this->input->post('time_period');
        $this->load->model('secureusers');
        $this->load->dbforge();
        
        $quiz_id = $this->secureusers->create_quiz_db($multi_classes,$quiz_type,$quiz_title,$num_questions,$is_timed,$time_period);
        
        $this->edit_quiz($quiz_id);
    }
    
    public function submit_question()
    {
        $this->load->model('secureusers');
        $question_id_flag = $this->input->post('question_id_flag');
                
        $this->secureusers->submit_question($_POST['quiz_id'],$question_id_flag,$_POST['question'],$_POST['opt_1'],$_POST['opt_2'],$_POST['opt_3'],$_POST['opt_4'],$_POST['answer'],$_POST['explanation']);
        $this->edit_quiz($_POST['quiz_id']);
    }
    
    public function view_class_qscores($quiz_id = NULL, $idq = NULL)
    {
        $this->session->set_userdata('selected_menu','view_class_qscores');
        $this->load->model('secureusers');
        
        $data['quizes'] = $this->secureusers->get_created_quizes($this->session->userdata('username')); //Get quizes created by logged in user
        if(! isset($quiz_id) && count($data['quizes'])>0)
        {
            $quiz_id = $data['quizes'][0]['quiz_id'];
        }
        $data['thisquizid'] = $quiz_id;
        
        if(isset($quiz_id))
        {
            $data['quiz_classes'] = $this->secureusers->get_quiz_classes($quiz_id);
            if(! isset($idq) && isset($data['quiz_classes']) && count($data['quiz_classes'])>0)
            {
                $idq = $data['quiz_classes'][0]['id'];
            }
            $data['quiz_scores'] = $this->secureusers->get_class_scores($idq);
            $data['thisclassidq'] = $idq;
        }
        //var_dump($data);
        $this->load->view('view_class_qscores',$data);
    }
    
    public function get_quiz_classes()
    {
        echo json_encode($this->secureusers->get_quiz_classes($this->input->post('quiz_id')));
    }
    
    public function quiz_excel_upload()
    {
        $this->load->helper('form');
        
        $config['upload_path'] = './uploads/quiz_data/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size']	= '20480';
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
            $data = array('upload_data' => $this->upload->data());
            /*******EXCEL DATA FETCHING**********/
            $file = './uploads/quiz_data/'.$data['upload_data']['file_name'];
            //load the excel library
            $this->load->library('excel');
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            //get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            //extract to a PHP readable array format
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                //header will/should be in row 1 only. of course this can be modified to suit your need.
                if ($row == 1) {
                    $header[$row][$column] = $data_value;
                } else {
                    $arr_data[$row][$column] = $data_value;
                }
            }
            foreach($arr_data as $tuple)
            {
                if(!isset($tuple['A']))
                    $tuple['A'] = "";
                if(!isset($tuple['B']))
                    $tuple['B'] = "";
                if(!isset($tuple['C']))
                    $tuple['C'] = "";
                if(!isset($tuple['D']))
                    $tuple['D'] = "";
                if(!isset($tuple['E']))
                    $tuple['E'] = "";
                if(!isset($tuple['F']))
                    $tuple['F'] = "";
                if(!isset($tuple['G']))
                    $tuple['G'] = "";
                $this->secureusers->submit_question($_POST['quiz_id'],"",$tuple['A'],$tuple['B'],$tuple['C'],$tuple['D'],$tuple['E'],$tuple['F'],$tuple['G']);
            }
            /*******EXCEL DATA FETCHING OVER**********/
            $this->session->set_flashdata('upload_success',"File uploaded successfully!!");
            
        }
        redirect('secure/edit_quiz/'.($this->input->post('quiz_id')));
    }
    
    public function get_specific_question()
    {
        $this->load->model('secureusers');
        echo json_encode($this->secureusers->get_specific_question($this->input->post('quiz_id'),$this->input->post('question_id')));
    }
    
    public function publishquiz_notify()
    {
        $this->load->model('secureusers');
        $this->secureusers->publishquiz_notify($this->input->post('quiz_id'));
        echo 'success';
    }
    
    public function get_notifications()
    {
        $this->load->model('secureusers');
        $data['total_notifications_count'] = $this->secureusers->get_total_notifications_count($this->input->post('user_id'));
        $data['notifications'] = $this->secureusers->get_five_notifications($this->input->post('user_id'));
        echo json_encode($data);
    }
    
    public function quizzes()
    {
        $this->session->set_userdata('selected_menu','quizzes');
        $this->load->model('secureusers');
        $data['exam_quizzes'] = $this->secureusers->get_exam_quizes($this->session->userdata('id'));
        $data['practice_quizzes'] = $this->secureusers->get_practice_quizes($this->session->userdata('id'));
        $this->load->view('quizzes',$data);
    }
    public function grant_specific_quiz()
    {
        $this->load->model('secureusers');
        echo $this->secureusers->grant_specific_quiz($this->input->post('username'),$this->input->post('password'),$this->input->post('idq'),$this->input->post('bioid'));
    }
    
    public function attempt_quiz($idq,$quiz_id)
    {
        $this->load->model('secureusers');
        $data['quiz_details'] = $this->secureusers->get_quiz_details($quiz_id);
        if($data['quiz_details']['quiz_type']=='e')
        {
            $attempts = $this->secureusers->check_quiz_attempts($idq,$this->session->userdata('bioid'));
            if($attempts>0)
            {
                redirect('secure/quizzes');
            }
        }
        //Make entry into quiz_idq_scores for the logged user as an attempt
        $data['idq'] = $idq;
        $data['attempt_id'] = $this->secureusers->attempt_entry_in_quiz($idq,$this->session->userdata('bioid'));
        $data['questions'] = $this->secureusers->get_quiz_questions($quiz_id,$data['quiz_details']['questions_tobe_solved']);
        $data['start_time'] = time();
        $this->load->view('quiz_interface',$data);
    }
    
    public function quiz_over()
    {
        $idq = $this->input->post('idq');
        $quiz_id = $this->input->post('quiz_id');
        $attempt_id = $this->input->post('attempt_id');
        $num_questions = $this->input->post('num_questions');
        $start_time = $this->input->post('start_time');
        $curr_time = time();
        $diff = $curr_time - $start_time;
        
        $score = 0;
        $questions_attempted = 0;
        $correctly_answered = 0;
        
        $this->load->model('secureusers');
        
        for($i=0; $i<$num_questions; $i++)
        {
            $data['questions'][$i]['tuple'] = $this->secureusers->get_this_question($quiz_id,$this->input->post('qid_'.$i));
            if($this->input->post('qop_'.$i))
            {
                $data['questions'][$i]['useranswer'] = $this->input->post('qop_'.$i);
                $questions_attempted++;
                $is_correct = $this->secureusers->check_answer($quiz_id,$this->input->post('qid_'.$i),$this->input->post('qop_'.$i));
                if($is_correct==1)
                {
                    $correctly_answered++;
                    $score++;
                }
            }
            else
            {
                $data['questions'][$i]['useranswer'] = "none";
            }
        }
        $score = ($score / $num_questions) * 100;
        $return = $this->secureusers->submit_score($idq,$attempt_id,$questions_attempted,$correctly_answered,$num_questions,$diff,$score);
        $data['idq'] = $idq;
        $data['attempt_id'] = $attempt_id;
        $data['questions_attempted'] = $questions_attempted;
        $data['correctly_answered'] = $correctly_answered;
        $data['num_questions'] = $num_questions;
        $data['timediff'] = $diff;
        $data['score'] = $score;
        $this->load->view('quiz_review',$data);
    }
    
    public function student_dashboard()
    {
        $this->load->model('secureusers');
        if($this->session->userdata('atttype')=="lecturewise")
            $data['subjects'] = $this->secureusers->get_att_dboard($this->session->userdata('bioid'));
        $data['escores'] = $this->secureusers->get_escores_dboard($this->session->userdata('bioid'));
        $this->load->view('student_dashboard',$data);
    }
    
    public function test()
    {
        $data['minutes'] = 120;
        $this->load->view('timer',$data);
    }
}