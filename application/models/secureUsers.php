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
}


?>