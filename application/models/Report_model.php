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
	public function backlog_process($value='')
	{
		$select="SELECT a.spgid,a.custid,a.entity_name,a.emp_id AS emp, IF(b.empid = NULL,'YES','NO') AS is_sal FROM employee_master_new a LEFT OUTER JOIN salary_master b ON a.spgid=b.spgid AND a.custid=b.custid AND a.emp_id=b.empid WHERE b.empid IS NULL
			UNION
			SELECT b.spgid,b.custid,b.entity_name,b.empid AS emp, IF(a.emp_id = NULL,'NO','YES') AS is_sal FROM employee_master_new a RIGHT OUTER JOIN salary_master b ON a.spgid=b.spgid AND a.custid=b.custid AND a.emp_id=b.empid  WHERE a.emp_id IS NULL";

		$m_backlog=$this->db->query($select)
							->result();
		return $m_backlog;
	}
	public function get_MasterProcess($value='')
	{
		$sal_backlog=$this->db->select('s.spgid,s.custid,s.entity_name, s.empid,s.month,s.year')
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

		
		$setData_master=[];
		$editData_master=[];
		$editBacklogData =[];
		$setBacklogData =[];


		// $backlog_emp=$this->get_BackloagEmployee();
		// foreach ($backlog_emp as $key ) {
		// 	$setData_empBacklog[] = array('spgid' 	=> $key->spgid,
		// 								'custid'	=>$key->custid,
		// 								'empid' 	=>$key->emp_id,
		// 								'month' 	=>$key->month,
		// 								'year'		=>$key->year
		//  						);
		// }
		// $backlog_sal=$this->get_BackloagSalary();
		// foreach ($backlog_sal as $val ) {
		// 	$setData_salBacklog[] = array('spgid' 	=> $val->spgid,
		// 								'custid'	=>$val->custid,
		// 								'empid' 	=>$val->empid,
		// 								'month' 	=>$val->month,
		// 								'year'		=>$val->year
		//  						);
		// }
		/*
			backlog process
		*/
		$backlogData=$this->backlog_process();
		foreach ($backlogData as $log) 
		{
			if ($this->is_exist('backlog_process',array('spgid' => $log->spgid,
										'custid'	=>$log->custid,
										'empid' 	=>$log->emp//,
										// 'month' 	=>$this->lastmonth(),
										// 'year'		=>$this->get_year()
		 						))== TRUE) 
			{

				$editBacklogData[]=array('spgid' 	=> $log->spgid,
										'custid'	=>$log->custid,
										'entity_name'=>$log->entity_name,
										'empid' 	=>$log->emp,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year(),
										'is_sal'	=>$log->is_sal
		 						);				
			}
			else
			{
				$setBacklogData[]=array('spgid' 	=> $log->spgid,
										'custid'	=>$log->custid,
										'entity_name'=>$log->entity_name,
										'empid' 	=>$log->emp,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year(),
										'is_sal'	=>$log->is_sal
		 						);
				
			}	
		}



		$master=$this->get_MasterProcess();
		foreach ($master as $put ) {
			if ($this->is_exist('master_process',array('spgid'=> $put->spgid,'custid' => $put->custid,'empid'=>$put->empid))== TRUE) {//'month'=>$put->month,'year'=>$put->year

				$editData_master[] = array('spgid' 	=> $put->spgid,
										'custid'	=>$put->custid,
										'entity_name'=>$put->entity_name,
										'empid' 	=>$put->empid,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year()
		 						);
			}
			else
			{
			$setData_master[] = array('spgid' 	=> $put->spgid,
										'custid'	=>$put->custid,
										'entity_name'=>$put->entity_name,
										'empid' 	=>$put->empid,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year()
		 						);
			}
		}

		echo "<pre>";
		
		if (!empty($setData_master)) {
			echo "master process first time <br>";
			echo sizeof($setData_master);
			$this->newdb->insert_batch('master_process',$setData_master);

		}
		if (!empty($editData_master)) {
			# code...
			echo "master process already <br>";
			echo sizeof($editData_master);
			// $this->newdb->update_batch('master_process', $editData_master,'spgid,custid,empid'); 
		}
		if (!empty($setBacklogData)) {
			# code...
			echo "backlog process first time <br>";
			var_dump($setBacklogData);
			$this->newdb->insert_batch('backlog_process',$setBacklogData);
		}
		if (!empty($editBacklogData)) {
			# code...
			echo "backlog process already <br>";
			echo sizeof($editBacklogData);
			// $this->db->update_batch('backlog_process', $editBacklogData,'spgid,custid,empid'); 
		}

		


		

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

	/*
		Genrate process table for report
	*/
	public function get_ProcessTable($value='')
	{
		$pr=$this->newdb->select('spgid,custid,entity_name,COUNT(empid) AS empdata,COUNT(empid) AS saldata,month,year')
							->from('master_process')
							->where('month' ,$this->lastmonth())
							->where('year' ,$this->get_year())
							->group_by(array("spgid", "custid"))
							->get()
							->result();
		return $pr;
	}
	/* 
		CREATE PF PROCESS COMPANY WIZE 
	*/
	public function CreatePfProcess($spg,$cust)
	{
		ini_set('memory_limit', '128M');
		$this->remove('pf_template',array('spgid'=>$spg,'custid' =>$cust,'month'=>$this->lastmonth(),'year'=>$this->get_year()));

		$pf=[];
		$pro=$this->fetch('master_process','spgid,custid,empid',array('spgid'=>$spg,'custid' =>$cust,'month'=>$this->lastmonth(),'year'=>$this->get_year()))->result();
		$count=0;
		foreach ($pro as $key) {
		$count++;
			$mainPro=$this->newdb->select('c.basic,c.name,c.DA,c.VPF,c.monthly_gross,c.entity_name,c.Month_Days,c.paid_days,c.empid,c.epf_wages,YEAR(b.birth_date) AS age_year,MONTH(b.birth_date) AS age_month,b.uan_no,b.birth_date,b.ul_pf,b.join_date,b.exit_date')
						->from('employee_master_new b')						
						->join('salary_master c', 'b.spgid=c.spgid AND b.custid=c.custid')
						->where('b.emp_id',$key->empid)		
						->where('c.empid',$key->empid)
						->where('c.custid',$cust)
						->where('b.custid',$cust)
						->where('month',$this->lastmonth())	
						->where('year',$this->get_year())	
						->get()->result();
			foreach ($mainPro as $k) 
			{
				$basic			= $k->basic;			
				$DA 			= $k->DA;
				$VPF			= $k->VPF;
				$monthly_gross 	= $k->monthly_gross;
				$name_slash 	= $k->name;				
				$entity_name 	= $k->entity_name;
				$month_days 	= $k->Month_Days;
				$paid_days		= $k->paid_days;
				$empid 			= $k->empid;
				$epfwages 		= $k->epf_wages;
				$name 			= addslashes($name_slash);
				$refund			= 0;
				$age_year		= $k->age_year;
				$age_month		= $k->age_month;
				$uan_no			= $k->uan_no;
				$birth_date		= $k->birth_date;
				$ul_pf 			= $k->ul_pf;
				$join_date		=$k->join_date;
				$exit_date		= $k->exit_date;				
				
				$age=$this->get_year()-$age_year;//2019-1995=24
				if($age_month<=$this->lastmonth())//11 wrong condition
				{
					$age;
				}
				else
				{
					$age=$age-1;
				}
				//-----------condition related to epfwages-------------------//
					
				if($ul_pf <= $epfwages and $ul_pf!='0')
				{	
						$epfwages=$ul_pf;
				}
				else
				{
					$epfwages=$epfwages;
				}

				$epswages=$basic+$DA;

				if($epswages>='15000' && $age<'58')
				{
					$epswages="15000";
				}
				else if($epswages<'15000' and $age<'58')
				{
					$epswages=$epfwages;
				}
				else if($age>='58' && ($epswages>='15000' || $epswages<='15000'))
				{
					$epswages="0";
				}
			//echo "</br>";
				//---------condition related to edliwages------------//
				if($epfwages>='15000')
				{
					$edliwages="15000";
				}
				else if($epfwages<'15000')
				{
					$edliwages=$epfwages;
				}else{
					$edliwages="0";
				}

				//----------condition related to epf contribution------------------//

				$epfcontri=((($epfwages*12)/100)+$VPF);
				$epfcontri=round($epfcontri);
				
				//----------condition related to eps contrbution-------------------//

				$epscontri=(($epswages*8.33)/100);
				$epscontri1=round($epscontri);
				
				//----------condition  related to Employer difference Contribution---------//

				$epfepsdiff=(round(($epfwages*12)/100)-$epscontri1);


				
	
			
				$join_pieces = explode("-", $join_date);//
				$join_year=$join_pieces[0];//2018 
				$join_month=$join_pieces[1];//12
				$join_days=$join_pieces[2]-1;//26

				//--------calculation for exit date---------//
			
				$exit_pieces = explode("-", $exit_date);//
				$exit_year=$exit_pieces[0];//2018
				$exit_month=$exit_pieces[1];//12
				$exit_days=$exit_pieces[2];//26

				$currmonth=date("F");//Janaury
				$lastmonth=Date('m', strtotime($currmonth . " last month"));//12

				$curryear=date("Y");//2019
				$lastyear=Date('Y', strtotime($curryear . " last year"));//2018


				if($lastmonth==12)
				{
					if($join_month==$lastmonth && $join_year==$lastyear)
					{
						$ncp=$month_days-$join_days-$paid_days;
					}
					else if($exit_month==$lastmonth && $exit_year==$lastyear)
					{
						$ncp=$month_days-$exit_days;
					}
					else
					{
						$ncp=$month_days-$paid_days;
					}
				}
				else
				{
					if($join_month==$lastmonth && $join_year==$curryear)
					{
						$ncp=$month_days-$join_days-$paid_days;
					}
					else if($exit_month==$lastmonth && $exit_year==$curryear)
					{
						$ncp=$month_days-$exit_days;
					}
					else
					{
						$ncp=$month_days-$paid_days;
					}
				}

				$pf[]=array(
					'spgid'=>$spg,
					'entity_name'=> $entity_name,
					'empid'=>$key->empid,
					'UANno'=>$uan_no,
					'custid'=> $cust,
					'member_name'=>$name,
					'gross_wages'=> $monthly_gross,
					'EPF_wages'=>$epfwages,
					 'EPS_wages'=> $epswages,
					'EDLI_wages'=> $edliwages,
					'EPF_contri_remitted'=>$epfcontri,
					'EPS_contri_remitted'=>$epscontri,
				    'EPS_EPF_diff'=>$epfepsdiff,
				    'NCP_days'=>$ncp,
			        'refund_advance'=>$refund,
			        'month'=>$this->lastmonth(),
			        'year'=>$this->get_year(),
			        'flag'=>'1'					      
				);
			}
			
		}

		echo "<pre>";
		var_dump($pf);
		$this->newdb->insert_batch('pf_template',$pf);
		

	}



	/* 
		CREATE PF PROCESS COMPANY WIZE 
	*/
	public function CreateESICProcess($spg,$cust)
	{
		ini_set('memory_limit', '128M');
		$this->remove('esic_template',array('spgid'=>$spg,'custid' =>$cust,'month'=>$this->lastmonth(),'year'=>$this->get_year()));
		
		$esic=[];
		$pro=$this->fetch('master_process','spgid,custid,empid',array('spgid'=>$spg,'custid' =>$cust,'month'=>$this->lastmonth(),'year'=>$this->get_year()))->result();
		$count=0;
		foreach ($pro as $key) {
		$count++;
			$mainPro=$this->newdb->select('*')
						->from('employee_master_new b')						
						->join('salary_master c', 'b.spgid=c.spgid AND b.custid=c.custid')
						->where('b.emp_id',$key->empid)		
						->where('c.empid',$key->empid)
						->where('c.custid',$cust)
						->where('b.custid',$cust)
						->where('month',$this->lastmonth())	
						->where('year',$this->get_year())	
						->get()->result();
			foreach ($mainPro as $k) 
			{				
				$empid 		 	= $k->empid;			
				$entity_name 	= $k->entity_name;
				$name 			= $k->name;
				$monthly_gross 	= $k->monthly_gross;
				$esicno			= $k->esic_no;
				$paid_days 		= $k->paid_days;
				$reason_code 	= !empty($k->reason_code)?$k->reason_code:11;
				$fix_gross 		= $k->fixgross;				
				$exit_date		= $k->exit_date;
				$date 			= date("d-m-Y");
				$year 			= date('m-d', strtotime($date));
				$current_year	= date('Y', strtotime($date));
				$last_date 		= '09-30';
				$last_dat 		= '03-31';

				if($fix_gross>21000 and ($year='10-01' || $year='03-01'))
				{
            		$paid_days = '0';
	 			} 
	 			else
 				{ 
 					$paid_days= $paid_days;
 				}
				 //--------------------reason code------------------//
				 if($fix_gross>21000 and ($year='10-01' || $year='04-01'))
				 {
            		$reason_code_1 = '4';			                    		
			     }
			     elseif($paid_days == 0)
			     {
          			$reason_code_1 = $reason_code; 
          		 }
      			 else
      			 {
      				$reason_code_1 = '0';
      			 }


		        //--------------------------exit date-----------------//
		        if($reason_code_1 == 2 || $reason_code_1 == 3 || $reason_code_1 == 5 || $reason_code_1 == 6 || $reason_code_1 == 10|| $reason_code_1 == 11)
		        {
		        	$date=$exit_date;                    	
		        }                 
		        else
		        {
		        	$date='0';
		        }

		        //-----------------------monthly wages----------------------------//
		         if($fix_gross>21000){
		         	$monthly_gross_1=0;
		         }else{
		         	$monthly_gross_1=$monthly_gross;
		         }	

				

				$esic[]=array(
					'spgid'=>$spg,
					'entity_name'=> $entity_name,
					'empid'=>$key->empid,
					'name'=>$name,
					'custid'=> $cust,
					'esicno'=>$esicno,
					'no_of_days'=> $paid_days,
					'monthly_wages'=>$monthly_gross_1,
					 'reason_code'=> $reason_code_1,
					'last_working_day'=> $date,
					'flag'=>'1',					
			        'month'=>$this->lastmonth(),
			        'year'=>$this->get_year(),
			        'flag'=>'1'					      
				);

				
			}
			
		}

		echo "<pre>";
		var_dump($esic);

		$this->newdb->insert_batch('esic_template',$esic);
		

	}


	


	


}	