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
			*DEFINE A ACCESS LEVEL
				@comapny 		= 1
				@branch  		= 2
				@contractor 	= 3
				@sub-contractor = 4
				@spg-user 		= 5
				@spg 			= 9
			*	
		*/
		$this->page['page_title']="Dashboard";
		$this->page['user_type']="spg";
		$this->page['access']  = array( 1=>FALSE, 
										2=>FALSE,
										3=>FALSE,
										4=>FALSE,
										5=>FALSE,
										9=>TRUE
									);
		// menubare access setting
		$this->page['menu']=array(
			// dashbord access if true to dispaly and flase it hide
			"dashboard_access" 		=> TRUE,
			// notification access if true to dispaly and flase it hide
			"notification_access" => TRUE//
			);
		

	}
	/*
		* CREATE SYSTEM FUNCTION CREATE A TABLES IN YOUR SELCTION DATABASE.
		* IT IS AUTOMATIC GENRATED TABLES USING THIS FUNCTION.
		* YOU CANN DESTROY THE ALL TABLE WHEN USING "DESTROY_SYSTEM()";
		* WHEN USING THE DESTROY FUNCTION THEN SYSTEM HAS DOWN AND MULTIPLY THE BUGS. 
	*/
	public function CREATE_SYSTEM()
	{
		$this->DB_install->CreateTable_customer_master();
		$this->DB_install->CreateTable_custid_backup();
		$this->DB_install->CreateTable_act_particular();
		$this->DB_install->CreateTable_act_applicable_to_customer();
		$this->DB_install->CreateTable_compliance_scope();

	}
	public function DESTROY_SYSTEM()
	{
		$this->DB_install->DropTable_customer_master();
		$this->DB_install->DropTable_custid_backup();
		$this->DB_install->DropTable_act_particular();
		$this->DB_install->DropTable_act_applicable_to_customer();
		$this->DB_install->DropTable_compliance_scope();

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
	
	/*
		*  THIS FUNCTION DISPLAY THE REGISTRATION VIEW		
	*/

	public function company_registration_view()
	{
		// $this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		
		$this->company_registration($this->page);
	}
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
	public function sub_act_id()
	{
		$this->get_sub_act_id(); // this function store in Act trait
	}


	/* start process with employee */
	// display employee details with master setup
	public function view_employee_master($value='')
	{
		# code...
	}
	// display employee form
	public function view_employee_form($value='')
	{
		$this->CreateEmployee($this->page); // this function store in Employee trait
	}





	public function logout()
	{
		redirect('Home/quite');
	}
	
	public function f($value='')
	{
		$this->load->model('Company_model');
		$d=$this->Company_model->get_acts('14000590008');
		echo "<pre>";
		var_dump($d);
	}
	
}	
