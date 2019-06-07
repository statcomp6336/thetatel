<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Reports {
	
	public function GenrateSantizeRec($page_data='')
	{
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');
		    $this->load->library("pagination");

	       $this->data['page_title'] = $page_data['page_title'];
	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Sanitize';
	       $this->data['user_type'] = $page_data['user_type'];
	       $this->data['menu'] = $page_data['menu'];
	    
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
	      echo "404 no access";
	     }
	}
	public function CreateSanitize($value='')
	{
		$this->load->model('Report_model','report');
		$show=$this->report->CreateSanitizeReport();
		if ($show == TRUE) {
			$send['redirect']='spg';
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
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');
		    $this->load->library("pagination");

	       $this->data['page_title'] = $page_data['page_title'];
	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Process';
	       $this->data['user_type'] = $page_data['user_type'];
	       $this->data['menu'] = $page_data['menu'];
	    
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
	      echo "404 no access";
	     }
	}

	public function CreatePFReport($value='')
	 {
	 	$this->load->model('Report_model','report');
	 	
	 	 $spg = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
	 	 $cust = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
	 	$proc=$this->report->CreatePfProcess($spg,$cust);
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
	 	$proc=$this->report->CreateESICProcess($spg,$cust);
	 		$this->report->DownloadESICReport($spg,$cust);
	 }

	 /* genrate process report*/
	public function GenrateBacklogReport($page_data='')
	{
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		    $this->load->model('Report_model','report');
		    $this->load->library("pagination");

	       $this->data['page_title'] = $page_data['page_title'];
	       $this->data['where'] = 'Reports';
	       $this->data['sub_menu'] = 'Backlog';
	       $this->data['user_type'] = $page_data['user_type'];
	       $this->data['menu'] = $page_data['menu'];
	    
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
	      echo "404 no access";
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
		 		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 		    $this->data['page_title'] = $page_data['page_title'];
			        $this->data['where'] = 'Reports';
			        $this->data['sub_menu'] = 'PF Company';
			        $this->data['user_type'] = $page_data['user_type'];
			        $this->data['menu'] = $page_data['menu'];
			        /* table data */
			 		$this->data['tableHeading'] = "ECR Template Reports";	// colomns name
			 		$this->data['tableTools'] = array(
			 										0 =>array(
			 											'link'=> base_url(''.$page_data['user_type'].'/download/pf/'.$spgid.'/'.$custid.''),
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
			      echo "404 no access";
			     }
	 		 	
	 	}
	 	else
	 	{
		 	if ($page_data['access'][$this->session->TYPE] == TRUE) {
			    $this->load->model('Report_model','report');
			    $this->load->library("pagination");

		       $this->data['page_title'] = $page_data['page_title'];
		       $this->data['where'] = 'Reports';
		       $this->data['sub_menu'] = 'PF Company';
		       $this->data['user_type'] = $page_data['user_type'];
		       $this->data['menu'] = $page_data['menu'];
		    
		       	// $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
		        // $config["total_rows"] = $this->emp->get_count();
		        // $config["per_page"] = 10;
		        // $config["uri_segment"] = 2;
		        //     $this->pagination->initialize($config);

		        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		       

		        // $this->data["links"] = $this->pagination->create_links();

		        // $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

		        // $this->data['result'] = $this->report->get_BacklogTable();
		       $this->render('export_pf');
		     }
		     else
		     {
		      echo "404 no access";
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

}

