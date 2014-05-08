<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SecureUsers extends CI_Model
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
    function set_user_details($user_id,$firstName,$lastName,$middleName,$dob,$gender,$email,$phone,$address,$bloodGroup,$languages,$nationality,$category,$religion,$aboutMe,$photo)
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
                $this->session->set_userdata('photourl',$photo);
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            $this->session->set_userdata('firstname',$firstName);
            $this->session->set_userdata('lastname',$lastName);
            
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
        $this->db->group_by(array("users.id")); 
        $this->db->having(array($class_code.'.date'=>$date,'users.type'=>STUDENT_TYPE));
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
        $this->db->select('id,firstname,middlename,lastname,bioid');
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
    
}


?>