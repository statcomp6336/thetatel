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
public function emp_error()
{
	return $this->newdb->count_all('employee_error');
}
	public function create_Employee($dta)
	{
		if ($this->newdb->insert('employee_master_new',$dta)) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function create_Salary($dta)
	{
		if ($this->newdb->insert('salary_master',$dta)) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function is_uniqemployee($custid,$emp_id,$pan,$uan,$adhar)
	{
		return $this->is_uniq('employee_master_new',array('custid'=> $custid,'emp_id'=>$emp_id,'pan'=>$pan,'uan_no' =>$uan,'adhaar' =>$adhar));
		
	}
	public function in_employee_error($custid,$emp_id)
	{
		return $this->is_uniq('employee_error',array('custid'=>$custid,'emp_id'=>$emp_id));		
	}
	
	public function get_allemployee($limit, $start)
	{
		// $w=$this->db->select('*')->from('employee_master_new')->get()->result();
		// return $w;
		$this->newdb->limit($limit, $start);
        $query = $this->newdb->get('employee_master_new');

        return $query->result();
	}
	 public function get_count() {
        return $this->db->count_all('employee_master_new');
    }
    public function is_uploaded_salary($custid,$empid,$year,$month)
    {
    	$sql=$this->db->select('*')->from('salary_master')->where(array('custid'=>$custid,'empid' =>$empid,'year'=>$year,'month'=>$month))->get();
    	if ($sql->num_rows() > 0) {
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}

    }
    public function get_missinguan()
    {
    	$result=$this->fetch('employee_master_new','`srno`,`entity_name`, `custid`,  `emp_name`, `emp_id`, `gender`,`marital_status`, `pf_deduct`, `ul_pf`, `esic_deduct`, `esic_no`, `uan_no`, `branch`, `dept`, `designation`, `fath_hus_name`, `nom1`, `nom2`, `nom3`, `nom4`, `email`, `mob`, `per_address`, `temp_address`, `pan`, `adhaar`, `bank_ac`, `ifsc`, `bank_name`, `bank_branch`, `education`, `phy_handi`, `phy_handi_cat`,  `emp_status`, `birth_date`, `join_date`, `member_date`, `exit_date`, `int_worker`, `reldob`, `reladhr`, `relname`, `relage`, `namepan`, `nameadhr`, `dobadhr`, `vendor_id`, `contractor_name`, `location`',array('uan_no' => ''))->result();
    	return $result;
    }

}	