<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
 // require_once APPPATH."third_party\Thetatel_login.php";
 
class Spg_user extends Base_controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// use Thetatel_login;
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
		if ($this->is_spg_user()== FALSE) {
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
		$this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		$this->data['user_type']="Spg_user";
		$this->data['access']  = array( 1=>FALSE, 
										2=>FALSE,
										3=>FALSE,
										4=>FALSE,
										5=>TRUE,
										9=>FALSE
									);
		// menubare access setting
		$this->data['menu']=array(
      // dashbord access if true to dispaly and flase it hide
      "dashboard_access"    			=> TRUE,
      "notification_access" 			=> FALSE,//
      "setup_access"        			=>FALSE,
      "myactivity_access"   			=>TRUE,
      "mycompliance_access" 			=>TRUE,
      "myapproval_access"   			=>FALSE,
      "userprofile_access"  			=>FALSE,
      "managefiles_access"  			=>FALSE,
      "report_access"       			=>TRUE,
      "reportcompliance_access"   		=>TRUE,
      "reportemplyoee_access"   		=>FALSE,
      "reportsalary_access"   			=>FALSE,
      "reportentities_access"   		=>FALSE,
      "reportcompliancerequest_access"	=>FALSE,
      "reportuser_access"   			=>FALSE,
      "reportregister_access"   		=>FALSE,
      );

		$this->load->model('Dashboard_model','dash');
		$this->data['new_mail']=$this->dash->countOfNewMail();
	}
	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->model('login_model');
	// 	
	// }
	public function index()
	{
		if ($this->data['menu']['dashboard_access'] == TRUE) {
		$this->dashboard($this->page);
		}
		else
		{
			echo "access denied";
		}
	}
	//work with dashboard 
	public function show_totalScope($value='')
	{
		$this->ShowTotalScope($this->page);
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

	//=========================================================//

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
	public function show_missing_uan($value='')
	{
		$this->ShowMissingUan($this->page);
	}
	public function download_missinguan($value='')
	{
		$this->DownloadMissingUan();
	}
	//==================================================//

	/*start salary process*/
	//show import salary form excel sheet
	public function import_salary()
	{
		$this->ShowSalaryExcel($this->page);// salary trait class
	}
	public function save_import_salary($value='')
	{
		$this->SaveSalary($this->page,'Spg_user');
	}
	public function edit_import_salary($value='')
	{
		$this->SaveExcelSalary('Spg_user');
		// var_dump($this->input->post('cust_id'));
	}

	//===================================================//
	/* working to show company wise pf report view */
	public function show_company_pf()
	{
		$this->ShowCompanyPF($this->page);
	}
	/*download will be start here*/
	public function download_pf($value='')
	{
		$this->downloadPF();
	}
	/*working to show company wise pfnewjoinee reports view*/
	public function show_pf_newjoinee()
	{
		$this->ShowPFNewJoinee($this->page);
	}

	public function download_pfnewjoinee($value='')
	{
		$this->DownloadPFnewjoinee();
	}
	/*working to show company wise pfsummary reports view*/
	public function show_pf_summary()
	{
		$this->ShowPFSummary($this->page);
	}
	public function download_pfsummary($value='')
	{
		$this->DownloadPFSummary();
	}
	/*working to show company wise esicnewjoinee reports view*/
	public function show_esic_newjoinee()
	{
		$this->ShowEsicnNewoinee($this->page);
	}
	public function download_esicnewjoinee($value='')
	{
		$this->DownloadESICnewjoinee();
	}
	/*working to show company wise esic_template reports view*/
	public function show_esic_template()
	{
		$this->ShowEsicTemplate($this->page);
	}
	public function download_esic_template($value='')
	{
		$this->DownloadESICTemplate();
	}
	/*working to show company wise esictemplate_empid reports view*/
	public function show_esic_template_empid()
	{
		$this->ShowEsicTemplateEmpID($this->page);
	}
	public function download_esic_template_empid($value='')
	{
		$this->DownloadESICTemplateEmpID();
	}
	/*working to show company wise esicsummary reports view*/
	public function show_esic_summary()
	{
		$this->ShowEsicSummary($this->page);
	}
	public function download_esic_summary($value='')
	{
		$this->DownloadESICSummary();
	}
	//======================================================//

	/* santize process start */
	public function genrate_santize_rec()
	{
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$this->GenrateSantizeRec($this->page); // this function include in report class
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
	//=========================================================//
	/* work with BulkCompilance */
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

	//===================================================//

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

	//=========================================================//
	public function logout()
	{
		redirect('Home/quite');
	}
	//=======================================================//

}	
