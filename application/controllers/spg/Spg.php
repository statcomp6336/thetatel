<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
class Spg extends Base_controller {

	/*
		*  use anthother controller using USE  keyword then call to declare function.
		*  @$this->page[''] = THIS PAGE ARRAY STORE THE PAGE INFORMATION IN INDEX.
		*  @$this->render(); THIS FUNCTION DISPLAY THE VIEW
	*/
	// use Thetatel_login;
	use Dashboard;
	use Notification;
	use Company_ext;
	use Act;
	use Employee;
	use Salary;
	use Reports;
	use Users;
	use Files;					

	 var $page=array();

	function __construct()
	{
		parent::__construct();
		if ($this->is_spg()== FALSE) {
			redirect(base_url('Home/user_login'));
		}		
		

		/*
			+++++ configure the page setting +++++
			*DEFINE A ACCESS LEVEL
				@comapny 		= 1
				@branch  		= 2
				@contractor 	= 3
				@sub-contractor = 4
				@spg-user 		= 5
				@spg 			= 9
			*	
		*/
		$this->data['page_title']="Complaincetrack";
		$this->data['user_type']="spg";
		$this->data['access']  = array( 1=>FALSE, 
										2=>FALSE,
										3=>FALSE,
										4=>FALSE,
										5=>FALSE,
										9=>TRUE
									);
		// menubare access setting
		
		$this->load->model('Dashboard_model','dash');

		$this->data['new_mail']=$this->dash->countOfNewMail();
		

	}

	
	
	/*----- display the dashboard of spg -----*/
	public function index()
	{	
		if ($this->data['menu']['dashboard_access'] == TRUE) {
		$this->dashboard($this->page);
		}
		else
		{
			$this->load->view('404');
		}
		
	}
	//work with dashboard d
	public function show_totalScope($value='')
	{
		$this->ShowTotalScope($this->page);
	}
	//work with dashboard download totalscope
	public function download_totalScope($value='')
	{
		$this->DownloadTotalScope($this->page);
	}

	//Current Scope
	public function show_currentScope($value='')
	{
		$this->ShowDashCurrentScope($this->page);
	}
	//Compilence Done
	public function show_complianceDone($value='')
	{
		$this->ShowDashComplianceDone($this->page);
	}
	//Non Compliance
	public function show_dashNonCompliance($value='')
	{
		$this->ShowDashNonCompliance($this->page);
	}
	//Pending Compliance
	public function show_dashPendingCompliance($value='')
	{
		$this->ShowDashPendingCompliance($this->page);
	}
	//Pending Compliance
	public function show_dashAlertCompliance($value='')
	{
		$this->ShowDashAlertCompliance($this->page);
	}


	/*------ dispalay the notification of spg -----*/
	public function notification_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
			
		$this->notification($this->page);		
	}

	/* ------- Display the post box view of spg*/
	public function show_inbox()
	{
		$this->showInbox($this->page);//this function store in dashboard controller		
	}
	public function send_mail($value='')
	{
		$this->SendMail('spg');//this function store in dashboard controller	
	}
	public function check_mail($value='')
	{
		$this->dash->update_mail_status();

	}
	public function save_comment()
	{
		$this->SaveComment($this->page);//this function store in dashboard controller		
	}

//THIS FUNCTION DISPLAY THE COMPANY REGISTRATION VIEW
	public function company_registration_view()
	{
		//this function store in COMPANY_EXT controller	
		if ($this->data['menu']['company_registration'] == TRUE) {
		$this->company_registration($this->page);
		}
		else
		{
			$this->load->view('404');
		}
		
		
	}
	public function show_company_details()
	{	
		$this->ShowCompanyDetails($this->page);//branch registration company list
	}
	public function branch_registration_view($value='')
	{
		//this function store in COMPANY_EXT controller	
		if ($this->data['menu']['branch_registration'] == TRUE) {
			$this->branch_registration();
		}
		else
		{
			$this->load->view('404');
		}
		
	}
	public function contractor_registration_view($value='')
	{
		$this->contractor_registration($this->page);
	}
	public function subcontractor_registration_view($value='')
	{
		$this->subcontractor_registration($this->page);
	}

	// public function contractor_registration_view()
	// {
	// 	$this->contractor_registration($this->page);
	// }
	// public function subcontractor_registration_view()
	// {
	// 	$this->subcontractor_registration($this->page);
	// }

	/*
		*  THIS FUNCTION CREATE THE COMPANY
		*  @this->CreateCompany($para); $para IS THE REDEIRECT VERIABLE LIKE 
		* $para=1)spg 2)company 3) branch etc. then https:// thetatel.com/$para/company/		
	*/
	public function add_company()
	{		
		$this->CreateCompany('spg');	    
	}
	/*
		*  THIS FUNCTION DISPLAY THE ACT VIEW		
	*/

	public function act_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		
		$this->company_act($this->page);
	}
	/*
		*  THIS FUNCTION ATTCH A ACT WITH SELECT YOU COMPANY		
	*/
	public function attch_act()
	{


		$this->company_attchAct('spg');
		
	}
	public function get_act_table()
	{
		$this->load->model('Company_model');
		
		$rw=$this->Company_model->get_acts('14000590008');
		$e='';
		// foreach ($rw as $key ) {
			$e.="<tr><td><input type='checkbox' name='check_act[]' value='dfdfd' ></td>";
			$e.="<td>ggoutam<input type='text' name='act' value='goutam' ></td>";
			$e.="<td>101</td><tr>";

		// }
			echo $e;
		// echo json_encode($rw);
	}
	public function attachAct($value='')
	{
		// $set_data = array('cust_id' => $this->input->post('custid1') ,
		// 				  'company_name' => $this->input->post('name1'),
		// 				  'check_act' => $this->input->post('act_code'),
		// 				  'act' =>$this->input->post('act') );
		// echo "<pre>";
		// var_dump($set_data);
		$this->put_on_act_to_company('spg');
	}

	/*++++++ Act form dispaly ++++*/
	public function create_Act($value='')
	{
		$this->CreateActs($this->page); // this function store in Act trait
	}
	/*++++++ Act form insert ++++*/
	public function save_Act($value='')
	{
		$this->SaveActs('spg'); // this function store in Act trait
	}
	public function save_SubAct($value='')
	{
		$this->SaveSubActs('spg'); // this function store in Act trait
	}
	public function sub_act_id()
	{
		$this->get_sub_act_id(); // this function store in Act trait
	}


	/* start process with employee */
	// display employee details with master setup
	public function view_employee_master($value='')
	{

		$this->ShowEmployees($this->page);
	}
	// display employee form
	public function view_employee_form($value='')
	{
		$this->CreateEmployee($this->page); // this function store in Employee trait
	}
	// save employee details//
	public function save_employee($value='')
	{
		$this->SaveEmployee('spg');//  this function store in Employee trait
	}
	public function save_master_emp($value='')
	{
		$this->SaveMasterEmployee('spg');			
	}

	/*start salary process*/
	//show import salary form excel sheet
	public function import_salary()
	{
		$this->ShowSalaryExcel($this->page);// salary trait class
	}
	public function save_salary()
	{
		$this->GetSalaryFromTempSal('spg');// salary trait class
	}
	public function save_import_salary($value='')
	{
		$this->SaveSalary($this->page,'spg');
	}
	public function edit_import_salary($value='')
	{
		$this->SaveExcelSalary('spg');
		// var_dump($this->input->post('cust_id'));
	}

	/* santize process start */
	public function genrate_santize_rec()
	{
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$this->GenrateSantizeRec(); // this function include in report class
	}
	public function sanitize_process($value='')
	{
		$this->CreateSanitize();// this function include in report class
	}
	public function genrate_process_report($value='')
	{
		$this->GenrateProccessReport($this->page);// this function include in report class
	}
	
	public function process_for_pf($value='')
	{
		$this->CreatePFReport();// this function include in report class
	}
	public function process_for_esic($value='')
	{
		$this->CreateESICReport();// this function include in report class
	}
	public function genrate_backloag_report($value='')
	{
		$this->GenrateBacklogReport($this->page);
	}
	public function edit_backlog_emp($value='')
	{
		$this->ExportBacklog();
	}
	public function edit_backlog_sal($value='')
	{
		$this->ExportBacklog();
	}


	/* show company wise pf report view */
	public function show_company_pf()
	{
		$this->ShowCompanyPF($this->page);
	}
	






	/* work with users*/
	public function show_user_list($value='')
	{
		$this->ShowUsers($this->page);
	}

	/* work with File-Explore*/
	public function show_explore($value='')
	{
		$this->ShowExplore($this->page);
	}
	//get companies for explore
	public function show_companiesExplore($value='')
	{
		$this->ShowCompaniesWithYear($this->page);
	}
	//get companies act files with year in explore
	public function show_companiesActExplore($value='')
	{
		$this->ShowCompaniesActWithYear($this->page);
	}





	public function show_missing_uan($value='')
	{
		$this->ShowMissingUan($this->page);
	}
	public function download_missinguan($value='')
	{

		$this->DownloadMissingUan();
	}


	/*
	download will be start here
	*/
	public function download_pf($value='')
	{
		$this->downloadPF();
	}




	/* work with Compilence */
	//display view bulk update
	public function show_bulk_update($value='')
	{
		$this->ShowBulkUpdate($this->page);
	}
	//display view bulk compilence
	public function show_bulk_compliance($value='')
	{
		$this->ShowBulkCompliance($this->page);
	}
	//display update information of bulk compilence
	public function edit_bulk_compliance($value='')
	{
		$this->UpdateBulkCompliance('spg');
	}
	//display view bulk approval 
	public function show_bulk_approval($value='')
	{
		$this->ShowBulkApproval($this->page);
	}
	public function edit_bulk_approval($value='')
	{
		$this->UpdateBulkApproval('spg');
	}
	//display view bulk timeline
	public function show_bulk_timeline($value='')
	{
		$this->ShowBulkTimeline($this->page);
	}
	//display view timeline
	public function show_timeline($value='')
	{
		$this->ShowTimeline($this->page);
	}

	




	public function logout()
	{
		redirect('Home/quite');
	}
	
	public function f($value='')
	{
		// $custid=$this->input->post('custid');
		$srno=$this->input->post('srno');
		// $srno=29;
		$this->load->model('Act_model','act');
		$result=$this->act->docs($srno);
		$out="";
		foreach ($result as $key) {//
		
			$out.="<a href='".$key->doc_path."' target='_blank'>".$key->doc_path."</a><button class='remove1' data-id='".$key->srno."'>Remove</button><br>";
		}
		echo $out;
	}
	public function r()
	{
		
		$id=$this->input->post('srno');
		$file=$this->db->select('doc_path')->from('comp_doc_temp')->where('srno',$id)->get()->row()->doc_path;
		if (!empty($file)) {
			unlink(''.$file.'');
			if($this->db->delete('comp_doc_temp', array('srno' => $id )))
				{
					echo "file has deleted Successfully";
				}
				else
				{
					echo "failed delete";
				}
		}
		

		
		
	}

	public function g($value='')
	{
	
		$sr=$this->input->post('sr');
		$path = 'files/'; 
		 $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xlsx|xls|docs';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
        }
        else {
                $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
          if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }
        $inputFileName = $path . $import_xls_file;        
        $d = array('sl' => $sr, 'doc_path' =>  $inputFileName );
		$this->load->model('Act_model','act');
		$result=$this->act->add_docs($d);
		if ($result==TRUE) {
			echo "Document uploaded Successfully";
		}
		else
		{
			echo "failed";
		}
    }

		
	}
	
	/*working with pf reports*/
	public function show_pf_newjoinee()
	{
		$this->ShowPFNewJoinee($this->page);
	}
	public function download_pfnewjoinee($value='')
	{
		$this->DownloadPFnewjoinee();
	}
	public function show_pf_summary()
	{
		$this->ShowPFSummary($this->page);
	}
	public function download_pfsummary($value='')
	{
		$this->DownloadPFSummary();
	}

	/*working with esic reports*/
	public function show_esic_newjoinee()
	{
		$this->ShowEsicnNewoinee($this->page);
	}
	public function download_esicnewjoinee($value='')
	{
		$this->DownloadESICnewjoinee();
	}
	public function show_esic_template()
	{
		$this->ShowEsicTemplate($this->page);
	}
	public function download_esic_template($value='')
	{
		$this->DownloadESICTemplate();
	}
	public function show_esic_template_empid()
	{
		$this->ShowEsicTemplateEmpID($this->page);
	}
	public function download_esic_template_empid($value='')
	{
		$this->DownloadESICTemplateEmpID();
	}
	public function show_esic_summary()
	{
		$this->ShowEsicSummary($this->page);
	}
	public function download_esic_summary($value='')
	{
		$this->DownloadESICSummary();
	}


	/*working with compliance report*/
	public function show_compliance()
	{
		$this->ShowCompliance($this->page);
	}

	public function download_compliance($value='')
	{
		$this->DownloadCompliance();
	}

	public function show_noncompliance()
	{
		$this->ShowNonCompliance($this->page);
	}

	public function download_noncompliance($value='')
	{
		$this->DownloadNonCompliance();
	}

	public function show_approval()
	{
		$this->ShowApproval($this->page);
	}
	public function show_rejected()
	{
		$this->ShowRejected($this->page);
	}
	public function show_compliance_document()
	{
		$this->ShowComplianceDocument($this->page);
	}
	public function show_entity_details()
	{
		$this->ShowEntityDetails($this->page);
	}
	public function show_employee_details()
	{
		$this->ShowEmployeeDetails($this->page);
	}
	public function Show_compliance_request_details()
	{
		$this->ShowComplianceRequestDetails($this->page);
	}
	public function show_salary_details()
	{
		$this->ShowSalaryDetails($this->page);
	}

	public function show_faq_details()
	{
		$this->ShowFAQDetails($this->page);
	}
	public function show_spgusers_details()
	{
		$this->ShowSpgUsersDetails($this->page);
	}
	public function show_formd()
	{
		$this->ShowFormD($this->page);
	}
	public function show_formq()
	{
		$this->ShowFormQ($this->page);
	}
	public function download_formq($value='')
	{
		$this->DownloadFormQ();
	}

	// public function download_noncompliance($value='')
	// {
	// 	$this->DownloadNonCompliance();
	// }

	


	public function flow_of_work($value='')
	{
		$srno=$this->input->post('srno');
		$this->load->model('Act_model','act');
		$timeline=$this->act->flowOfWork($srno);

		$box= "<div class='history-tl-container'>
					  <ul class='tl'>";
					  foreach ($timeline as $key) {
					  	
					   $box .="<li class='tl-item' ng-repeat='item in retailer_history'>
					      <div class='timestamp'>".$key->date
					        // 3rd March 2015<br> 7:00 PM
					      ."</div>
					      <div class='item-title'>".$key->comment."</div>
					      <div class='item-detail'>".$key->spg_name."</div>
					    </li>";
					}
					  $box .="</ul></div>";
					  echo $box;
	}

	/* work with user createtion  */
	public function create_user($value='')
	{
		$this->CreateUser('spg');//this funtion store in user controller
	}
	//update user log
	public function edit_user($value='')
	{
		$this->EditUser('spg');//this funtion store in user controller
	}
	//remove user log
	public function remove_user($value='')
	{
		$this->RemoveUser('spg');//this funtion store in user controller
	}
	//remove user log
	public function user_get_companys($value='')
	{
		$this->ShowAddCompanysToUser('spg');//this funtion store in user controller
	}
	//
	public function user_remove_companys($value='')
	{
		$this->ShowRemoveCompanysToUser('spg');//this funtion store in user controller
	}
	//
	public function user_AddRemove_companys($value='')
	{
		$this->attach_companies('spg');//this funtion store in user controller
	}
	//reste password
	public function reset_password($value='')
	{
		$this->RestePassword($this->page);//this funtion store in user controller
	}
	//Set Access for Commany
	public function company_access($value='')
	{
		$this->SetAccess($this->page);//this funtion store in user controller
	}























	public function kaypn($value='')
	{
		 // $this->load->helper('Password');
   //              $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
   //              // if (!$hasher->CheckPassword($password, $user->password)) {
   //              //     // Password failed, return
   //              //     return false;
   //              // }
   //              echo  $hasher->HashPassword('hitler');
   //              var_dump($hasher->CheckPassword('hitler', $hasher->HashPassword('hitler')));
//$this->load->view('forgot_password');
	}




	
}	
