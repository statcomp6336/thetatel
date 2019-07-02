<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."core\Base_controller.php";
 // require_once APPPATH."third_party\Thetatel_login.php";
 
class Home extends Base_controller {

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
		$this->load->model('DB_install');

	}

/*
		* CREATE SYSTEM FUNCTION CREATE A TABLES IN YOUR SELCTION DATABASE.
		* IT IS AUTOMATIC GENRATED TABLES USING THIS FUNCTION.
		* YOU CANN DESTROY THE ALL TABLE WHEN USING "DESTROY_SYSTEM()";
		* WHEN USING THE DESTROY FUNCTION THEN SYSTEM HAS DOWN AND MULTIPLY THE BUGS. 

	*/

	public function CREATE_SYSTEM()
	{
		$this->DB_install->create_tables();
		
	}
	public function DESTROY_SYSTEM()
	{
		$this->DB_install->drop_tables();
	}

	public function index()
	{
		// Source ITT (Labor Law Consultancy Services)
		$this->data['page_title']="Complaincetrack";
		$this->load->view('flashscreen',$this->data);
	}
	
	public function user_login()
	{
		if ($this->is_login() == TRUE) {
			$this->goto_dashboard();
		}
		else{
		$this->data['page_title']="Source ITT (Labor Law Consultancy Services)";
		$this->load->view('user_login',$this->data);
		}
	}
	public function login_exicution()
	{
		$put= array('cid'=> $this->input->post('cid'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'));
		$put = $this->security->xss_clean($put);
		if ($this->is_valid($put) == TRUE) {
			if ($this->login_model->check_login($put) == TRUE) {				
				$this->goto_dashboard();
			}
			else
			{				
				goto_back();
			}
		}
		else
		{
			goto_back();	   
		}		
	}

	/*----------------------*/
	public function is_valid($data)
		{

			$set = array('cid' => $data['cid'],
					  	  'username' => $data['username'],
					  	  'password' => $data['password'] );
			

			// $set = $this->li->security->xss_clean($set);

			$this->form_validation->set_rules('cid', 'Customer id', 'required|trim|numeric|xss_clean|strip_tags');
			$this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|strip_tags');
	        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|strip_tags|callback_valid_password');      
			
	         if ($this->form_validation->run() == FALSE) {	         	
	         	put_msg(validation_errors());
	         	return FALSE;   
	        } 
	        else
	        {
	         	return TRUE;
	        }
		}
		/* redirect to dashboard */
		public function goto_dashboard($value='')
		{
			if ($this->is_login()== TRUE) {
				# code...
				$type=$this->session->TYPE;
					switch ($type) {
					
					case '1':
						echo "1";
						redirect(base_url('company'));
						break;
					case '2':
						echo "2";
						redirect(base_url('Branch'));
						break;
					case '3':
						echo "3";
						redirect(base_url('Contractor'));
						break;
					case '4':
						echo "4";
						redirect(base_url('Sub_contractor'));
						break;
					case '5':
						echo "5";
						redirect(base_url('Spg_user'));
						break;
					case '55':
						echo "55";
						break;
					case '9':
						echo "9";
						redirect(base_url('spg'));
						break;					
							
					default:
						redirect(base_url('Home'));
						break;
				}
			}
			else
			{
				redirect(base_url('Home'));
			}
		}
		public function quite()
		{
			$this->session->sess_destroy();
			redirect(base_url('Home/user_login'));
		}

	public function forgot_password($value='')
		{
			$this->load->view('forgot_password');
		}

	public function scan($value='')
	{
		$dir = './assets';
echo $dir;
		// Run the recursive function 

		$response = $this->search($dir);
		$myfiles = scandir($dir, 1); 
		  
		//displaying the files in the directory 
		print_r($myfiles); 
		// Output the directory listing as JSON

		header('Content-type: application/json');

		echo json_encode(array(
			"name" => "files",
			"type" => "folder",
			"path" => $dir,
			"items" => $response
		));
}

		// This function scans the files folder recursively, and builds a large array

		public function search($dir){

			$files = array();

			// Is there actually such a folder/file?

			if(file_exists($dir)){
			
				foreach(scandir($dir) as $f) {
				
					if(!$f || $f[0] == '.') {
						continue; // Ignore hidden files
					}

					if(is_dir($dir . '/' . $f)) {

						// The path is a folder

						$files[] = array(
							"name" => $f,
							"type" => "folder",
							"path" => $dir . '/' . $f,
							"items" => $this->search($dir . '/' . $f) // Recursively get the contents of the folder
						);
					}
					
					else {

						// It is a file

						$files[] = array(
							"name" => $f,
							"type" => "file",
							"path" => $dir . '/' . $f,
							"size" => filesize($dir . '/' . $f) // Gets the size of this file
						);
					}
				}
			
			}

			return $files;
		}


		public function valid_password($password = '')
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		// $regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+;:,.§~]/';
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}
		// if (preg_match_all($regex_uppercase, $password) < 1)
		// {
		// 	$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
		// 	return FALSE;
		// }
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+;:,.§~'));
			return FALSE;
		}
		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}
		return TRUE;
	}



		

	


}
