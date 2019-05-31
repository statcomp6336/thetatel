<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Company_ext {
	public $type;

	public function __construct() {
		$this->load->model('Company_model');
         $type=$this->session->TYPE;
    }

	public function company_registration($page_data="")
	{
		// $this->load->model('Dashboard_model','dash');
		
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Registration';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->render('company_registration');
		 }
		 else
		 {
		 	echo "404 no access";
		 }				
		// $this->render('example');		
	}
	/*++++++ create a  COMPANY ++++++*/
	protected function CreateCompany($user)
	{
		$this->load->model('Company_model');
		$cust_type=1;	
		$this->form_validation->set_rules($this->rules());
		$custid=$this->Company_model->get_custid($this->input->post('comp_pin'),$cust_type);
		// echo $custid;
		
		
		
		$save_data = $this->security->xss_clean($this->fillup_data($cust_type,$custid));
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/company/registration'));   
	        } 
	        else
	        {
	         	// return TRUE;
	         
	         	if ($this->Company_model->create_company($this->fillup_data($cust_type,$custid))) {
	         		$this->Company_model->create_backup_company($this->backup_fillup_data($cust_type,$custid));
	         		 put_msg("your Company is registerd successfully..!!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	        }

	}

/*++++++ CREATE A BARANCH ++++++*/
	protected function CreateBranch($user)
	{
		$this->load->model('Company_model');
		$cust_type=1;	
		$this->form_validation->set_rules($this->rules());
		$custid=$this->Company_model->get_custid($this->input->post('comp_pin'),$cust_type);
		// echo $custid;
		
		
		
		$save_data = $this->security->xss_clean($this->fillup_data($cust_type,$custid));
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/company/registration'));   
	        } 
	        else
	        {
	         	// return TRUE;
	         
	         	if ($this->Company_model->create_company($this->fillup_data($cust_type,$custid))) {
	         		$this->Company_model->create_backup_company($this->backup_fillup_data($cust_type,$custid));
	         		 put_msg("your Company is registerd successfully..!!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	        }


	}
	/*++++++ CREATE A CONTRACTORE +++++*/
	protected function CreateContractore($user)
	{
		$this->load->model('Company_model');
		$cust_type=3;	
		$this->form_validation->set_rules($this->rules());
		$custid=$this->Company_model->get_custid($this->input->post('comp_pin'),$cust_type);
		// echo $custid;
		
		
		
		$save_data = $this->security->xss_clean($this->fillup_data($cust_type,$custid));
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/company/registration'));   
	        } 
	        else
	        {
	         	// return TRUE;
	         
	         	if ($this->Company_model->create_company($this->fillup_data($cust_type,$custid))) {
	         		$this->Company_model->create_backup_company($this->backup_fillup_data($cust_type,$custid));
	         		 put_msg("your Company is registerd successfully..!!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	        }

	}

	/*+++++ CREATE A SUBCONTRACTOR +++++++*/
	protected function CreateSub_Contractor($user)
	{
		// $this->load->model('Company_model');
		$cust_type=4;	
		$this->form_validation->set_rules($this->rules());
		$custid=$this->Company_model->get_custid($this->input->post('comp_pin'),$cust_type);
		// echo $custid;
		
		
		
		$save_data = $this->security->xss_clean($this->fillup_data($cust_type,$custid));
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/company/registration'));   
	        } 
	        else
	        {
	         	// return TRUE;
	         
	         	if ($this->Company_model->create_company($this->fillup_data($cust_type,$custid))) {
	         		$this->Company_model->create_backup_company($this->backup_fillup_data($cust_type,$custid));
	         		 put_msg("your Company is registerd successfully..!!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	        }

	}




	protected function rules()
	{
		$company_rules = array(
               array(
                     'field'   => 'ent_name', 
                     'label'   => 'Entity Name', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'ent_code', 
                     'label'   => 'Entity Code', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'comp_pan', 
                     'label'   => 'Company PAN Number', 
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'comp_name', 
                     'label'   => 'Company Name', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'comp_addr', 
                     'label'   => 'Company Address', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'comp_landmark', 
                     'label'   => 'Company Landmark', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'comp_state', 
                     'label'   => 'State', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'comp_pin', 
                     'label'   => 'Company Pincode', 
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'comp_phone', 
                     'label'   => 'Corporate Phone Number', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'hr_ex_name', 
                     'label'   => 'HR Executive Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'hr_ex_mail', 
                     'label'   => 'HR Executive Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'hr_ex_phone', 
                     'label'   => 'HR Executive Phone Number', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'hr_mg_name', 
                     'label'   => 'HR Manager Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'hr_mg_mail', 
                     'label'   => 'HR Manager Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'hr_mg_phone', 
                     'label'   => 'HR Manager Phone Number', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'hr_vp_name', 
                     'label'   => 'HR Vice Precident Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'hr_vp_mail', 
                     'label'   => 'HR Vice Precident Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'hr_vp_phone', 
                     'label'   => 'HR Vice Precident Phone Number', 
                     'rules'   => 'required'
                  ),


                  array(
                     'field'   => 'sp_ex_name', 
                     'label'   => 'Service Provider Executive Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'sp_ex_mail', 
                     'label'   => 'Service Provider Executive Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'sp_ex_phone', 
                     'label'   => 'Service Provider Executive Phone Number', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'sp_mg_name', 
                     'label'   => 'Service Provider Manager Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'sp_mg_mail', 
                     'label'   => 'Service Provider Manager Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'sp_mg_phone', 
                     'label'   => 'Service Provider Manager Phone Number', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'sp_vp_name', 
                     'label'   => 'Service Provider Vice Precident Name', 
                     'rules'   => 'required'
                  ),
                 array(
                     'field'   => 'sp_vp_mail', 
                     'label'   => 'Service Provider Vice Precident Email ', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'sp_vp_phone', 
                     'label'   => 'Service Provider Vice Precident Phone Number', 
                     'rules'   => 'required'
                  )
              );
			return $company_rules;
	}

	protected function fillup_data($custtype,$custid)
	{

		$branch_code= $this->Company_model->get_branchCode($this->input->post('comp_pan'));
		$save_data = array('custtype' 		=> 1 ,
							'custid'		=>$custid,
							'allianceid'	=> user_id(),//$this->input->post('ent_code') ,
							'entity_pan' 	=> $this->input->post('comp_pan') ,
							'entity_name' 	=> $this->input->post('comp_name') ,
							'address' 		=> $this->input->post('comp_addr') ,
							'landmark' 		=> $this->input->post('comp_landmark') ,
							'entity_email' 	=> $this->input->post('comp_mail') ,
							'pin' 			=> $this->input->post('comp_pin') ,
							'ph_no' 		=> $this->input->post('comp_phone') ,
							'res_person' 	=> $this->input->post('hr_ex_name') ,
							'res_email' 	=> $this->input->post('hr_ex_mail') ,
							'res_ph' 		=> $this->input->post('hr_ex_phone') ,
							'hr_person' 	=> $this->input->post('hr_mg_name') ,
							'hr_email' 		=> $this->input->post('hr_mg_mail') ,
							'hr_ph' 		=> $this->input->post('hr_mg_phone') ,
							'vp_person' 	=> $this->input->post('hr_vp_name') ,
							'vp_email'		=> $this->input->post('hr_vp_mail') ,
							'vp_ph' 		=> $this->input->post('hr_vp_phone') ,
							'dh_person' 	=> $this->input->post('sp_ex_name') ,
							'dh_email' 		=> $this->input->post('sp_ex_mail') ,
							'dh_ph' 		=> $this->input->post('sp_ex_phone') ,
							'dh_mgr' 		=> $this->input->post('sp_mg_name') ,
							'mgr_email' 	=> $this->input->post('sp_mg_mail') ,
							'mgr_ph' 		=> $this->input->post('sp_mg_phone') ,
							'dh_vp' 		=> $this->input->post('sp_vp_name') ,
							'dh_vp_email' 	=> $this->input->post('sp_vp_mail') ,
							'dh_vp_ph' 		=> $this->input->post('sp_vp_phone') ,
							'state' 		=> $this->input->post('comp_state'), 
							'branch_code' 	=> $branch_code 
							
		 );
		return $save_data;
	}
	 protected function backup_fillup_data($custtype, $custid)
	 {
	 	$backup_save_data = array('custtype' 		=> $custtype ,
							'custid'		=> $custid,
							'allianceid'	=> $this->input->post('ent_code') ,						
							'entity_name' 	=> $this->input->post('comp_name') ,							
							'entity_email' 	=> $this->input->post('comp_mail') ,
							'pin' 			=> $this->input->post('comp_pin') ,
							'ph_no' 		=> $this->input->post('comp_phone')						
		 );
	 	return $backup_save_data;

	 }







	public function branch_registration($page_data='')
	{
		# code...
	}

	public function company_act($page_data='')
	{
		$this->load->model('Company_model');
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Select Act for Compailation';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 /*main act data*/
			 $this->data['source']=$this->Company_model->all_companys();
			 $this->render('act_view');
		 }
		 else
		 {
		 	echo "404 no access";
		 }		
	}

	/*+++ attach the act to the specific company +++*/

	public function put_on_act_to_company($user)
	{
		$this->load->model('Company_model');
		$save_acts=array('custid'	 => $this->input->post('custId') ,
						  'name'	 => $this->input->post('compName'),
						  'act_code' => $this->input->post('actCode'),
						  'spgid'	 => user_id()
						  );
		$save_ats = $this->security->xss_clean($save_acts);
		 // if ($this->form_validation->run() == FALSE) { 
	  //        	// echo validation_errors();
	  //        	 put_msg(validation_errors());
	  //        	// redirect(base_url( $user.'/company/act'));   
	  //       } 
	  //       else
	        // {	
	        	$this->Company_model->attach_act_to_company($save_acts);
	        echo show_msg();         
	         	// if ($this->Company_model->attach_act_to_company($save_acts)) {
	         		
	         	// 	 put_msg("your Company Acts is registerd successfully..!!");
	         	// 	 redirect(base_url( $user.'/company/act'));
	         	// }
	         	// else
	         	// {
	         	// 	put_msg("somthing went wronge...!");
	         	// 	 redirect(base_url( $user.'/company/act'));
	         	// }
	        // }
	}



	
}