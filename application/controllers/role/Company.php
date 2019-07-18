<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
 // require_once APPPATH."third_party\Thetatel_login.php";
 
class Company extends Base_controller {

	
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
		if ($this->is_company()== FALSE) {
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
		$this->data['user_type']="Company";
		$this->data['access']  = array( 1=>TRUE, 
										2=>FALSE,
										3=>FALSE,
										4=>FALSE,
										5=>FALSE,
										9=>FALSE
									);
		// menubare access setting
		
		
		/*menu Access*/
		// $this->data['menu']['dashboard_access'] = TRUE;
		// $this->data['menu']['managefiles_access'] = TRUE;

		// $this->data['menu']['report_access'] = TRUE;
		// $this->data['menu']['salary_report'] = TRUE;
		// $this->data['menu']['compliance_report'] = TRUE;
		// $this->data['menu']['non_compliance_report'] = TRUE;
		// $this->data['menu']['compliance_doc'] = TRUE;
		// $this->data['menu']['emp_compliance'] = TRUE;
		// $this->data['menu']['compliance_reject'] = TRUE;

		$this->data['menu']=array(
      // dashbord access if true to dispaly and flase it hide
      "dashboard_access"    			=> TRUE,
      "notification_access" 			=> FALSE,//
      "setup_access"        			=>FALSE,
      "myactivity_access"   			=>FALSE,
      "mycompliance_access" 			=>FALSE,
      	"bulkcompliance_access"			=>FALSE,
      	"compliancetimeline_access"		=>FALSE,
      "myapproval_access"   			=>FALSE,
      "userprofile_access"  			=>FALSE,
      "managefiles_access"  			=>TRUE,

      "report_access"       			=>TRUE,
      "reportcompliance_access"   		=>TRUE,
      "compliance_report"				=>TRUE,
      "non_compliance_report"			=>TRUE,
      "compliance_doc"					=>TRUE,      
      "compliance_reject"				=>TRUE,

      "reportemplyoee_access"   		=>FALSE,
      "reportsalary_access"   			=>TRUE,
      "reportentities_access"   		=>FALSE,
      "reportcompliancerequest_access"	=>FALSE,
      "reportuser_access"   			=>FALSE,
      "reportregister_access"   		=>FALSE,
      );

		$this->load->model('Dashboard_model','dash');

		$this->data['new_mail']=$this->dash->countOfNewMail();

	}
	public function index()
	{
		if ($this->data['menu']['dashboard_access'] == TRUE) {
		$this->dashboard();
		}
		else
		{
			$this->load->view('404');
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

	/* work with File-Explore*/
	public function show_explore($value='')
	{
		if ($this->data['menu']['managefiles_access'] == TRUE) {
		$this->ShowExplore();
		}
		else
		{
			$this->load->view('404');
		}
	}
	//get companies for explore
	public function show_companiesExplore($value='')
	{
		if ($this->data['menu']['managefiles_access'] == TRUE) {
		$this->ShowCompaniesWithYear();
		}
		else
		{
			$this->load->view('404');
		}
	}
	//get companies act files with year in explore
	public function show_companiesActExplore($value='')
	{
		if ($this->data['menu']['managefiles_access'] == TRUE) {
		$this->ShowCompaniesActWithYear();
		}
		else
		{
			$this->load->view('404');
		}
	}
	//get upload files to spg user
	public function save_share_files($value='')
	{
		if ($this->data['menu']['managefiles_access'] == TRUE) {
		$this->upload_companyDocs('company');
		}
		else
		{
			$this->load->view('404');
		}
	}
   //==================================================//

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
	public function show_rejected()
	{
		$this->ShowRejected($this->page);
	}
	 public function show_compliance_document()
	 {
	 	$this->ShowComplianceDocument($this->page);
	 }
	public function show_salary_details()
	{
		$this->ShowSalaryDetails($this->page);
	}
	public function show_faq_details()
	{
		$this->ShowFAQDetails($this->page);
	}

	//=========================================================//
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

	//=========================================================//
	public function logout()
	{
		redirect('Home/quite');
	}
	//=======================================================//
	
}	
