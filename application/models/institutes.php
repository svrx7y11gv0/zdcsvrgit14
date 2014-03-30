<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institutes extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function fetch_institutes()
    {
        return $this->db->get('institutes')->result();
    }
    function institute_info($institute_id = null)
    {
        if(isset($institute_id) && $institute_id!=0)
            return $this->db->get_where('institutes',array('id'=>$institute_id))->row();
    }
}


?>
