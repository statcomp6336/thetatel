<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Reports {
	
	public function GenrateSantizeRec($page_data='')
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');



	       ///$this->data['page_title'] = $page_data['page_title'];


		    $this->load->library("pagination");	      

	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Sanitize';
	     

	    
	       	// $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
	        // $config["total_rows"] = $this->emp->get_count();
	        // $config["per_page"] = 10;
	        // $config["uri_segment"] = 2;
	        //     $this->pagination->initialize($config);

	        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	       

	        // $this->data["links"] = $this->pagination->create_links();

	        // $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

	        $this->data['result'] = $this->report->get_SanitizeTable();
	       $this->render('sanitize_report');
	     }
	     else
	     {

	     $this->view->load('404');

	     }
	}
	public function CreateSanitize($value='')
	{
		$this->load->model('Report_model','report');
		$show=$this->report->CreateSanitizeReport();
		if ($show == TRUE) {
			$this->load->model('Act_model','timeline');
			
	
			$send['redirect']=$this->data['user_type'];
			// $send['custid']=hash_id($custid);
			// $send['url']='spg';
			// $send['event']=3;

			$this->load->view('success',$send);
		}
		else
		{
			echo "something went wrong";
		}
		
		// var_dump($show);
	}
	/* genrate process report*/
	public function GenrateProccessReport($page_data='')
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');
		    $this->load->library("pagination");


	      
	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Process';
	       

	    
	       	// $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
	        // $config["total_rows"] = $this->emp->get_count();
	        // $config["per_page"] = 10;
	        // $config["uri_segment"] = 2;
	        //     $this->pagination->initialize($config);

	        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	       

	        // $this->data["links"] = $this->pagination->create_links();

	        // $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

	        $this->data['result'] = $this->report->get_ProcessTable();
	       $this->render('process_report');
	     }
	     else
	     {

	     $this->load->view('404');

	     }
	}

	public function CreatePFReport($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 	 $spg = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	 $cust = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	$proc=$this->report->CreatePfProcess($spg,$cust);
	 	$this->timeline->update_timeline($cust,array('IS_PfProcess'=>2));
	 	$this->report->DownloadPFReport($spg,$cust);
	 	

	 }
	 public function DownloadPF()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	// echo $spg;
	 	// exit();
	 	$this->Export->PF($spg,$cust);
	 }
	public function CreateESICReport($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	$spg = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$cust = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	$this->timeline->update_timeline($cust,array('IS_PfProcess'=>3));
	 	$proc=$this->report->CreateESICProcess($spg,$cust);
	 		$this->report->DownloadESICReport($spg,$cust);
	 }

	 /* genrate process report*/
	public function GenrateBacklogReport($page_data='')
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');
		    $this->load->library("pagination");


	      
	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Backlog';
	      

	    
	       	// $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
	        // $config["total_rows"] = $this->emp->get_count();
	        // $config["per_page"] = 10;
	        // $config["uri_segment"] = 2;
	        //     $this->pagination->initialize($config);

	        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	       

	        // $this->data["links"] = $this->pagination->create_links();

	        // $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

	        $this->data['result'] = $this->report->get_BacklogTable();
	       $this->render('backlog_report');
	     }
	     else
	     {
	      $this->load->view('404');
	     }
	}

	public function ExportBacklog($value='')
	 {
	 	$this->load->model('Report_model','report');

	 	 $backlog = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	 $spg = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	 $cust = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 
	 	 if ($backlog == 'salary') {
	 	 	// echo "it is salary";
	 	 	$this->report->export_SalaryBacklog($spg,$cust);	 	 
	 	 }
	 	 elseif ($backlog == 'employee') {
	 	 
	 	 		// echo "its is employee";
	 	 	$this->report->export_EmployeeBacklog($spg,$cust);
	 	 }
	 	 else
	 	 {
	 	 	echo "not working key";
	 	 }
	 	// $proc=$this->report->CreatePfProcess($spg,$cust);
	 }
	 /* show pf report for export companiwise */
	 public function ShowCompanyPf($page_data = '')
	 {
	 		if (!empty($this->input->post('submit'))) {
$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
$month 		=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
$year 		=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) {


		 		    
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF Company';
			        
			        


		 		   
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF Company';
			      


			        /* table data */
			 		$this->data['tableHeading'] = "PF Template Reports";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/pf/'.$spgid.'/'.$custid.''),
														'button' =>'Download pf Excel',
														'class'	 =>'btn-success'
			 												),
			 										1 =>array(
			 											'link'=> base_url(),
														'button' =>'Download pf Text',
														'class'	 =>'btn-warning'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Company id","Company Name","Employee id","Employee Name","UAN No","Gross Wages","EPF Wages","EPS Wages","EDLI Wages","EPF Contri Remitted","EPS EPF Diff","NCP Days","Refound","Month","Year");
			 		//data	
			 		$this->data['tableData']=$this->GenratePf();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 	if ($this->data['access'][$this->session->TYPE] == TRUE) {
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");



		       
		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF Company';
		       


		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF Company';
		       


		    
		       	// $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
		        // $config["total_rows"] = $this->emp->get_count();
		        // $config["per_page"] = 10;
		        // $config["uri_segment"] = 2;
		        //     $this->pagination->initialize($config);

		        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		       

		        // $this->data["links"] = $this->pagination->create_links();

		        // $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

		        // $this->data['result'] = $this->report->get_BacklogTable();

		       // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();

			       	// All Location data
			       	$this->data['result1']=$this->report->get_location();

		       $this->render('export_pf');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		}     
	 }

	 /* genrate pf report with validation */
	 private function GenratePf($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 		=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 		=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
	 		$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) {
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") {
	 					// echo "1year and month are ALL";	 					
	 					put_msg('Please Select Year and Month');
	 					goto_back();
	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") {
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) {
	 						// echo "is last month";
	 						$result=$this->report->get_newPF($spgid,$custid,$month,$year,$location);
	 						return $result;
	 					}
	 					elseif (this_month($month,$year) == TRUE) {
	 						put_msg('till not genrate pf and esic report');
	 						goto_back();
	 					}
	 					// elseif (before_months($month,$year) == TRUE) {
	 					// 	put_msg('till not genrate pf and esic report');
	 					// 	goto_back();
	 					// }
	 					else
	 					{
	 						// echo "string";
	 						$result=$this->report->get_oldPF($spgid,$custid,$month,$year,$location);
	 						return $result;
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					goto_back();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					goto_back();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				goto_back();
	 			}
	 		}
	 		else{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	 	
	 }

	 /* show PF newjoinee report companiwise */
	 Public function ShowPFNewJoinee($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


		 		    
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF New Joinee';
			        



		 		    
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF New Joinee';
			      


			        /* table data */
			 		$this->data['tableHeading'] = "PF New Joinee Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/pfnewjoin/'.$spgid.'/'.$custid.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Custid","Company name","Name","UAN No.(if any)","DOB as per Aadhar","Gender","Fathers name","Spouse Name","Marital Status","Mobile NO","Email ID","Date of Joining","Bank Account no","IFSC code no","Name as per Bank A/c","PAN No","Name as per PAN card","AADHAAR","Name as per Aadhar card");
			 		//data	
			 		$this->data['tableData']=$this->GenratePfnewjoinee();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 	if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 	{
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");


		       
		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF New Joinee';
		       
		    
		      // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();


		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF New Joinee';    

		      


		       $this->render('export_pfnewjoinee');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		 }
	 }

	 /* genrate pf new joinee report with validation */
	 public function GenratePfnewjoinee($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				$result=$this->report->get_pfnewjoinee($spgid,$custid);
				return $result;
				//print_r($result);
				// var_dump($result); 
				// exit();					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	
	 }

	 /* download pf new joinee report in excel formate*/
	 public function DownloadPFnewjoinee()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	// echo $spg;
	 	// exit();
	 	$this->Export->PFnewjoinee($spg,$cust);
	 }

	 /* show PF summary report companiwise */
	 public function ShowPFSummary($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
			$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
			$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
			//$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		 
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF Summmary';
			        

			        /* table data */
			 		$this->data['tableHeading'] = "PF Summary Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											//'link'=> base_url(''.$page_data['user_type'].'/download/esictemplate/'.$spgid.'/'.$custid.'/'.$month.'/'.$year.''),
			 											'link'=> base_url(''.$this->data['user_type'].'/download/pfsummary/'.$spgid.'/'.$custid.'/'.$month.'/'.$year.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("NOE","Gross Salary","PF Sal","EPS Sal","EDLI Sal","PF","EPS","Co PF","Admin charges","Other Charges","Total");
			 		//data	
			 		$this->data['tableData']=$this->GenratePfSummary();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
			if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 	{
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");


		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF Summary';

		       //$this->data['user_type'] = $page_data['user_type'];
		       //$this->data['menu'] = $page_data['menu'];
		    	
		    	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails();      

		       $this->render('export_pfsummary');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		}
	 }

	 /* genrate PF Summary report with validation */
	 public function GenratePfSummary($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") 
	 				{	 					
	 					put_msg('Please Select Year and Month');
	 					goto_back();
	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") 
	 				{
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) 
	 					{
	 						 //echo "is last month";
	 						$result=$this->report->get_newPfSummary($spgid,$custid,$month,$year);
	 						return $result;
	 					}
	 					elseif (this_month($month,$year) == TRUE) 
	 					{
	 						put_msg('till not genrate pf and esic report');
	 						goto_back();
	 					}
	 					else
	 					{
	 						//echo "is old month";
	 						$result=$this->report->get_oldPfSummary($spgid,$custid,$month,$year);
	 						return $result;
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					goto_back();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					goto_back();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				goto_back();
	 			}					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	
	 }

	 /* download PF Summary report in excel formate*/
	 public function DownloadPFSummary()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	$month = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$year = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	
	 	if (is_last_month($month,$year) == TRUE) 
		{
			$check='new';
			$$this->Export->PFSummary($spg,$cust,$month,$year,$check);			
		}
		else
		{
			$check='old';
			$this->Export->PFSummary($spg,$cust,$month,$year,$check);
		}
	 }

	 /* show Esic newjoinee report companiwise */
	 Public function ShowEsicnNewoinee($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		   
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'ESIC New Joinee';
			       

			        /* table data */
			 		$this->data['tableHeading'] = "ESIC New Joinee Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/esicnewjoin/'.$spgid.'/'.$custid.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Custid","Company name","Name as per aadhar record","Father Name","Husband Name (only for female)","Date of Birth","Date of Joining","Sex","Marital Status","Contact","Aadhar no","Residential Address","Permanent Address","Permanent Address","Family Details - DOB","Family Details - Age","Family Details - Relation","Family Details - Adhar No.","Residing with Her/Him");
			 		//data	
			 		$this->data['tableData']=$this->Genrateesicnewjoinee();//
			 		// $this->data['tableButtons']	= array();
			 	
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 	if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 	{
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");

		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'ESIC New Joinee';

		      // $this->data['user_type'] = $page_data['user_type'];
		       //$this->data['menu'] = $page_data['menu'];
		    
		    // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();  

		       $this->render('export_esicnewjoinee');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		 }
	 }

	 /* genrate esic new joinee report with validation */
	 public function Genrateesicnewjoinee($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				$result=$this->report->get_esicnewjoinee($spgid,$custid);
				return $result;
				//print_r($result);
				// var_dump($result); 
				// exit();					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	
	 }

	 /* download esic new joinee report in excel formate*/
	 public function DownloadESICnewjoinee()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	// echo $spg;
	 	// exit();
	 	$this->Export->ESICnewjoinee($spg,$cust);
	 }

	 /* show Esic Template report companiwise */
	 public function ShowEsicTemplate($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
			$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
			$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
			//$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		  
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'ESIC Template';
			       

			        /* table data */
			 		$this->data['tableHeading'] = "ESIC Template Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 					
			 											'link'=> base_url(''.$this->data['user_type'].'/download/esictemplate/'.$spgid.'/'.$custid.'/'.$month.'/'.$year.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("IP No","IP Name","No of days for which wages paid","Total Monthly Wages","Reasons code for zero working days","Last working days");
			 		//data	
			 		$this->data['tableData']=$this->GenrateEsicTemplate();//
			 		// $this->data['tableButtons']	= array();
			 	

		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
			if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 	{
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");


		     
		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'ESIC Template';

		      // $this->data['user_type'] = $page_data['user_type'];
		       //$this->data['menu'] = $page_data['menu'];
		    	
		    	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails();      

		       $this->render('export_esictemplate');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		}
	 }

	 /* genrate esic Template report with validation */
	 public function GenrateEsicTemplate($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 		=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 		=!empty($this->input->post('year'))?$this->input->post('year'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") 
	 				{	 					
	 					put_msg('Please Select Year and Month');
	 					goto_back();
	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") 
	 				{
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) 
	 					{
	 						 //echo "is last month";
	 						$result=$this->report->get_newEsicTemplate($spgid,$custid,$month,$year);
	 						return $result;
	 					}
	 					elseif (this_month($month,$year) == TRUE) 
	 					{
	 						put_msg('till not genrate pf and esic report');
	 						goto_back();
	 					}
	 					else
	 					{
	 						//echo "is old month";
	 						$result=$this->report->get_oldEsicTemplate($spgid,$custid,$month,$year);
	 						return $result;
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					goto_back();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					goto_back();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				goto_back();
	 			}					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	
	 }

	 /* download esic Template report in excel formate*/
	 public function DownloadESICTemplate()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	$month = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$year = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	// echo $spg;
	 	// exit();
	 	

	 	if (is_last_month($month,$year) == TRUE) 
		{
			$check='new';
			$this->Export->ESICTemplate($spg,$cust,$month,$year,$check);			
		}
		else
		{
			$check='old';
			$this->Export->ESICTemplate($spg,$cust,$month,$year,$check);
		}
	 }

	 /* show Esic Template (Empid) report for export companiwise */
	 public function ShowEsicTemplateEmpID($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
			$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
			$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
		$location =!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		   
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'ESIC Template(Emp ID)';
			       

			        /* table data */
			 		$this->data['tableHeading'] = "ESIC Template(Emp ID) Reports";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/esictemplateempid/'.$spgid.'/'.$custid.'/'.$month.'/'.$year.'/'.$location.''),
														'button' =>'Download ESIC',
														'class'	 =>'btn-success'
			 												)
			 										
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("IP No","EMP ID","IP Name","No of days for which wages paid","Total Monthly Wages","Employee Contribution","Employer Contribution","Reasons code for zero working days","Last working days","Date of Join","Date of Birth","Vender ID","Contractor Name","Location");
			 		//data	
			 		$this->data['tableData']=$this->GenrateEsicTemplateEmpID();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 	if ($this->data['access'][$this->session->TYPE] == TRUE) {
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");


		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'ESIC Template(Emp ID)';

		       // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();
			     // All Location data
			       	$this->data['result1']=$this->report->get_location();
			       	// print_r($location);
			       	// exit();
		       $this->render('export_esictemplate_empid');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		}     
	 }

	 /* genrate ESIC Template (EmpID) report with validation */
	 private function GenrateEsicTemplateEmpID($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
	 	$location =!empty($this->input->post('location'))?$this->input->post('location'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) {
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") {
	 					// echo "1year and month are ALL";	 					
	 					put_msg('Please Select Year and Month');
	 					goto_back();
	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") {
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) {

	 						 //echo "is last month";
	 						if ($location == "ALL") 
				 			{
				 				$result=$this->report->get_newEsicTemplate_empid($spgid,$custid,$month,$year,"ALL");
	 							return $result;
				 			}
				 			else
				 			{
				 				$result=$this->report->get_newEsicTemplate_empid($spgid,$custid,$month,$year,$location);
	 							return $result;
				 			}
	 						
	 					}
	 					elseif (this_month($month,$year) == TRUE) {
	 						put_msg('till not genrate pf and esic report');
	 						goto_back();
	 					}
	 					// elseif (before_months($month,$year) == TRUE) {
	 					// 	put_msg('till not genrate pf and esic report');
	 					// 	goto_back();
	 					// }
	 					else
	 					{
	 						//echo "is old month";
	 						if ($location == "ALL") 
				 			{
				 				$result=$this->report->get_oldEsicTemplate_empid($spgid,$custid,$month,$year,"ALL");
	 							return $result;
				 			}
				 			else
				 			{
				 				$result=$this->report->get_oldEsicTemplate_empid($spgid,$custid,$month,$year,$location);
	 							return $result;
				 			}
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					goto_back();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					goto_back();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				goto_back();
	 			}
	 		}
	 		else{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	 	
	 }

	 /* download esic Template report in excel formate*/
	 public function DownloadESICTemplateEmpID()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	$month = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$year = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	$location = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

	 	if (is_last_month($month,$year) == TRUE) 
		{
			$check='new';
			$this->Export->ESICTemplateEmpid($spg,$cust,$month,$year,$location,$check);
		}
		else
		{
			$check='old';
			$this->Export->ESICTemplateEmpid($spg,$cust,$month,$year,$location,$check);
		}
	 }

	 /* show Esic summary report companiwise */
	 public function ShowEsicSummary($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
			$month 		=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
			$year 		=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
			//$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{
		 		    //$this->data['page_title'] = $page_data['page_title'];
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'ESIC Summmary';
			        //$this->data['user_type'] = $page_data['user_type'];
			        //$this->data['menu'] = $page_data['menu'];
			        /* table data */
			 		$this->data['tableHeading'] = "ESIC Summary Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(							
			 											'link'=> base_url(''.$this->data['user_type'].'/download/esicsummary/'.$spgid.'/'.$custid.'/'.$month.'/'.$year.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Total IP Contribution","Total Employer Contribution","Grand Total Employee & Employer Contribution","Total Central Government Contribution","Total Wages");
			 		//data	
			 		$this->data['tableData']=$this->GenrateEsicSummary();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
			if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 	{
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");

		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'ESIC Summary';


		       //$this->data['user_type'] = $page_data['user_type'];
		       //$this->data['menu'] = $page_data['menu'];
		    	    
		    // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();  



	    // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();  


		       $this->render('export_esicsummary');
		     }
		     else
		     {
		      $this->load->view('404');
		     }
		}
	 }

	 /* genrate esic Summary report with validation */
	 public function GenrateEsicSummary($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 		=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 		=!empty($this->input->post('year'))?$this->input->post('year'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") 
	 				{	 					
	 					put_msg('Please Select Year and Month');
	 					goto_back();
	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") 
	 				{
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) 
	 					{
	 						 //echo "is last month";
	 						$result=$this->report->get_newEsicSummary($spgid,$custid,$month,$year);
	 						return $result;
	 					}
	 					elseif (this_month($month,$year) == TRUE) 
	 					{
	 						put_msg('till not genrate pf and esic report');
	 						goto_back();
	 					}
	 					else
	 					{
	 						//echo "is old month";
	 						$result=$this->report->get_oldEsicSummary($spgid,$custid,$month,$year);
	 						return $result;
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					goto_back();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					goto_back();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				goto_back();
	 			}					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}	
	 }

	 /* download esic Summary report in excel formate*/
	 public function DownloadESICSummary()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	$month = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$year = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	
	 	//$this->Export->ESICSummary($spg,$cust);

	 	if (is_last_month($month,$year) == TRUE) 
		{
			$check='new';
			$this->Export->ESICSummary($spg,$cust,$month,$year,$check);
		}
		else
		{
			$check='old';
			$this->Export->ESICSummary($spg,$cust,$month,$year,$check);
		}
	 }

	 /* show compliance report companiwise */
	 public function ShowCompliance($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		    
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Compliance';
			       

			        /* table data */
			 		$this->data['tableHeading'] = "Compliance Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/compliance/'.$spgid.'/'.$custid.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Particular","Statutory Due Date","Task Completion Date","Return/Challan Generation Date","Submission/Payment Date","Document Submitted to GOVT in Nos.","Pending documents in Nos.","Copy of Document","Responsible Person from Client","Responsible Person from consultant","Remarks");
			 		//data	
			 		$this->data['tableData']=$this->GenrateCompliance();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");


			       	$this->data['where'] = 'Reports';
			       	$this->data['sub_menu'] = 'Compliance';




			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Compliance';





			      
			      	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails();	
			       	$this->render('export_compliance');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate Compliance report with validation */
	 public function GenrateCompliance($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				//$result=$this->report->get_complince_data($spgid,$custid,'compliance');
				$result=$this->report->get_compliance($spgid,$custid);
				 return $result;
				//print_r($result);
				// var_dump($result); 
				// exit();					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* download complance done report in excel formate*/
	 public function DownloadCompliance()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	// echo $spg;
	 	// exit();
	 	$this->Export->compliance($spg,$cust);
	 }

	 /* show Non compliance report companiwise */
	 public function ShowNonCompliance($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Non Compliance';



		 		  
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Non Compliance';

			        



			        /* table data */
			 		$this->data['tableHeading'] = "Non Compliance Report";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$this->data['user_type'].'/download/noncompliance/'.$spgid.'/'.$custid.''),
														'button' =>'Download',
														'class'	 =>'btn-success'
			 												)
			 									);	
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Particular","Statutory Due Date","Task Completion Date","Return/Challan Generation Date","Submission/Payment Date","Document Submitted to GOVT in Nos.","Pending documents in Nos.","Copy of Document","Responsible Person from Client","Responsible Person from consultant","Remarks");
			 		//data	
			 		$this->data['tableData']=$this->GenrateNonCompliance();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');

				    $this->load->library("pagination");			       
			       	$this->data['where'] = 'Reports';
			       	$this->data['sub_menu'] = 'Non Compliance';
			    
			      	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails();	
			       	$this->render('export_noncompliance');


				    $this->load->library("pagination");


			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Non Compliance';
			  

			       $this->render('export_noncompliance');


			     }
			     else
			     {
			      	$this->load->view('404');
			     }
		}
	 }

	 /* genrate non Compliance report with validation */
	 public function GenrateNonCompliance($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				$result=$this->report->get_noncompliance($spgid,$custid);
				return $result;					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* download non complance  report in excel formate*/
	 public function DownloadNonCompliance()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	
	 	$this->Export->noncompliance($spg,$cust);
	 }


	 /* show Approval report companiwise */
	 public function ShowApproval($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Approval';



			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Approval';


			        /* table data */
			 		$this->data['tableHeading'] = "Approval This Month Report";			 			
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Year","Act","Particular","Frequency","Due date","Act Type","Receive Date");
			 		//data	
			 		$this->data['tableData']=$this->GenrateApproval();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");

			       	$this->data['where'] = 'Reports';
			       	$this->data['sub_menu'] = 'Approval';			




			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Approval';
			     

			      

			      // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();
			       	$this->render('export_approval');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate approval report with validation */
	 public function GenrateApproval($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				$result=$this->report->get_approval($spgid,$custid);
				 return $result;					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* Show Rejected Report companiwise */
	 public function ShowRejected($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Rejected';



			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Rejected';

			        /* table data */
			 		$this->data['tableHeading'] = "Rejected Report";
			 			
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Year","Act","Particular","Frequency","Due date","Act Type","Receive Date");
			 		//data	
			 		$this->data['tableData']=$this->GenrateRejected();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");
			       	$this->data['where'] = 'Reports';
			       	$this->data['sub_menu'] = 'Rejected';			   			


			       	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails();    
			       	$this->render('export_rejected');



			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Rejected';
			     

			       $this->render('export_rejected');


			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate Rejected report with validation */
	 public function GenrateRejected($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid		=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 		=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				$result=$this->report->get_rejected($spgid,$custid);
				 return $result;					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* Show Compliance Document Report companiwise */
	 public function ShowComplianceDocument($page_data = '')
	 {
	 	 $this->load->model('Report_model','report');

	 	if (!empty($this->input->post('submit'))) 
	 	{
	 		$cname	=!empty($this->input->post('entity_name'))?$this->input->post('entity_name'):NULL;
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Compliance Documents';


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Compliance Documents';
			       



			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Compliance Documents';

			        /* table data */
			 		$this->data['tableHeading'] = "Compliance Document Report"; 		
			 		// colomns name				
			 		$this->data['result']=$this->report->get_compliancedocument($spgid,$custid,$cname);
		
					$this->render('show_compliance_documentation');
			     }
			     else
			     {
			      $this->load->view('404');
			     }	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');

				    $this->load->library("pagination");			    
			       	$this->data['where'] = 'Reports';
			       	$this->data['sub_menu'] = 'Compliance Documents';
			    
			    	// All Company data
			       	$this->data['result']=$this->report->get_entitydetails(); 
			       	$this->render('export_compliance_document');


				    $this->load->library("pagination");


			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Compliance Documents';

			      
			       $this->render('export_compliance_document');


			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* Show Entity Details Report*/
	 public function ShowEntityDetails($page_data = '')
	 {
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Entity Details';




			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Entity Details';

			        /* table data */
			 		$this->data['tableHeading'] = "Entity Details Report";			 		
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name");
			 		//data
			 		$this->data['tableData']=$this->GenrateEntityDetails();
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 }

	 /* genrate Entity Details report with validation */
	 public function GenrateEntityDetails($value='')
	 {
	 	$this->load->model('Report_model','report');
	 		
				$result=$this->report->get_entitydetails();
				 return $result;
				
	 }

	 /* Show Employee Details Report companiwise */
	 public function ShowEmployeeDetails($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
		  $location =!empty($this->input->post('location'))?$this->input->post('location'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Employee Details';


			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Employee Details';
			       




			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Employee Details';

			        /* table data */
			 		$this->data['tableHeading'] = "Employee Details Report";
			 			
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Employee Id","Employee Name","Gender","Father-Husband Name","Marital Status","Designation","Mobile No","Email ID","DOJ","DOB","UAN No.","ESIC No","PAN","Bank Name","Branch","IFSC Code","Account No.","Adhar Card No.","Location");
			 		//data	
			 		$this->data['tableData']=$this->GenrateEmployeeDetails();//
			 		// $this->data['tableButtons']	= array();
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');

				    $this->load->library("pagination");			       
			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Employee Details';
			     


				    $this->load->library("pagination");

			    
			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Employee Details';
			      




			       // location data
			       $this->data['result']=$this->report->get_location();		    
			      
			       $this->render('export_employeedetails');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate Employee Details report with validation */
	 public function GenrateEmployeeDetails($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 	$location 	=!empty($this->input->post('location'))?$this->input->post('location'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{
				if ($location =="ALL") 
	 			{
	 				$result=$this->report->get_employeedetails($spgid,$custid,'ALL');
				 	return $result;
	 			}
	 			else
	 			{
	 				$result=$this->report->get_employeedetails($spgid,$custid,$location);
				 	return $result;
	 			}				
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* Show Compliance Request Details Report*/
	 public function ShowComplianceRequestDetails($page_data = '')
	 {
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		   
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Compliance Request Details';
			     

			        /* table data */
			 		$this->data['tableHeading'] = "Compliance Request Details Report";	// colomns name
			 		
			 		// colomns name
			 		$this->data['tableCol'] = array("Act","Particular","Company name");
			 		//data
			 		$this->data['tableData']=$this->GenrateComplianceRequestDetails();//
			 		
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 }

	 /* genrate Entity Details report with validation */
	 public function GenrateComplianceRequestDetails($value='')
	 {
	 	$this->load->model('Report_model','report');
	 		
				$result=$this->report->get_compliancerequest();
				 return $result;
				
	 }

	 /* Show salary Details Report companiwise */
	 public function ShowSalaryDetails($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
	 		//$cname	=!empty($this->input->post('comp_name'))?$this->input->post('comp_name'):NULL;
			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		  
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Salary Details';
			        

			        /* table data */
			 		$this->data['tableHeading'] = "Salary Details Report";	// colomns name
			 			
			 		// colomns name
			 		$this->data['tableCol'] = array("Customer ID","Company name","Salary","Month","Year","Action");
			 		//data	
			 		$this->data['tableData']=$this->GenrateSalaryDetails();//
			 		$this->data['tableButtons']	= array("edit","delete");
			 	
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     } 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");


			     
			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Salary Details';
			    
			    // All Company data
			       	$this->data['result']=$this->report->get_entitydetails();

			       $this->render('export_salarydetails');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate salary Details report with validation */
	 public function GenrateSalaryDetails($value='')
	 {
	 	$this->load->model('Report_model','report');

	 		//$cname	=!empty($this->input->post('comp_name'))?$this->input->post('comp_name'):NULL;
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 	
	 		if ($custid !== NULL && $spgid !== NULL) 
	 		{		
	 				$result=$this->report->get_salarydetails($spgid,$custid);
				 	return $result;					
	 		}
 			else
 			{
	 			put_msg('Sorry custid and user are invalid');
	 				goto_back();
	 		}
	 }

	 /* Show FAQ Details Report companiwise */
	 public function ShowFAQDetails($page_data = '')
	 {	 	
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");


			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'FAQ Details';
			       

			       $this->render('export_faq');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		
	 }

	 /* Show Entity Details Report*/
	 public function ShowSpgUsersDetails($page_data = '')
	 {
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'SPG Users Details';
			     

			        /* table data */
			 		$this->data['tableHeading'] = "SPG Users Report";	// colomns name
			 		
			 		// colomns name
			 		$this->data['tableCol'] = array("UserName","Pending For Approval","Date of bulk Compliance");
			 		//data
			 		$this->data['tableData']=$this->GenrateSpgUsersDetails();//
			 		
		 		 	$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
	 }

	 /* genrate Entity Details report with validation */
	 public function GenrateSpgUsersDetails($value='')
	 {
	 	$this->load->model('Report_model','report');
	 		
				$result=$this->report->get_spgusers();
				 return $result;
				
	 }

	 /* Show formd Report companiwise */
	 public function ShowFormD($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
	 		$this->load->model('Report_model','report');

			$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
			$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;

		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{

		 		    
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Form-D';
			       

			        /* table data */
			 		$this->data['tableHeading'] = "Form-D Report";	// colomns name
			 			
			 		$this->data['result']=$this->report->get_formd($spgid,$custid);
		
					$this->render('show_formd',$this->data);

			 		//$this->data['tableButtons']	= array("edit","delete");		 	
		 		 	//$this->render('export_table');
			     }
			     else
			     {
			      $this->load->view('404');
			     } 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");


			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Form-D';
			      	    

			      
			       $this->render('export_formd');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* Show form-Q Report companiwise */
	 public function ShowFormQ($page_data = '')
	 {
	 	if (!empty($this->input->post('submit'))) 
	 	{
	 		$this->load->model('Report_model','report');

	 	
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
		 		{
		 		  
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'Form-Q';
			     

			        /* table data */
			 		$this->data['tableHeading'] = "Form-Q Report";	// colomns name

			 		//data
			 		$this->data['custid']=is($this->input->post('custid'),"N/A");
			 		$this->data['entity_name']=is($this->input->post('entity_name'),"N/A");
			 		$this->data['month']=is($this->input->post('month'),"N/A");
			 		$this->data['year']=is($this->input->post('year'),"N/A");
			 		$this->data['location']=is($this->input->post('location'),"N/A");

			 		$this->data['result']=$this->GenrateFormQ();//		
					$this->render('show_formq');
			     }
			     else
			     {
			      $this->load->view('404');
			     } 		 	
	 	}
	 	else
	 	{
		 		if ($this->data['access'][$this->session->TYPE] == TRUE) 
			 	{
				    $this->load->model('Report_model','report');
				    $this->load->library("pagination");

			       $this->data['where'] = 'Reports';
			       $this->data['sub_menu'] = 'Form-Q';
			     

			       $this->data['result']=$this->report->get_location();
			       $this->data['companys']=$this->report->get_entitydetails();

			       $this->render('export_formq');
			     }
			     else
			     {
			      $this->load->view('404');
			     }
		}
	 }

	 /* genrate Form-Q report with validation */
	 private function GenrateFormQ($value='')
	 {
	 	$this->load->model('Report_model','report');
	 		$entity_name=!empty($this->input->post('entity_name'))?$this->input->post('entity_name'):NULL;
	 		$custid	=!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
	 		$spgid 	=!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
	 		$month 	=!empty($this->input->post('month'))?$this->input->post('month'):NULL;
	 		$year 	=!empty($this->input->post('year'))?$this->input->post('year'):NULL;
	 	$location =!empty($this->input->post('location'))?$this->input->post('location'):NULL;

	 		if ($custid !== NULL && $spgid !== NULL) {
	 			if ($month !==NULL && $year !==NULL) 
	 			{
	 				if ($year == "ALL" && $month == "ALL") {
	 					// echo "1year and month are ALL";	 					
	 					put_msg('Please Select Year and Month');
	 					redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();

	 				}
	 				elseif ($year !== "ALL" && $month !== "ALL") {
	 					// echo "2year is".$year."and month is ".$month;
	 					
	 					if (is_last_month($month,$year) == TRUE) {

	 						 // echo "is last month";

	 						if ($location == "ALL") 
				 			{
				 				$result=$this->report->get_newformq($spgid,$custid,$month,$year,"ALL");
				 				
	 							return $result;
				 			}
				 			else
				 			{
				 				$result=$this->report->get_newformq($spgid,$custid,$month,$year,$location);
				 				
	 							return $result;
				 			}				 			
	 						
	 					}
	 					elseif (this_month($month,$year) == TRUE) {
	 						put_msg('till not genrate report');
	 						redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();
	 					}
	 					// elseif (before_months($month,$year) == TRUE) {
	 					// 	put_msg('till not genrate pf and esic report');
	 					// 	goto_back();
	 					// }
	 					else
	 					{
	 						//echo "is old month";
	 						if ($location == "ALL") 
				 			{
				 				$result=$this->report->get_oldformq($spgid,$custid,$month,$year,"ALL");
	 							return $result;
				 			}
				 			else
				 			{
				 				$result=$this->report->get_oldformq($spgid,$custid,$month,$year,$location);
	 							return $result;
				 			}
	 					}

	 				}
	 				elseif ($year !== "ALL" && $month == "ALL") {
	 					// echo "3year is".$year."and month is ".$month;
	 					put_msg('Please Select Month');
	 					redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();
	 				}
	 				elseif ($year == "ALL" && $month !== "ALL") {
	 					// echo "4year is".$year."and month is ".$month;
	 					put_msg('Please Select Year');
	 					redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();

	 				}

	 			}
	 			else
	 			{
	 				put_msg('Sorry month and year is invalid');
	 				redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();
	 			}
	 		}
	 		else{
	 			put_msg('Sorry custid and user are invalid');
	 				redirect(base_url(''.$this->data['user_type'].'/export/formq'));
	 					exit();
	 		}	 	
	 }

	 /* download Form-Q report in excel formate*/
	 public function DownloadFormQ()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	$month = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	$year = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	$location = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

	 	//$check='new';			
		//	$this->Export->FormQ($spg,$cust,$month,$year,$location);
//echo $month;echo $year;
	 	if (is_last_month($month,$year) == TRUE) 
	 	{	
	 		$check='new';//echo $check;			
			$this->Export->FormQ($spg,$cust,$month,$year,$location,$check);			
		}
		else
		{ 
			$check='old';//echo $check;
			$this->Export->FormQ($spg,$cust,$month,$year,$location,$check);
		}	 	
	 }


	 

}

