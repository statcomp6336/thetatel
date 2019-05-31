<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Report_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}

	public function get_BackloagEmployee($value='')
	{
		$emp_backlog=$this->newdb->select('e.spgid,e.custid,e.emp_id,s.month,s.year')
							->from('employee_master_new AS e')
							->join('salary_master AS s','e.spgid=s.spgid AND e.custid=s.custid AND e.emp_id=s.empid','left outer')
							// ->where(array('s.month' =>$this->lastmonth(),'s.year'=>$this->get_year()) )
							->where('s.CA IS NULL', null, false)		
							->get()
							->result();
		return $emp_backlog;					
	}
	public function get_BackloagSalary($value='')
	{
		$sal_backlog=$this->newdb->select('s.spgid,s.custid,s.empid,s.month,s.year')
							->from('employee_master_new AS e')
							->join('salary_master AS s','e.spgid=s.spgid AND e.custid=s.custid AND e.emp_id=s.empid','right outer')	
							->where('s.month' ,$this->lastmonth())
							->where('s.year' ,$this->get_year())
							->where('e.spgid IS NULL', null, false)
							->get()
							->result();
		return $sal_backlog;
	}
	public function get_MasterProcess($value='')
	{
		$sal_backlog=$this->newdb->select('s.spgid,s.custid,s.empid,s.month,s.year')
							->from('employee_master_new AS e')
							->join('salary_master AS s','s.spgid=e.spgid AND s.custid=e.custid AND s.empid=e.emp_id')
							->where('s.month' ,$this->lastmonth())
							->where('s.year' ,$this->get_year())

							->get()
							->result();
		return $sal_backlog;
	}
	/* genrate sanitize report main process start*/
	public function CreateSanitizeReport($value='')
	{

		$setData_empBacklog=[];
		$setData_salBacklog=[];
		$setData_master=[];
		$backlog_emp=$this->get_BackloagEmployee();
		foreach ($backlog_emp as $key ) {
			$setData_empBacklog[] = array('spgid' 	=> $key->spgid,
										'custid'	=>$key->custid,
										'empid' 	=>$key->emp_id,
										'month' 	=>$key->month,
										'year'		=>$key->year
		 						);
		}
		$backlog_sal=$this->get_BackloagSalary();
		foreach ($backlog_sal as $val ) {
			$setData_salBacklog[] = array('spgid' 	=> $val->spgid,
										'custid'	=>$val->custid,
										'empid' 	=>$val->empid,
										'month' 	=>$val->month,
										'year'		=>$val->year
		 						);
		}
		$master=$this->get_MasterProcess();
		foreach ($master as $put ) {
			$setData_master[] = array('spgid' 	=> $put->spgid,
										'custid'	=>$put->custid,
										'empid' 	=>$put->empid,
										'month' 	=>$put->month,
										'year'		=>$put->year
		 						);
		}

		echo "<pre>";
		echo "employee backlog<br>";
		echo sizeof($setData_empBacklog);
		echo "<hr>Salary backlog<br>";
		echo sizeof($setData_salBacklog);

		echo "<hr>master<br>";
		echo sizeof($setData_master);



		

		// ini_set('max_execution_time', 300);
		// $this->db->truncate('employee_process');
		// $this->db->truncate('salary_process');
		// $getData=$this->getCust();
		// $diff_sal=[];
		// foreach ($getData as $key ) {	
		// 	// echo $key->custid."<br>";
		// 	$this->SaveSalary($key->custid,'backlog');//store salary data on backlog table
		// 	$this->SaveEmployee($key->custid,'backlog');// store employee Date on backlog table

		// 	// //-Start Matched Data into Salary and Employee-//

		// 	$this->SaveSalary($key->custid,'process'); //store salary data on process table
		// 	$this->SaveEmployee($key->custid,'process'); //store employee data on process table
			 
		// }

	}


	/* 
		* Genrate Sanitize report view
		* get data from salary master and employee master table
		* and dislplay join table
	*/
		var $lastmonth;
		var $year;
		var $month;
		private function get_year()
		{
			$ab = date_default_timezone_get(); 
			date_default_timezone_set($ab); 
			$currmonth=date("F");//Janaury
			$lastmonth=Date('F', strtotime($currmonth . " last month"));//Janaury

			if($lastmonth=="December")
			{
				return $year=date('Y' , strtotime('-1 year'));
			}
			else
			{
				return $year=date('Y');
			}
			
		}
		private function lastmonth()
		{
			$ab = date_default_timezone_get(); 
			date_default_timezone_set($ab); 
			$currmonth=date("F");//Janaury
			$this->lastmonth=Date('F', strtotime($currmonth . " last month"));//Janaury

			
			if($currmonth=="March")
			{
			  return $lastmonth="February";
			}
			else
			{
			 return $lastmonth=Date('F', strtotime($currmonth . " last month"));//Janaury
			} 
		}


	public function get_SanitizeTable($value='')
	{
		$currmonth=date("F");//Janaury
			$this->lastmonth=Date('F', strtotime($currmonth . " last month"));//Janaury

			if($this->lastmonth=="December")
			{
				$this->year=date('Y' , strtotime('-1 year'));
			}
			else
			{
				$this->year=date('Y');
			}
			if($currmonth=="March")
			{
			  $this->lastmonth="February";
			}
			else
			{
			  $this->lastmonth=Date('F', strtotime($currmonth . " last month"));//Janaury
			} 


		$getData=$this->getCust();
		$returnData=[];
		foreach ($getData as $key ) {

			$returnData[] = array('custid' => $key->custid,
								'comp_name'=> $key->entity_name,
								'emp_data' => $this->emp_data($key->custid),
								'sal_data' => $this->sal_data($key->custid),
								'diff_emp'	=>$this->diff_emp($key->custid),
								'diff_sal'  =>$this->diff_sal($key->custid),
								'date'		=> $this->lastmonth
			 );
		}
		return $returnData;
	}
	private function getCust()
	{
		$cust=$this->db->select('b.custid,b.entity_name')
						->from('compliance_scope a')
						->join('customer_master b', 'a.custid=b.custid')
						->where('a.spg_id',user_id())
						->group_by('a.custid')
						->order_by('b.entity_name')
						->get()->result();
		return $cust;
	}

	private function emp_data($id='')
	{
		$emps=$this->db->select('count(emp_id) emp')->from('employee_master_new')->where('custid',$id)->get()->row()->emp;
		return $emps;
	}
	private function sal_data($id='')
	{
		$sal=$this->db->select('count(empid) salary')->from('salary_master')->where(array('custid' => $id, 'month' =>$this->lastmonth,'year'=>$this->year))->get()->row()->salary;
		return $sal;
	}
	private function diff_sal($id='',$d='')
	{
		
		$this->db->select('emp_id');
		$this->db->from('employee_master_new');
		$this->db->where('custid',$id);
		$where_clause = $this->db->get_compiled_select();

		#Create main query
		$this->db->select('count(empid) as empid');//
		$this->db->from('salary_master a');
		$this->db->where('a.custid',$id);
		$this->db->where('a.month',$this->lastmonth());
		$this->db->where('a.year',$this->get_year());	
		if (!empty($d) && $d == 'IN') {
		$this->db->where("a.empid IN ($where_clause)", NULL, FALSE);		
		}
		else{	
		$this->db->where("a.empid NOT IN ($where_clause)", NULL, FALSE);
		}
		$emps=$this->db->get()->row()->empid;
		return $emps;
	}
	
	private function diff_emp($id='',$d='')
	{
		$this->db->select('empid');
		$this->db->from('salary_master');
		$this->db->where('custid',$id);
		$this->db->where('month',$this->lastmonth);
		$this->db->where('year',$this->year);	
		$where_clause = $this->db->get_compiled_select();

		#Create main query
		$this->db->select('count(a.emp_id) as emp_id');//
		$this->db->from('employee_master_new a');
		$this->db->where('a.custid',$id);	
		if (!empty($d) && $d == 'IN') {		
		$this->db->where("a.emp_id IN ($where_clause)", NULL, FALSE);
		}
		else
		{
			$this->db->where("a.emp_id NOT IN ($where_clause)", NULL, FALSE);
		}
		$emps=$this->db->get()->row()->emp_id;
		return $emps;
	}


	


	


}	