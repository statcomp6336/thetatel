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
		    // redirect(base_url('Home/user_login'));
		}		
	}

	/*----------------------*/
	public function is_valid($data)
		{

			$set = array('cid' => $data['cid'],
					  	  'username' => $data['username'],
					  	  'password' => $data['password'] );
			

			// $set = $this->li->security->xss_clean($set);

			$this->form_validation->set_rules('cid', 'Customer id', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|strip_tags');
	        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|strip_tags|min_length[5]|max_length[52]');      
			
	         if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
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
						redirect(base_url('Company'));
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



		

	


}
