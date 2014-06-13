<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secureadmin extends CI_Model
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
        $this->db->select('classes.class_code,class AS classname,section,device_serial_number');
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
    
    public function get_non_department_classes()
    {
        $this->db->select('classes.class_code,class AS classname,section');
        $this->db->from('classes');
        $this->db->where('`class_code` NOT IN (Select distinct(`class_code`) from department_classes)', NULL, FALSE);
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
        $this->db->where(array('department_teachers.dept_id'=>$dept_id,'users.type'=>TEACHER_TYPE));
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function add_department($deptname,$multi_classes,$multi_teachers,$dept_head_bioid)
    {
        $query = $this->db->get_where('departments',array('department_name'=>$deptname));
        if($this->db->affected_rows()!=0)
        {
            return $deptname." department already exists in database";
        }
        else
        {
            $this->db->insert('departments',array('department_name'=>$deptname));
            $dept_id = $this->db->insert_id();
            for($i=0; $i<count($multi_classes) ; $i++)
            {
                $this->db->insert('department_classes',array('dept_id'=>$dept_id,'class_code'=>$multi_classes[$i]));
            }
            //Insert all teachers under the dept_id
            for($i=0; $i<count($multi_teachers) ; $i++)
            {
                $this->db->insert('department_teachers',array('dept_id'=>$dept_id,'bioid'=>$multi_teachers[$i]));
            }
            //Update the teacher type who is the HOD
            $this->db->where(array('dept_id'=>$dept_id,'bioid'=>$dept_head_bioid));
            $this->db->update('department_teachers',array('prv_type'=>'hod'));
            
            return "all_good";
        }
    }
    
    function update_department($dept_id,$multi_classes,$multi_teachers,$dept_head_bioid)
    {
        $this->db->where(array('dept_id'=>$dept_id));
        $this->db->delete('department_classes');
        $this->db->where(array('dept_id'=>$dept_id));
        $this->db->delete('department_teachers');
        
        for($i=0; $i<count($multi_classes) ; $i++)
        {
            $this->db->insert('department_classes',array('dept_id'=>$dept_id,'class_code'=>$multi_classes[$i]));
        }
        for($i=0; $i<count($multi_teachers) ; $i++)
        {
            $this->db->insert('department_teachers',array('dept_id'=>$dept_id,'bioid'=>$multi_teachers[$i]));
        }
        //Update the teacher type who is the HOD
        $this->db->where(array('dept_id'=>$dept_id,'bioid'=>$dept_head_bioid));
        $this->db->update('department_teachers',array('prv_type'=>'hod'));

        return "all_good";
    }
}
?>
