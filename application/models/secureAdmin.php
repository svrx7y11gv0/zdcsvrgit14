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
    public function save_institute_details($name, $phone, $email, $address, $attendance_type)
    {
        $row = $this->db->get('institute_setup')->row();
        if($this->db->affected_rows()==0)
        {
            $this->db->insert('institute_setup',array('name'=>$name,'address'=>$address,'phone_nos'=>$phone,'email_ids'=>$email,'attendance_type'=>$attendance_type));
            return 1;
        }
        else 
        {
            if($row->attendance_type=="" || $row->attendance_type == $attendance_type)
            {
                $this->db->update('institute_setup',array('name'=>$name,'address'=>$address,'phone_nos'=>$phone,'email_ids'=>$email,'attendance_type'=>$attendance_type));
                return 1;
            }
            else
            {
                $this->db->update('institute_setup',array('name'=>$name,'address'=>$address,'phone_nos'=>$phone,'email_ids'=>$email));
                return 0;
            }
        }
    }
    
    public function get_departments()
    {
        $query = $this->db->get('departments');
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_department_classes($dept_id)
    {
        $this->db->select('*');
        $this->db->from('classes');
        $this->db->join('department_classes', 'classes.class_code = department_classes.class_code');
        $this->db->where(array('department_classes.dept_id'=>$dept_id));
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_department_teachers($dept_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('department_teachers', 'users.bioid = department_teachers.bioid');
        $this->db->where(array('department_teachers.dept_id'=>$dept_id));
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
