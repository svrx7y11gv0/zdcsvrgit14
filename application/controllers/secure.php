<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('session');
        if(!$this->session->userdata('username') && $this->router->method!="login")
        {
            redirect('guest/loginpage');
        }
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
        
        $this->load->database();
        $this->load->model("institutes");
        
        $institute_data = $this->institutes->institute_info($institute_id);
        
        $params['hostname'] = $institute_data->hostname;
        $params['username'] = $institute_data->dbusername;
        $params['password'] = $institute_data->dbpassword;
        $params['database'] = $institute_data->dbname;
        $params['dbdriver'] = 'mysql';
        $new_db = $this->load->database( $params, TRUE );
        $this->db = $new_db;
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
            $userInfo = array('id'=>$result->id,'username'=>$result->username,'firstname'=>$result->firstname,'lastname'=>$result->lastname,'type'=>$result->type,'priviledge'=>$result->priviledge,'bioid'=>$result->bioid);
            $this->session->set_userdata($userInfo);
            //$this->load->view('test',$data);
            echo "true";
        }
        else
        {
            /*$this->session->set_flashdata('message_fail',"User Name or Password is Not Correct.");
            redirect('guest/loginpage');*/
            echo "false";
        }
    }
    
    public function logout()
    {
        $userInfo = array('id'=>'','username'=>'','firstname'=>'','lastname'=>'','type'=>'','priviledge'=>'','bioid'=>'');
        $this->session->unset_userdata($userInfo);
        $this->session->sess_destroy();
        redirect('guest/loginpage');
    }
    
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
            redirect('guest/loginpage');
        }
    }
    
    public function updateInstituteDetails()
    {
        $this->load->model('secureAdmin');
        //echo $_POST['name'].$_POST['email'].$_POST['phone'].$_POST['address'];
        $this->secureAdmin->save_institute_details($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['address']);
    }
    
}