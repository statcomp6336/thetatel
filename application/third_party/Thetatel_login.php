<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
trait Thetatel_login  
{

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
	var $li;
	public function __construct($value='')
	{
		# code...
		parent::__construct();
		$this->li= & get_instance();
	}
	/*----- go back---*/
	public function goto_back()
		{
			echo "<script> window.history.back(); </script>";
		}
	public function put_msg($msg="")
		{
			return $this->li->session->set_flashdata('msg',$msg);
		}
		public function show_msg()
		{
			return $this->li->session->flashdata('msg');
		}	
	/* ----- clean the string ----*/
	public function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
	/*----- check the pass connent are not empty ----*/

	public function is_valid($data)
		{

			$set = array('cid' => $data['cid'],
					  	  'username' => $data['username'],
					  	  'password' => $data['password'] );
			

			// $set = $this->li->security->xss_clean($set);

			$this->li->form_validation->set_rules('cid', 'Customer id', 'required|trim|xss_clean|strip_tags');
			$this->li->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|strip_tags');
	        $this->li->form_validation->set_rules('password', 'Password', 'required|xss_clean|strip_tags|min_length[5]|max_length[52]');      
			
	         if ($this->li->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	$this->put_msg(validation_errors());
	         	return FALSE;   
	        } 
	        else
	        {
	         	return TRUE;
	        }
		}

}
