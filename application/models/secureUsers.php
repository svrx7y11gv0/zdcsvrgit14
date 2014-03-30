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
        $result = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row();
        if($this->db->affected_rows()==1)
            return $result;
        else
            return null;
    }
}


?>