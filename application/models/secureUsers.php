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
        $query = "select * from users, profiles where users.id = profiles.user_id and users.id = ".$user_id;
        $row = $this->db->query($query)->row();
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
                'contact_nos' => $phone,
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
}


?>