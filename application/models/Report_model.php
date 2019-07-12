<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core/Base_model.php";
class Report_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
			$this->load->library('Excel');
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
	/* Get don't match data in employee master and salary master */
	public function backlog_process($value='')
	{
		$select="SELECT a.spgid,a.custid,a.entity_name,a.emp_id AS emp, IF(b.empid = NULL,'YES','NO') AS is_sal FROM employee_master_new a LEFT OUTER JOIN salary_master b ON a.spgid=b.spgid AND a.custid=b.custid AND a.emp_id=b.empid WHERE b.empid IS NULL
			UNION
			SELECT b.spgid,b.custid,b.entity_name,b.empid AS emp, IF(a.emp_id = NULL,'NO','YES') AS is_sal FROM employee_master_new a RIGHT OUTER JOIN salary_master b ON a.spgid=b.spgid AND a.custid=b.custid AND a.emp_id=b.empid  WHERE a.emp_id IS NULL";

		$m_backlog=$this->newdb->query($select)
							->result();
		return $m_backlog;
	}
	/* Get all data in backolog process table */
	public function get_BacklogTable()
	{		
		$backlog=$this->newdb->select("a.spgid,a.month,a.year, a.custid,b.entity_name,SUM(IF(a.is_sal='NO',1,0)) AS diffempdata, SUM(IF(a.is_sal='YES',1,0)) AS diffsaldata")
							->from('backlog_process AS a')
							->join('customer_master AS b ','a.spgid=b.allianceid AND a.custid=b.custid')
							->group_by(array("a.spgid", "a.custid"))
							->get()
							->result();						
		return $backlog;
	}
	/* Get compair data in employee master and salary master  */
	public function get_MasterProcess($value='')
	{
			$sal_backlog=$this->newdb->select('s.spgid,s.custid,s.entity_name, s.empid,s.month,s.year')
							->from('employee_master_new AS e')
							->join('salary_master AS s','s.spgid=e.spgid AND s.custid=e.custid AND s.empid=e.emp_id')
							->where('s.month' ,$this->lastmonth())
							->where('s.year' ,$this->get_year())
							->group_by('s.empid ')
							->get()
							->result();
	// $select="SELECT DISTINCT `s`.`spgid`, `s`.`custid`, `s`.`entity_name`, `s`.`empid`, `s`.`month`, `s`.`year` FROM `employee_master_new` AS `e` JOIN `salary_master` AS `s` ON `s`.`spgid`=`e`.`spgid` AND `s`.`custid`=`e`.`custid` AND `s`.`empid`=`e`.`emp_id` WHERE `s`.`month` = '".$this->lastmonth()."' AND `s`.`year` = '".$this->get_year()."' GROUP BY `s`.`empid`";						
	// 	$sal_backlog=$this->newdb->query($select)
	// 						->result();
		return $sal_backlog;
	}


	/* genrate sanitize report main process start*/
	public function CreateSanitizeReport($value='')
	{
		$setData_master=[];
		$editData_master=[];
		$editBacklogData =[];
		$setBacklogData =[];		
		/*
			backlog process
		*/
		$backlogData=$this->backlog_process();
		foreach ($backlogData as $log) 
		{
			if ($this->is_exist('backlog_process',array('spgid' => $log->spgid,
										'custid'	=>$log->custid,
										'empid' 	=>$log->emp,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year()
		 						))== TRUE) 
			{
				//data already insert then updata the data
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
				// insert data
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
				//data already inserted then updataed
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
				//insert data
			$setData_master[] = array('spgid' 	=> $put->spgid,
										'custid'	=>$put->custid,
										'entity_name'=>$put->entity_name,
										'empid' 	=>$put->empid,
										'month' 	=>$this->lastmonth(),
										'year'		=>$this->get_year()
		 						);
			}
		}

		// echo "<pre>";
		
		if (!empty($setData_master)) {
			// echo "master process first time <br>";
			// echo sizeof($setData_master);
			$this->newdb->insert_batch('master_process',$setData_master);
			$D=TRUE;
		}
		if (!empty($editData_master)) {
			# code...
			// echo "master process already <br>";
			// echo sizeof($editData_master);
			// $this->newdb->update_batch('master_process', $editData_master,'spgid,custid,empid'); 
			$D=TRUE;
		}
		if (!empty($setBacklogData)) {
			# code...
			// echo "backlog process first time <br>";
			// var_dump($setBacklogData);
			$this->newdb->insert_batch('backlog_process',$setBacklogData);
			$D=TRUE;
		}
		if (!empty($editBacklogData)) {
			# code...
			// echo "backlog process already <br>";
			// echo sizeof($editBacklogData);
			// $this->db->update_batch('backlog_process', $editBacklogData,'spgid,custid,empid');
			$D=TRUE; 
		}

		return $D;

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
		//all custid get form customer master
		$getData=$this->getCust();
		$returnData=[];
		foreach ($getData as $key ) {

			$returnData[] = array('custid' => $key->custid,
								'comp_name'=> $key->entity_name,
								'emp_data' => $this->emp_data($key->custid),
								'sal_data' => $this->sal_data($key->custid),
								'diff_emp'	=>$this->diff_emp($key->custid),
								'diff_sal'  =>$this->diff_sal($key->custid),
								'date'		=> $this->lastmonth()
			 );
		}
		return $returnData;
	}
	private function getCust()
	{
		if (IS_SPG== TRUE)
		{
			$cust=$this->newdb->select('b.custid,b.entity_name')
						// ->from('compliance_scope a')
						->from('customer_master a')
						->join('customer_master b', 'a.custid=b.custid')
						->where('a.allianceid',user_id())
						->group_by('a.custid')
						->order_by('b.entity_name')
						->get()->result();
			return $cust;
		}  
		elseif (IS_SPGUSER== TRUE)
		{
			$cust=$this->newdb->select('b.custid,b.entity_name')
						// ->from('compliance_scope a')
						->from('customer_master a')
						->join('add_companies_for_users b', 'a.custid=b.custid')
						->where(array('a.allianceid'=>user_id(),'b.username'=>USERNAME))
						->group_by('a.custid')
						->order_by('b.entity_name')
						->get()->result();
			return $cust;
		}
		
	}

	private function emp_data($id='')
	{
		$emps=$this->newdb->select('count(emp_id) as emp')->from('employee_master_new')->where('custid',$id)->where('uan_no !=','N/A')->get()->row()->emp;
		return $emps;
	}
	private function sal_data($id='')
	{
		$sal=$this->newdb->select('count(empid) AS salary')->from('salary_master')->where(array('custid' => $id, 'month' =>$this->lastmonth(),'year'=>$this->get_year()))->get()->row()->salary;
		return $sal;
	}
	private function diff_sal($id='',$d='')
	{		
		$this->newdb->select('emp_id');
		$this->newdb->from('employee_master_new');
		$this->newdb->where('custid',$id);
		$this->newdb->where('uan_no !=','N/A');
		$where_clause = $this->newdb->get_compiled_select();

		#Create main query
		$this->newdb->select('count(empid) as empid');//
		$this->newdb->from('salary_master a');
		$this->newdb->where('a.custid',$id);
		$this->newdb->where('a.month',$this->lastmonth());
		$this->newdb->where('a.year',$this->get_year());	
		if (!empty($d) && $d == 'IN') {
		$this->newdb->where("a.empid IN ($where_clause)", NULL, FALSE);		
		}
		else{	
		$this->newdb->where("a.empid NOT IN ($where_clause)", NULL, FALSE);
		}
		$emps=$this->newdb->get()->row()->empid;
		return $emps;
	}
	
	private function diff_emp($id='',$d='')
	{
		$this->newdb->select('empid');
		$this->newdb->from('salary_master');
		$this->newdb->where('custid',$id);
		$this->newdb->where('month',$this->lastmonth());
		$this->newdb->where('year',$this->get_year());	
		$where_clause = $this->newdb->get_compiled_select();

		#Create main query
		$this->newdb->select('count(a.emp_id) as emp_id');//
		$this->newdb->from('employee_master_new a');
		$this->newdb->where('a.custid',$id);
		$this->newdb->where('a.uan_no !=','N/A');	
		if (!empty($d) && $d == 'IN') {		
		$this->newdb->where("a.emp_id IN ($where_clause)", NULL, FALSE);
		}
		else
		{
			$this->newdb->where("a.emp_id NOT IN ($where_clause)", NULL, FALSE);
		}
		$emps=$this->newdb->get()->row()->emp_id;
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
						->where('b.pf_deduct','Yes')
						->where('b.uan_no !=','N/A')
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
				// echo "epfwages".$epfwages;
				// exit();				
				
				$age=$this->get_year()-$age_year;//2019-1995=24
				// echo "birth date:".$birth_date."<br>";
				if($age_month<=$this->lastmonth())
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
						// echo "ul epfwages:".$epfwages;
				}
				else
				{
					$epfwages=$epfwages;
					// echo "epfwages:".$epfwages;

				}
				// exit();

				$epswages=$basic+$DA;
			// 	echo "</br>";
			// echo $age;
			// echo "</br>";
			// exit();

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
					// echo "dk";
					$epswages="0";
				}
	// 			echo $epswages;
	// exit();

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

		// echo "<pre>";
		// var_dump($pf);
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
						->where('b.esic_deduct','Yes')
						->where('b.uan_no !=','N/A')
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

		// echo "<pre>";
		// var_dump($esic);

		$this->newdb->insert_batch('esic_template',$esic);
		

	}

	/* get pf data from pf template table */
	public function get_newPF($spgid,$custid,$month,$year,$location='')
	{
		return $this->fetch('pf_template','custid,entity_name,empid,member_name,UANno,gross_wages,EPF_wages,EPS_wages,EDLI_wages,EPF_contri_remitted,EPS_EPF_diff,NCP_days,refund_advance,month,year',array('spgid' =>$spgid,
													'custid'=>$custid,
													'month'	=>$month,
													'year'	=>$year
													// 'loc'	=>$location
													))->result();
	}

	/* get pf data from pf history table */
	public function get_oldPF($spgid,$custid,$month,$year,$location='')
	{
		//change after create pf_history table
		return $this->fetch('pf_template','*',array('spgid' =>$spgid,
													'custid'=>$custid,
													'month'	=>$month,
													'year'	=>$year
													// 'loc'	=>$location
													))->result();
	}



	/* export backlog data in excel sheet */
	//  export employee data in excel sheet for editable 
	public function export_EmployeeBacklog($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);
																	

		$table_cols = array("CustiID","Entity Name","Employee Name","Empid","Gender","Marital Status","PF deduction","PF Upper Limit","ESIC Deduction","ESIC No","UAN No","Branch","Department","Designation","Father/Husband Name","Relations DOB","Relations Adhar no","Relations Name","Relations Age","Nomination1","Nomination2","Nomination3","Nomination4","Email","Phone","Permant Address","Temporary Address","Pan No","Name as per PAN Card","Adhar No","Name as per Adhar Card","Bank Account No","IFSC Code","Bank Name","Bank Branch","DOB as per Adhar Card","Education Qualification","Employee Status","Physically handicap","Physically handicap Category","Birth Date","Join Date","Membership Date","Exit Date","International Worker","Vendor ID","Contractor Name","Location");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('b.*')
							  ->from('backlog_process AS a')
							  ->join('salary_master AS b','a.spgid=b.spgid AND a.custid=b.custid AND a.empid=b.empid')
							  ->where(array('a.spgid'=>$spgid,'a.custid' => $custid,'a.is_sal' => 'YES'))
							  ->group_by('a.empid')
							  ->get()
							  ->result();	
		
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->empid);
			for ($i=4; $i < 49; $i++) { 
				$obj->getActiveSheet()->setCellValueByColumnAndRow($i,$start_row,'');
			}
			$start_row++;
			// $comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	    header('Content-Disposition: attachment;filename="BacklogEmployee.xlsx"');
		$obj_writer->save('php://output');


	}
	//  export salary data in excel sheet for editable
	public function export_SalaryBacklog($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);											
			 	 				

		$table_cols = array("CustiID","Entity Name","Empid","PF No","ESIC No","Employee Name","Month Days","Paid Days","Fix Gross","Basic","Dearness Allowance(DA)","House Rent Allowance(HRA)","Convenience Allowance(CA)","CCA","Education Allowance(EA)","Other Rembusment(OR)","Other Allowance(OA)","Overtime(OT)","Washing Allounce(WA)","LTA","Monthly Gross","PF","VPF","ESIC","PT","IT","LWF","Other Deduction(OD)","Net Pay","Payment Mode","Year","Month","EPF Wages","Total Deduction");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('b.*')
							  ->from('backlog_process AS a')
							  ->join('employee_master_new AS b','a.spgid=b.spgid AND a.custid=b.custid AND a.empid=b.emp_id')
							  ->where(array('a.spgid'=>$spgid,'a.custid' => $custid,'a.is_sal' => 'NO'))
							  ->group_by('a.empid')
							  ->get()
							  ->result();	
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->emp_id);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->emp_name);
			for ($i=6; $i < 34; $i++) { 
				$obj->getActiveSheet()->setCellValueByColumnAndRow($i,$start_row,'');
			}
			$start_row++;
			$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'BacklogSalary.xlsx"');
		$obj_writer->save('php://output');

	}



	/* EXPORT PF REPORT COMPANY WIZE */
	public function DownloadPFReport($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("custid","entity_name","empid","UANno","member_name","gross_wages","EPF_wages","EPS_wages","EDLI_wages","EPF_contri_remitted","EPS_contri_remitted","EPS_EPF_diff","NCP_days","refund_advance","month","year","flag","created_at");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('*')
							  ->from('pf_template')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid))
							  ->group_by('empid')
							  ->get()
							  ->result();	
		$start_row = 2;

		foreach ($emp_data as $key) {

			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->UANno);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->member_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->gross_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->EPF_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->EPS_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->EDLI_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->EPF_contri_remitted);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->EPS_contri_remitted);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->EPS_EPF_diff);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->NCP_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->refund_advance);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->month);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->year);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->flag);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->created_at);
			
			$start_row++;
			$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'PFReport.xlsx"');
		$obj_writer->save('php://output');
	}

	/* EXPORT ESIC REPORT COMPANY WIZE */
	public function DownloadESICReport($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("custid","entity_name","empid","esicno","name","no_of_days","monthly_wages","reason_code","last_working_day","month","year","flag","created_at");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('*')
							  ->from('esic_template')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid))
							  ->group_by('empid')
							  ->get()
							  ->result();	
		$start_row = 2;

		foreach ($emp_data as $key) {

			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->esicno);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->no_of_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->monthly_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->reason_code);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->last_working_day);
		
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->month);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->year);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->flag);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->created_at);
			
			$start_row++;
			$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'ESICReport.xlsx"');
		$obj_writer->save('php://output');
	}

	/* get PF new joinee data from employee master new table */
	public function get_pfnewjoinee($spgid,$custid)
	{
		//displaying data from table		
		return $this->db->select("custid,entity_name,emp_name,uan_no,dobadhr,gender,fath_hus_name,if(fath_hus_name!=NULL,`fath_hus_name`,'NIL'),marital_status,mob,email,join_date,bank_ac,ifsc,nameinbank,pan,namepan,adhaar,nameadhr")
							->from('employee_master_new')
							->where(array(	'spgid' =>$spgid,
											'custid'=>$custid,
											'uan_no'=>'0',
											'uan_no'=>' '
										))
							
							->get()
							->result();
	}

	/* get PF Summary data from pf_template table */
	public function get_newPfSummary($spgid,$custid,$month,$year)
	{
		$this->db->select("count(member_name) as name,sum(gross_wages) as gross,sum(EPF_wages) as epfwages,sum(EPS_wages) as epswages,sum(EDLI_wages) as edliwages,sum(EPF_contri_remitted) as epfcontri,sum(EPS_contri_remitted) as epscontri,sum(EPS_EPF_diff) as diff,CAST(((sum(EPF_wages)*0.5)/100) as UNSIGNED)as admin,CAST(((sum(EDLI_wages)*0.5)/100) as UNSIGNED) as other,CAST(((sum(EPF_contri_remitted))+(sum(EPS_contri_remitted))+(sum(EPS_EPF_diff))+(((sum(EPF_wages)*0.5)/100))+(((sum(EDLI_wages)*0.5)/100))) as UNSIGNED) as total");

						$this->db->from('pf_template');					
						$this->db->where(array(	'spgid' => $spgid,
										'custid' => $custid,
										'month'	 => $month,
										'year'	 => $year,
										'UANno!=' => 0   ));
						$result=$this->db->get()->result();
						return $result;
	}

	/* get PF Summary data from pf_template_history table */
	public function get_oldPfSummary($spgid,$custid,$month,$year)
	{		 
		$this->db->select("count(member_name) as name,sum(gross_wages) as gross,sum(EPF_wages) as epfwages,sum(EPS_wages) as epswages,sum(EDLI_wages) as edliwages,sum(EPF_contri_remitted) as epfcontri,sum(EPS_contri_remitted) as epscontri,sum(EPS_EPF_diff) as diff,CAST(((sum(EPF_wages)*0.5)/100) as UNSIGNED)as admin,CAST(((sum(EDLI_wages)*0.5)/100) as UNSIGNED) as other,CAST(((sum(EPF_contri_remitted))+(sum(EPS_contri_remitted))+(sum(EPS_EPF_diff))+(((sum(EPF_wages)*0.5)/100))+(((sum(EDLI_wages)*0.5)/100))) as UNSIGNED) as total");

						$this->db->from('pf_template_history');		
						$this->db->where(array(	'spgid' => $spgid,
										'custid' => $custid,
										'month'	 => $month,
										'year'	 => $year,
										'UANno!=' => 0   ));
						$result=$this->db->get()->result();
						return $result;
	}

	/* get esic new joinee data from employee master new table */
	public function get_esicnewjoinee($spgid,$custid)
	{
		//displaying data from table		
		return $this->db->select("custid,entity_name,nameadhr,fath_hus_name,if(fath_hus_name!=NULL,`fath_hus_name`,'NIL'),birth_date,join_date,gender,marital_status,mob,adhaar,temp_address,per_address,relname,reldob,relage,if(relname!=NULL,`relname`,'NIL'),reladhr,if(reladhr!=NULL,`reladhr`,'NIL')")
							->from('employee_master_new')
							->where(array(	'spgid' =>$spgid,
											'custid'=>$custid,
											'esic_no'=>'0'))
							->get()
							->result();
	}

	/* get ESIC data from esic_template table */
	public function get_newEsicTemplate($spgid,$custid,$month,$year)
	{
		return $this->db->select("esicno,name,no_of_days,monthly_wages,reason_code,last_working_day")
						->from('esic_template')
						
						->where(array(	'spgid' => $spgid,
										'custid' => $custid,
										'month'	 => $month,
										'year'	 => $year   ))
						->get()->result();

						//print_r($result1);
	}

	/* get esic data from esic_template_history table */
	public function get_oldEsicTemplate($spgid,$custid,$month,$year)
	{
		//change after create esic_template_history table
		return $this->db->select("esicno,name,no_of_days,monthly_wages,reason_code,last_working_day")
						->from('esic_template_history')
						
						->where(array(	'spgid' => $spgid,
										'custid' => $custid,
										'month'	 => $month,
										'year'	 => $year   ))
						->get()->result();
	}

	/* get ESIC data (EmpID) from esic_template table */
	public function get_newEsicTemplate_empid($spgid,$custid,$month,$year,$location)
	{
//=====Note: CAST(value as UNSIGNED) in mysql query is used to get integer values======//
				$this->db->select("a.esicno,a.empid,a.name,a.no_of_days,a.monthly_wages,CAST(((a.monthly_wages*1.75)/100) as UNSIGNED) as emp_contri,CAST(((a.monthly_wages*4.75)/100) as UNSIGNED) as empr_contri,a.reason_code,a.last_working_day,b.join_date,b.birth_date,b.vendor_id,b.contractor_name,b.location");
				$this->db->from('esic_template a');
				$this->db->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
				if($location=="ALL")
				{
				$this->db->where(array(	'a.spgid'    => $spgid,
											'a.custid'   => $custid,
											'a.month'	 => $month,
											'a.year'	 => $year   ));
				}
				else
				{
				$this->db->where(array(	'a.spgid'    => $spgid,
											'a.custid'   => $custid,
											'a.month'	 => $month,
											'a.year'	 => $year,
											'b.location' => $location  ));
				}			
				$result = $this->db->get()->result();
				return $result;
	}

	/* get esic data from esic_template_history table */
	public function get_oldEsicTemplate_empid($spgid,$custid,$month,$year,$location)
	{
		//change after create esic_template_history table
//Note: CAST(value as UNSIGNED) in mysql query is used to get integer values//
		$this->db->select("a.esicno,a.empid,a.name,a.no_of_days,a.monthly_wages,CAST(((a.monthly_wages*1.75)/100) as UNSIGNED) as emp_contri,CAST(((a.monthly_wages*4.75)/100) as UNSIGNED) as empr_contri,a.reason_code,a.last_working_day,b.join_date,b.birth_date,b.vendor_id,b.contractor_name,b.location");
				$this->db->from('esic_template_history a');
				$this->db->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
				if($location=="ALL")
				{
				$this->db->where(array(	'a.spgid'    => $spgid,
											'a.custid'   => $custid,
											'a.month'	 => $month,
											'a.year'	 => $year   ));
				}
				else
				{
				$this->db->where(array(	'a.spgid'    => $spgid,
											'a.custid'   => $custid,
											'a.month'	 => $month,
											'a.year'	 => $year,
											'b.location' => $location  ));
				}			
				$result = $this->db->get()->result();
				return $result;		
	}

	/* get Esic Summary data from esic_template table */
	public function get_newEsicSummary($spgid,$custid,$month,$year)
	{
		//echo "hi";
		$this->newdb->select("CAST(sum(a.monthly_wages*(1.75/100))) as UNSIGNED) as eps_contri,CAST(sum((a.monthly_wages)*4.75/100) as UNSIGNED) as total_contri,CAST(((sum((a.monthly_wages*(1.75/100))))+(sum((a.monthly_wages)*4.75/100))) as UNSIGNED) as grand,if(monthly_wages!=NULL,`monthly_wages`,'-'),sum(a.monthly_wages) as gross_wages");
						$this->newdb->from('esic_template a');
						$this->newdb->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
						
						$this->newdb->where(array(	'a.spgid' => $spgid,
										'a.custid' => $custid,
										'a.month'	 => $month,
										'a.year'	 => $year,
										'b.esic_deduct'=>'Yes'   ));
						return $result=$this->newdb->get()->result();
						
	}

	/* get Esic Summary data from esic_template_history table */
	public function get_oldEsicSummary($spgid,$custid,$month,$year)
	{
		 $this->newdb->select("CAST(sum((a.monthly_wages*(1.75/100))) as UNSIGNED) as eps_contri,CAST(sum((a.monthly_wages)*4.75/100) as UNSIGNED) as total_contri,CAST(((sum((a.monthly_wages*(1.75/100))))+(sum((a.monthly_wages)*4.75/100))) as UNSIGNED) as grand,if(monthly_wages!=NULL,`monthly_wages`,'-'),sum(a.monthly_wages) as gross_wages");
						$this->newdb->from('esic_template_history a');
						$this->newdb->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
						
						$this->newdb->where(array(	'a.spgid' => $spgid,
										'a.custid' => $custid,
										'a.month'	 => $month,
										'a.year'	 => $year,
										'b.esic_deduct'=>'Yes'   ));
						$result=$this->newdb->get()->result();
						return $result;

	}

	/* get Compliance data from completed_compliance table */
	public function get_compliance($spgid,$custid)
	{
		//displaying data from table		
	return $this->newdb->select("a.custid,a.entity_name,b.Particular,b.Statutory_due_date,b.Task_complitn_date,b.`Retrn_Challan_genrtn_date`,b.`Submisn_Pay_date`,b.Docu_submit_to_GOVT_in_nos,b.Pend_docu_in_nos,b.Copy_of_docu,b.Resp_prsn_frm_client,b.Resp_prsn,b.Remarks")
						->from('customer_master a')
						->join('completed_compliance b', 'a.custid=b.custid')
						->where(array(	'b.spg_id' =>$spgid,
											'b.custid'=>$custid))
						->get()->result();
	}

	/* get Approval data from completed_compliance table */
	public function get_approval($spgid,$custid)
	{
		//displaying data from table		
			$this->newdb->select("a.custid ,b.entity_name,a.year,a.act,a.Particular,a.Reg_freq,a.Statutory_due_date,a.act_type,a.Certi_rece_date");
			$this->newdb->from('customer_master b');
			$this->newdb->join('completed_compliance a', 'a.custid=b.custid');
			$where="`a`.`spg_id` =".$spgid." AND a.custid =".$custid." AND MONTH(a.due_date) = MONTH(CURRENT_DATE())";
			$this->newdb->where($where);
			$result = $this->newdb->get()->result();
		 	return $result;
	}

	/* get Rejected data from compliance_working_prior table */
	public function get_rejected($spgid,$custid)
	{
		//displaying data from table		
		 	return $this->newdb->select("a.custid ,b.entity_name,a.year,a.act,a.Particular,a.Reg_freq,a.Statutory_due_date,a.act_type,a.Certi_rece_date")
						->from('customer_master b')
						->join('compliance_working_prior a', 'a.custid=b.custid')
						->where(array(	'a.spg_id' =>$spgid,
										'a.custid' =>$custid,
										'a.status' =>'4'))
						->get()->result();
	}

	/* get non Compliance data from compliance_working_prior table */
	public function get_noncompliance($spgid,$custid)
	{
		//displaying data from table		
	return $this->newdb->select("a.custid,a.entity_name,b.Particular,b.Statutory_due_date,b.Task_complitn_date,b.`Retrn_Challan_genrtn_date`,b.`Submisn_Pay_date`,b.Docu_submit_to_GOVT_in_nos,b.Pend_docu_in_nos,b.Copy_of_docu,b.Resp_prsn_frm_client,b.Resp_prsn,b.Remarks")
						->from('customer_master a')
						->join('compliance_working_prior b', 'a.custid=b.custid')
						->where(array(	'b.spg_id' =>$spgid,
											'b.custid'=>$custid))
						->get()->result();
	}

	/* get Compliance document data from comp_doc_temp table */
	public function get_compliancedocument($spgid,$custid,$cname)
	{
		//displaying data from table
			$this->db->select("*");
			$this->db->from('DOC_UP');
			$this->db->like('custid', $custid);
			$result=$this->db->get()->result();
			return $result;
	}

	/* get entity Details data from customer_master table */
	public function get_entitydetails()
	{

		//displaying data from table
		// $spgid=$this->session->SESS_CUST_ID;
		if (IS_SPG== TRUE)
		{
			return $this->db->select("custid,entity_name")

			//return $this->newdb->select("custid,entity_name")

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

	/* get Employee Details data from employee_master_new table */
	public function get_employeedetails($spgid,$custid,$location)
	{
		//displaying data from table		
			$this->newdb->select("custid,entity_name,emp_id,emp_name,gender,fath_hus_name,marital_status,designation,mob,email,join_date,birth_date,uan_no,esic_no,pan,bank_name,bank_branch,ifsc,bank_ac,adhaar,location");
			$this->newdb->from('employee_master_new');
			if($location=="ALL")
			{
				$this->newdb->where(array(	'custid'=>$custid,'spgid' =>$spgid));
			}
			else
			{
				$this->newdb->where(array(	'custid'=>$custid,'spgid' =>$spgid,'location'=>$location));
			}			
			$result=$this->newdb->get()->result();
			return $result;
	}

	/* get location data from employee_master_new table */
	public function get_location()
	{
		//displaying data from table
			return $this->newdb->select("location")
							->from('employee_master_new')
							//->where('location != ',NULL,FALSE);
							->where(array(	'location!=' =>NULL))
							->group_by(array("location"))
							->get()->result();
	}

	/* get Compliance Request Details data from act_particular table */
	public function get_compliancerequest()
	{
		//displaying data from table
			return $this->newdb->select("a.act,a.particular,b.name")
							->from('act_particular a')
							->join('act_applicable_to_customer b', 'a.act_code=b.act_code')
							->where(array(	'a.comp_req' =>'YES'))
							->get()->result();
	}

	/* get salary Details data from salary_master_history table */
	public function get_salarydetails($spgid,$custid)
	{
		//displaying data from table
				$this->newdb->select("custid,entity_name,count(empid) emp,month,year");
				$this->newdb->from('salary_master_history');
				$this->newdb->where(array(	'custid'=>$custid,'spgid' =>$spgid));
				$this->newdb->group_by(array("MONTH(present_date)"));
				$result=$this->newdb->get()->result();			
				return $result;
	}

	/* get SPG users data from uu_companyselection,compliance_working_prior table */
	public function get_spgusers()
	{
		//displaying data from table     
			return $this->newdb->select("a.username,count(*) as total,date(b.date) as date")
							->from('add_companies_for_users a')
							->join('compliance_working_prior b', 'a.custid=b.custid')
							->where(array(	'b.status' =>'3'))
							->group_by(array(	'date(b.date)' ,'a.username'))
							->order_by('a.username','asc')
							->get()->result();
	}

	/* get form-d data from  */
	public function get_formd($spgid,$custid)
	{
		//displaying data from table      
			return $this->db->select("*")
							->from('employee_master_new')
							->where(array('uan_no'=>'N/A','custid'=>$custid,'spgid'=>$spgid))
							->get()->result();
	}

	/* get form-q data from employee_master_new,salary_master table */
	public function get_newformq($spgid,$custid,$month,$year,$location)
	{
			$this->newdb->select("*");
			$this->newdb->from('employee_master_new a');
			$this->newdb->join('salary_master b', 'a.emp_id=b.empid AND a.custid=b.custid');
			if($location=="ALL")
			{
			$this->newdb->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year   ));
			}
			else
			{
			$this->newdb->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year,
									'a.location' => $location  ));
			}
			$result=$this->newdb->get()->result();
			return $result;
	}

	/* get form-q data from employee_master_new,salary_master_history table */
	public function get_oldformq($spgid,$custid,$month,$year,$location)
	{
			$this->newdb->select("*");
			$this->newdb->from('employee_master_new a');
			$this->newdb->join('salary_master_history b','a.emp_id=b.empid AND a.custid=b.custid');
			if($location=="ALL")
			{
			$this->newdb->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year   ));
			}
			else
			{
			$this->newdb->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year,
									'a.location' => $location  ));
			}
			$result=$this->newdb->get()->result();
			return $result;
	}


}	