<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SecureAdmin extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    public function fetch_institute_details()
    {
        $query = $this->db->get('institute_setup');
        if($this->db->affected_rows()==1)
        {
            return $query->row();
        }
        else
            return null;
    }
    public function save_institute_details($name, $phone, $email, $address)
    {
        $this->db->get('institute_setup');
        if($this->db->affected_rows()==0)
        {
            $this->db->insert('institute_setup',array('name'=>$name,'address'=>$address,'phone_nos'=>$phone,'email_ids'=>$email));
        }
        else {
            $this->db->update('institute_setup',array('name'=>$name,'address'=>$address,'phone_nos'=>$phone,'email_ids'=>$email));
        }
    }
}
?>
