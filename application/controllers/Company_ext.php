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
		$reg_type=$this->uri->segment(2);
		$this->data['reg_type']=$reg_type;	
		
		 if ($this->data['access'][$this->session->TYPE] == TRUE && (IS_SPG== TRUE || IS_SPGUSER == TRUE)) {		 	 
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Registration';
			 // $this->render('company_registration');
			 $this->render('comp_reg');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }		
	}

	/*++++++ create a  COMPANY ++++++*/
	protected function CreateCompany($user)
	{
		$this->load->model('Company_model');
		$cust_type=is($this->input->post('cust_type'),1);	
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
	         		$html="Company is registerd successfully.<br> Please Note the following details for future reference.<br>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Company Name : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$this->input->post('comp_name')."</div></div>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Company Register Id : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$custid."</div></div><br>";
	         		 put_msg($html);
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	         	else
	         	{
	         		put_msg("something went wronge...!");
	         		 redirect(base_url( $user.'/company/registration'));
	         	}
	        }

	}

/*++++++ CREATE A BARANCH ++++++*/
	protected function CreateBranch($user)
	{
		$this->load->model('Company_model');
		$cust_type=2;	
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
	         		$html="Branch is registerd successfully.<br> Please Note the following details for future reference.<br>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Branch Name : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$this->input->post('comp_name')."</div></div>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Branch Register Id : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$custid."</div></div><br>";
	         		 put_msg($html);
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
	         		 $html="Contractor is registerd successfully.<br> Please Note the following details for future reference.<br>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Contractor Name : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$this->input->post('comp_name')."</div></div>";
	         		$html.="<div class='row'><div class='col-sm-6 col-md-6 col-lg-6'>";
	         		$html.="<lable class='pull-left'>Contractor Register Id : </lable></div><div class='col-sm-6 col-md-6 col-lg-6' style='text-align:center'>".$custid."</div></div><br>";
	         		 put_msg($html);
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
                     'rules'   => 'required|xss_clean'
                  ),
               array(
                     'field'   => 'ent_code', 
                     'label'   => 'Entity Code', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
               array(
                     'field'   => 'comp_pan', 
                     'label'   => 'Company PAN Number', 
                     'rules'   => 'required|xss_clean|strtoupper'
                  ),   
               array(
                     'field'   => 'comp_name', 
                     'label'   => 'Company Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                array(
                     'field'   => 'comp_addr', 
                     'label'   => 'Company Address', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'comp_landmark', 
                     'label'   => 'Company Landmark', 
                     'rules'   => 'required|xss_clean'
                  ),
                  array(
                     'field'   => 'comp_state', 
                     'label'   => 'State', 
                     'rules'   => 'required|xss_clean'
                  ),
                  array(
                     'field'   => 'comp_pin', 
                     'label'   => 'Company Pincode', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),   
               array(
                     'field'   => 'comp_phone', 
                     'label'   => 'Corporate Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
                array(
                     'field'   => 'hr_ex_name', 
                     'label'   => 'HR Executive Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'hr_ex_mail', 
                     'label'   => 'HR Executive Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'hr_ex_phone', 
                     'label'   => 'HR Executive Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
                  array(
                     'field'   => 'hr_mg_name', 
                     'label'   => 'HR Manager Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'hr_mg_mail', 
                     'label'   => 'HR Manager Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'hr_mg_phone', 
                     'label'   => 'HR Manager Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
                  array(
                     'field'   => 'hr_vp_name', 
                     'label'   => 'HR Vice Precident Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'hr_vp_mail', 
                     'label'   => 'HR Vice Precident Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'hr_vp_phone', 
                     'label'   => 'HR Vice Precident Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),


                  array(
                     'field'   => 'sp_ex_name', 
                     'label'   => 'Service Provider Executive Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'sp_ex_mail', 
                     'label'   => 'Service Provider Executive Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'sp_ex_phone', 
                     'label'   => 'Service Provider Executive Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
                  array(
                     'field'   => 'sp_mg_name', 
                     'label'   => 'Service Provider Manager Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'sp_mg_mail', 
                     'label'   => 'Service Provider Manager Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'sp_mg_phone', 
                     'label'   => 'Service Provider Manager Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  ),
                  array(
                     'field'   => 'sp_vp_name', 
                     'label'   => 'Service Provider Vice Precident Name', 
                     'rules'   => 'required|xss_clean'
                  ),
                 array(
                     'field'   => 'sp_vp_mail', 
                     'label'   => 'Service Provider Vice Precident Email ', 
                     'rules'   => 'required|xss_clean|valid_email'
                  ),
                  array(
                     'field'   => 'sp_vp_phone', 
                     'label'   => 'Service Provider Vice Precident Phone Number', 
                     'rules'   => 'required|xss_clean|trim|numeric'
                  )
              );
			return $company_rules;
	}

	protected function fillup_data($custtype="",$custid="")
	{
		if (!empty($this->input->post('cust_id'))) {
			$custid=$this->input->post('cust_id');
		}

		$branch_code= $this->Company_model->get_branchCode($this->input->post('comp_pan'));
		$save_data = array('custtype' 		=> 1 ,
							'custid'		=>$custid,
							'allianceid'	=> $this->input->post('ent_code') ,
							'alliance_name'	=> $this->input->post('ent_name') ,
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
							'branch_code' 	=> $branch_code,
							'spgid'			=> user_id(), 
							
		 );
		if (!empty($this->input->post('cust_id'))) {
			unset($save_data['custid']);
			unset($save_data['allianceid']);
			unset($save_data['alliance_name']);
			unset($save_data['pin']);
		}
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

	 /* Show Company Details */
	 public function ShowCompanyDetails($page_data = '')
	 {
		$this->load->model('Company_model');
		$reg_type=$this->uri->segment(2);
		$this->data['reg_type']=$reg_type;	
	 
	 	if($reg_type=="branch")
	 	{
	 		$this->data['where'] = 'Branch';
	 	}
	 	elseif($reg_type=="contractor")
	 	{
	 		$this->data['where'] = 'Contractor';
	 	}
	 	elseif($reg_type=="subcontractor")
	 	{
	 		$this->data['where'] = 'Sub Contractor';
	 	}
       
       $this->data['sub_menu'] = 'Registration Details';
       $this->data['result']=$this->Company_model->get_allCompanydetails($reg_type);
		
		$this->render('show_company');
	 }

//Here create branch registration view
	public function branch_registration($page_data = '')
	{
		$reg_type=$this->uri->segment(2);
		$this->data['reg_type']=$reg_type;

		 if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 
			 $this->data['where'] = 'Branch';
			 $this->data['sub_menu'] = 'Registration';			
			 $custid=is(verify_id($this->uri->segment(4)),'N/A');
			 $name=is(verify_id($this->uri->segment(5)),'N/A');
			  $this->data['custid']=$custid;
			   $this->data['name']= $name;
			 $this->render('comp_reg');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }						
	}

	//Here create Contractor registration view
	public function contractor_registration($page_data="")
	{
		$reg_type=$this->uri->segment(2);
		$this->data['reg_type']=$reg_type;

		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 	
			 $this->data['where'] = 'Contractor';
			 $this->data['sub_menu'] = 'Registration';
			
			 $custid=is(verify_id($this->uri->segment(4)),'N/A');
			 $name=is(verify_id($this->uri->segment(5)),'N/A');
			  $this->data['custid']=$custid;
			   $this->data['name']= $name;
			 $this->render('comp_reg');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }		
	}

	//Here create Sub-Contractor registration view
	public function subcontractor_registration($page_data="")
	{
		$reg_type=$this->uri->segment(2);
		$this->data['reg_type']=$reg_type;

		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 
			 $this->data['where'] = 'Sub Contractor';
			 $this->data['sub_menu'] = 'Registration';
			
			 $custid=is(verify_id($this->uri->segment(4)),'N/A');
			 $name=is(verify_id($this->uri->segment(5)),'N/A');
			  $this->data['custid']=$custid;
			   $this->data['name']= $name;
			 $this->render('comp_reg');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }		
	}

	public function company_act($page_data='')
	{
		$this->load->model('Company_model');
		$result='';
		if(!empty($this->input->post('submit')))
		{
			$custid=is($this->input->post('custid'),'N/A');
			// $result=$this->Company_model->get_attachActs($custid);
			$result=$this->Company_model->get_acts($custid);
		}
		 if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 	
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Select Act for Compailation';
			
			 /*main act data*/
			 $this->data['result']=$result;
			 $this->data['companys']=$this->Company_model->all_companys();
			 // $this->render('act_view');
			 $this->render('view_ActsForBulkUpdate');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }		
	}

	/*+++ attach the act to the specific company +++*/

	public function put_on_act_to_company($user)
	{
		$this->load->model('Company_model');
		$save_acts=array('custid'	 => is($this->input->post('custId')) ,
						  'name'	 => $this->input->post('compName'),
						  'act_code' => $this->input->post('actCode'),
						 
						  );

		$save_acts = $this->security->xss_clean($save_acts);	              
	         	if ($this->Company_model->attach_act_to_company($save_acts)) {
	         		
	         		 put_msg("your Company Acts is registerd successfully..!!");
	         		 redirect(base_url( $user.'/company/act'));
	         	}
	         	else
	         	{
	         		 redirect(base_url( $user.'/company/act'));
	         	}
	        // }
	}
	public function ShowEntityList()
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 	
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Entity Details';
			
			 /*main act data*/
			
			 $this->load->model('Company_model');
 					 
 			$this->data['result']= $this->Company_model->get_Entities();			 
			 $this->render('entity_details');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }	
	}


	public function EditEntity($value='')
	{		
		if ($this->data['access'][$this->session->TYPE] == TRUE) {		 	
			 $this->data['where'] = 'Company';
			 $this->data['sub_menu'] = 'Entity Details';
			
			 /*main act data*/
			$id=verify_id($this->uri->segment(3));

			 $this->load->model('Company_model');
 					 
 			$this->data['entity']= $this->Company_model->all_companys($id);	

			 $this->render('edit_entity');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }

	}
	public function UpdateEntity($user='')
	{
		$this->load->model('Company_model');		
		$this->form_validation->set_rules($this->rules());	
		
		$save_data = $this->security->xss_clean($this->fillup_data());
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url(''.$user.'/entity-edit/'.hash_id($this->input->post('cust_id')).''));   
	        } 
	        else
	        {

	         	if ($this->Company_model->update_entity($this->fillup_data(),$this->input->post('cust_id'))) {
	         	
	         		 $html="Entity has updated successfully";
	         		
	         		 put_msg($html);
	         		redirect(base_url(''.$user.'/entity-edit/'.hash_id($this->input->post('cust_id')).''));  
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url(''.$user.'/entity-edit/'.hash_id($this->input->post('cust_id')).''));  
	         	}
	        }
	}
	public function RemoveEntity($user='')
	{
		$id=verify_id($this->uri->segment(3));
			 $this->load->model('Company_model');
		if ($this->Company_model->delete_entity($id)) {
	         	
	         		 $html="Entity has remove successfully";
	         		
	         		 put_msg($html);
	         		redirect(base_url(''.$user.'/entity-list'));  
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url(''.$user.'/entity-list')); 
	         	}
	}



	
}