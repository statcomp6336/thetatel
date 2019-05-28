<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Employee_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}
	public function is_uniqemployee($custid,$emp_id)
	{
		return $this->is_uniq('employee_master_new',array('custid'=>$custid,'emp_id'=>$emp_id));
			// $w=$this->db->select('custid,emp_id')->from('employee_master_new')->where(array('custid'=>$custid,'emp_id'=>$emp_id))->get()->result();
			// var_dump($w);
			// exit();

	}
	public function get_allemployee($limit, $start)
	{
		// $w=$this->db->select('*')->from('employee_master_new')->get()->result();
		// return $w;
		$this->db->limit($limit, $start);
        $query = $this->db->get('employee_master_new');

        return $query->result();
	}
	 public function get_count() {
        return $this->db->count_all('employee_master_new');
    }

}	