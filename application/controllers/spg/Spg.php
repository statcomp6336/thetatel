<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
 
 
 
class Spg extends Base_controller {

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
	use Dashboard;
	use Notification;
	use Company_ext;

	 var $page=array();

	function __construct()
	{
		parent::__construct();
		if ($this->is_spg()== FALSE) {
			redirect(base_url('Home/user_login'));
		}
		$this->load->model('login_model');
		$this->load->model('DB_install');

		/*
			+++++ configure the page setting +++++
		*/
		$this->page['page_title']="Dashboard";
		$this->page['user_type']="spg";
		// menubare access setting
		$this->page['menu']=array(
			// dashbord access if true to dispaly and flase it hide
			"dashboard_access" 		=> TRUE,
			// notification access if true to dispaly and flase it hide
			"notification_access" => TRUE//
			);
		

	}
	public function customer($value='')
	{
		$this->DB_install->CreateTable_customer_master();
		$this->DB_install->CreateTable_custid_backup();

	}
	/*----- display the dashboard of spg -----*/
	public function index()
	{	
		if ($this->page['menu']['dashboard_access'] == TRUE) {
		$this->dashboard($this->page);
		}
		else
		{
			echo "access denied";
		}
		
	}

	/*------ dispalay the notification of spg -----*/
	public function notification_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
			
		$this->notification($this->page);		
	}

	/* ------- Display the post box view of spg*/
	public function inbox_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		// // $this->render('flashscreen');		
		// $this->dashboard();
		$this->render('inbox');
	}
	
	public function company_registration_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		// // $this->render('flashscreen');		
		// $this->dashboard();
		$this->company_registration($this->page);
	}

	public function add_company()
	{		
		$this->CreateCompany('spg');	    
	}



	public function logout()
	{
		redirect('Home/quite');
	}
	
	public function f($value='')
	{
		$this->load->view('example');
	}
	
}	
