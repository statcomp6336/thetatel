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

	}
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
}	
