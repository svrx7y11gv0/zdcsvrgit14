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
        if($cookie_data!=null)
        {
            $this->load->model('secureusers');
            $result = $this->secureusers->validate_username($cookie_data[1]);
            if(isset($result))
            {
                $userInfo = array('id'=>$result->id,'username'=>$result->username,'firstname'=>$result->firstname,'lastname'=>$result->lastname,'type'=>$result->type,'privilege'=>$result->privilege,'bioid'=>$result->bioid,'multilanguage'=>$result->multilanguage,'photourl'=>$result->photourl);
                $this->session->set_userdata($userInfo);
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
    
    public function test()
    {
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML('<p>Hello There</p>');
        $this->mpdf->Output();
    }
}