<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secureusers extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function validate_user($username,$password)
    {
        $row = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function validate_username($username)
    {
        $row = $this->db->get_where('users',array('username'=>$username))->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function get_user_details($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('profiles', 'users.id = profiles.user_id','left');
        $this->db->where(array('users.id'=>$user_id));
        $query = $this->db->get();
        $row = $query->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function get_student_details($student_bioid)
    {
        $this->db->select('users.id,gender,admission_no,roll_no,dob,address,blood_group,languages,nationality,category,religion,about_me,firstname,middlename,lastname,class_code,type,privilege,contact_nos,email,bioid,photourl');
        $this->db->from('users');
        $this->db->join('profiles', 'users.id = profiles.user_id','left');
        $this->db->where(array('users.bioid'=>$student_bioid,'type'=>STUDENT_TYPE));
        $query = $this->db->get();
        $row = $query->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function set_user_details($user_id,$firstName,$lastName,$middleName,$dob,$gender,$email,$phone,$address,$bloodGroup,$languages,$nationality,$category,$religion,$aboutMe,$photo,$is_this_student)
    {
        $p = $this->session->userdata('privilege');
        if($p == PRV_STUDENT)
        {
            $data = array(
               'email' => $email
            );
            if($photo!="")
            {
                $data['photourl'] = $photo;
                $this->session->set_userdata('photourl',$photo);
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            
            $this->db->get_where('profiles',array('user_id'=>$user_id));
            $data = array(
               'user_id' => $user_id, 
               'languages' => $languages,
               'about_me' => $aboutMe
            );
            if($this->db->affected_rows()==0)
            {
                $this->db->insert('profiles', $data); 
            }
            else
            {
                $this->db->where('user_id',$user_id);
                $this->db->update('profiles',$data);
            }
        }
        else
        {
            $data = array(
               'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'contact_nos' => $phone,
               'email' => $email ,
            );
            if($photo!="")
            {
                $data['photourl'] = $photo;
                if(!$is_this_student)
                    $this->session->set_userdata('photourl',$photo);
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            if(!$is_this_student)
            {
                $this->session->set_userdata('firstname',$firstName);
                $this->session->set_userdata('lastname',$lastName);
            }
            $this->db->get_where('profiles',array('user_id'=>$user_id));
            $data = array(
               'user_id' => $user_id, 
                'gender' => $gender,
                'dob' => $dob,
                'address' => $address,
                'blood_group' => $bloodGroup,
                'languages' => $languages,
                'nationality' => $nationality,
                'category' => $category,
                'religion' => $religion,
                'about_me' => $aboutMe
            );
            if($this->db->affected_rows()==0)
            {
                $this->db->insert('profiles', $data); 
            }
            else
            {
                $this->db->where('user_id',$user_id);
                $this->db->update('profiles',$data);
            }
        }
    }
    
    function update_account($user_id,$currUsername,$currPassword,$multilanguage,$newUsername,$newPassword)
    {
        $row = $this->db->get_where('users',array('id'=>$user_id,'username'=>$currUsername,'password'=>$currPassword))->row();
        if($this->db->affected_rows()==0)
            return 0;
        else
        {
            $data = array(
               'multilanguage' => $multilanguage,
            );
            if(isset($newUsername))
            {
                $data['username'] = $newUsername;
                $this->session->set_userdata('username',$newUsername);
            }
            if(isset($newPassword))
            {
                $data['password'] = $newPassword;
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            
            $this->session->set_userdata('multilanguage',$multilanguage);
            return 1;
        }
    }
    
    //Fetching all classes
    function get_classes()
    {
        $query = $this->db->get('classes');
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    //Fetching all teachers
    function get_teachers()
    {
        $query = $this->db->get_where('users',array('type'=>TEACHER_TYPE));
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_students_inouttime_details($class_code,$date)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join($class_code, "users.bioid = ".$class_code.".bio_id");
        $this->db->where(array($class_code.'.date'=>$date,'users.type'=>STUDENT_TYPE));
        $this->db->group_by(array("users.id")); 
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_students_ofa_class($class_code)
    {
        $this->db->select('id,rollno,firstname,middlename,lastname,bioid');
        $this->db->order_by('rollno ASC, firstname ASC,middlename ASC,lastname ASC');
        $query = $this->db->get_where('users',array('class_code'=>$class_code,'type'=>STUDENT_TYPE));
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_intime_ofa_student($class_code,$bio_id,$date_from,$date_to)
    {
        $query = "select `date` as x, `in_time` as y from `".$class_code."` group by `bio_id`,`date` having `bio_id` = ".$bio_id." and `date` BETWEEN '".$date_from."' AND '".$date_to."' order by `date` ASC";
        $result = $this->db->query($query);
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $result->result_array();
    }
    
    function get_outtime_ofa_student($class_code,$bio_id,$date_from,$date_to)
    {
        $query = "select `date` as x, `out_time` as y from `".$class_code."` group by `bio_id`,`date` having `bio_id` = ".$bio_id." and `date` BETWEEN '".$date_from."' AND '".$date_to."' order by `date` ASC";
        $result = $this->db->query($query);
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $result->result_array();
    }
    
    function get_selective_departments($bioid)
    {
        $this->db->select('departments.id,department_name');
        $this->db->from('departments');
        $this->db->join('department_teachers', 'departments.id = department_teachers.dept_id');
        $this->db->where(array('department_teachers.bioid'=>$bioid));
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();

    }
    function is_hod_of_dept($dept_id,$bio_id)
    {
        $query = $this->db->get_where('department_teachers',array('prv_type'=>'hod','dept_id'=>$dept_id,'bioid'=>$bio_id));
        if($this->db->affected_rows()==0)
        {
            return false;
        }
        else
            return true;
    }
    
    function get_selective_dept_classes($dept_id,$bio_id)
    {
        $this->db->select('classes.class_code,class AS classname,section');
        $this->db->from('classes');
        $this->db->join('department_classes', 'classes.class_code = department_classes.class_code');
        $this->db->where(array('department_classes.dept_id'=>$dept_id));
        //Get all class codes of the logged in teacher who is not HOD
        $this->db->where('classes.class_code IN (Select `class_code` from `teachers_subjects` where bio_id = '.$bio_id.')', NULL, FALSE); 
        $query = $this->db->get();
        
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    
    public function get_selective_non_dept_classes($bio_id)
    {
        $this->db->select('classes.class_code,class AS classname,section');
        $this->db->from('classes');
        $this->db->where('`class_code` NOT IN (Select distinct(`class_code`) from department_classes)', NULL, FALSE);
        //Get all class codes of the logged in teacher who is not HOD
        $this->db->where('classes.class_code IN (Select `class_code` from `teachers_subjects` where bio_id = '.$bio_id.')', NULL, FALSE); 
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_inout_att_records($class_code,$date_from,$date_to)
    {
        $this->db->select($class_code.'.bio_id,in_time,out_time,date');
        $this->db->from($class_code);
        $this->db->join('users','users.bioid = '.$class_code.".bio_id");
        $this->db->where('users.type =',STUDENT_TYPE);
        $this->db->where($class_code.'.date >=',$date_from);
        $this->db->where($class_code.'.date <=',$date_to);
        $this->db->group_by('bio_id , date');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_all_subjects_of_this_class($class_code)
    {
        $this->db->select('subject');
        $this->db->from('teachers_subjects');
        $this->db->where('class_code = ',$class_code);
        $this->db->group_by('class_code');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_selective_subjects_of_this_class($class_code)
    {
        $this->db->select('subject');
        $this->db->from('teachers_subjects');
        $this->db->where('class_code = ',$class_code);
        $this->db->where('bio_id = ',$this->session->userdata('bioid'));
        $this->db->group_by('class_code');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_subj_att_records($class_code,$subject,$date_from,$date_to)
    {
        $this->db->select($class_code.'.bio_id,time,slot,date');
        $this->db->from($class_code);
        $this->db->join('users','users.bioid = '.$class_code.".bio_id");
        $this->db->where('users.type =',STUDENT_TYPE);
        $this->db->where($class_code.'.date >=',$date_from);
        $this->db->where($class_code.'.date <=',$date_to);
        $this->db->where($class_code.'.subject = ',$subject);
        $this->db->group_by($class_code.'.bio_id , '.$class_code.'.date');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
}


?>