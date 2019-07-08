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
		$this->newdb->order_by('srno', 'desc');
        $query = $this->newdb->get('employee_master_new',$limit, $start);

        return $query->result();
	}
	 public function get_count() {
        return $this->newdb->count_all('employee_master_new');
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
    public function get_missinguan($spgid,$custid,$location)
    {
    	//$result=$this->fetch('employee_master_new','`srno`,`entity_name`, `custid`,  `emp_name`, `emp_id`, `gender`,`marital_status`, `pf_deduct`, `ul_pf`, `esic_deduct`, `esic_no`, `uan_no`, `branch`, `dept`, `designation`, `fath_hus_name`, `nom1`, `nom2`, `nom3`, `nom4`, `email`, `mob`, `per_address`, `temp_address`, `pan`, `adhaar`, `bank_ac`, `ifsc`, `bank_name`, `bank_branch`, `education`, `phy_handi`, `phy_handi_cat`,  `emp_status`, `birth_date`, `join_date`, `member_date`, `exit_date`, `int_worker`, `reldob`, `reladhr`, `relname`, `relage`, `namepan`, `nameadhr`, `dobadhr`, `vendor_id`, `contractor_name`, `location`',array('uan_no' => ''))->result();
    	//return $result;

    	//displaying data from table		
			$this->db->select("entity_name,custid,emp_name,emp_id,gender,marital_status,pf_deduct,ul_pf,esic_deduct,esic_no,uan_no,branch,dept,designation,fath_hus_name,reldob,reladhr,relname,relage,nom1,nom2,nom3,nom4,email,mob,per_address,temp_address,pan,namepan,adhaar,nameadhr,bank_ac,ifsc,bank_name,bank_branch,dobadhr,education,emp_status,phy_handi,phy_handi_cat,birth_date,join_date,member_date,exit_date,int_worker,vendor_id,contractor_name,location");
			$this->db->from('employee_master_new');
			if($location=="ALL")
			{
				$this->db->where(array(	'custid'=>$custid,
										'spgid' =>user_id(),
										'uan_no'=>'0',
										'uan_no'=>' '));
			}
			else
			{
				$this->db->where(array(	'custid'	=>	$custid,
										'spgid' 	=>	user_id(),
										'location'	=>	$location,
										'uan_no'	=>	'0',
										'uan_no'	=>	' '			));
			}		
			$result=$this->db->get()->result();
			return $result;
    }


    /* get location data from employee_master_new table */
	public function get_location()
	{
		//displaying data from table
		
			return $this->db->select("location")
							->from('employee_master_new')
							//->where('location != ',NULL,FALSE);
							->where(array(	'location!=' =>NULL))
							->group_by(array("location"))
							->get()->result();
	}

	/* get entity Details data from customer_master table */
	public function get_entitydetails()
	{
		//displaying data from table
		/// $spgid=$this->session->SESS_CUST_ID;
		if (IS_SPG== TRUE)
		{
			return $this->db->select("custid,entity_name")
					->from('customer_master')
					->where(array(	'spgid' =>user_id()))
					->get()->result();
		} 		 
		elseif (IS_SPGUSER== TRUE)
		{
			return $this->db->select("custid,entity_name")
					->from('uu_companyselection')
					->where(array(	'spgid' =>user_id(),'username'=>USERNAME ))
					->get()->result();
		} 					
	}
	// check excel upload company is exist or not
	public function company_exist($custid='')
	{
		return $this->is_exist('customer_master',array('custid'=>$custid));
	}

}	