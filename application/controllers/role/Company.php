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
		$this->data['page_title']="Dashboard";
		$this->data['user_type']="company";
		$this->data['access']  = array( 1=>TRUE, 
										2=>FALSE,
										3=>FALSE,
										4=>FALSE,
										5=>FALSE,
										9=>FALSE
									);
		// menubare access setting
		
		$this->load->model('Dashboard_model','dash');

		$this->data['new_mail']=$this->dash->countOfNewMail();
		/*menu Access*/
		$this->data['menu']['dashboard_access'] = TRUE;
		$this->data['menu']['managefiles_access'] = TRUE;

		$this->data['menu']['report_access'] = TRUE;
		$this->data['menu']['salary_report'] = TRUE;
		$this->data['menu']['compliance_report'] = TRUE;
		$this->data['menu']['non_compliance_report'] = TRUE;
		$this->data['menu']['compliance_doc'] = TRUE;
		$this->data['menu']['emp_compliance'] = TRUE;
		$this->data['menu']['compliance_reject'] = TRUE;

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
}	
