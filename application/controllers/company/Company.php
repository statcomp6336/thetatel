<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
 // require_once APPPATH."third_party\Thetatel_login.php";
 
class Company extends Base_controller {

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
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');

	}
	public function index()
	{
		// Source ITT (Labor Law Consultancy Services)
		$this->data['page_title']="Complaincetrack";
		$this->render('flashscreen');
	}
}	
