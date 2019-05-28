<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Employee {

  public function ShowEmployees($page_data='')
  {
    if ($page_data['access'][$this->session->TYPE] == TRUE) {
       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Employee';
       $this->data['sub_menu'] = 'Details';
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
      
       $this->render('master_employee');
     }
     else
     {
      echo "404 no access";
     }
  }

	public function CreateEmployee($page_data="")
	{
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Employee';
			 $this->data['sub_menu'] = 'Registration';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
       $this->render('employee_register');
			
		 }
		 else
		 {
		 	echo "404 no access";
		 }
	}
	/* insert employee details in database */
	public function SaveEmployee($user)
	{
		// $this->load->model('Employee_model','emp');
		// $ruls=!empty($this->input->post('acts'))?$this->act_rules():$this->sub_act_rules();
		$this->form_validation->set_rules($this->employee_rules());
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/employee/create'));   
	        } 
	        else
	        {
	         	echo "<pre>";
	         	var_dump($this->fillup_employee());
	         
	         	// if ($this->Act_model->create_act($this->fillup_acts())) {
	         		
	         	// 	 put_msg("your Act is registerd successfully..!!");
	         	// 	 // redirect(base_url( $user.'/act/create'));
	         	// }
	         	// else
	         	// {
	         	// 	put_msg("somthing went wronge...!");
	         	// 	 // redirect(base_url( $user.'/act/create'));
	         	// }
	        }
	}

	/* get detail from employee form */
	public function fillup_employee($value='')
	{
		$save_employee = 
		array(
		'emp_name' 			=> $this->input->post('emp_name'), 
		'fath_hus_name' 	=> $this->input->post('parent_name'),
		'gender' 			=> $this->input->post('gender'),
		'marital_status'	=> $this->input->post('m_status'),
		'birth_date' 		=> $this->input->post('emp_dob'),
		'education' 		=> $this->input->post('education'),
		'per_address' 		=> $this->input->post('p_address'),
		'temp_address' 		=> $this->input->post('c_address'),
		'email' 			=> $this->input->post('emp_mail'),
		'mob' 				=> $this->input->post('emp_mob'),
		'phy_handi' 		=> $this->input->post('handicap'),
		'phy_handi_cat' 	=> $this->input->post('phy_handi_cat'),
		'relname' 			=> $this->input->post('rel_name'),
		'reldob' 			=> $this->input->post('rel_dob'),
		'relage' 			=> $this->input->post('rel_age'),
		'reladhr' 			=> $this->input->post('rel_aadhar'),
		'nom1' 				=> $this->input->post('nom1'),
		'nom2' 				=> $this->input->post('nom2'),
		'nom3' 				=> $this->input->post('nom3'),
		'nom4' 				=> $this->input->post('nom4'),
		'bank_name' 		=> $this->input->post('bank_name'),
		'bank_branch' 		=> $this->input->post('branch_name'),
		'bank_ac' 			=> $this->input->post('ac_no'),
		'ifsc' 				=> $this->input->post('ifsc_no'),
		'pan' 				=> $this->input->post('emp_pan'),
		'namepan' 			=> $this->input->post('pan_name'),
		'adhaar' 			=> $this->input->post('emp_aadhar'),
		'nameadhr' 			=> $this->input->post('adhar_name'),
		'pf_deduct' 		=> $this->input->post('pf_dud'),
		'ul_pf' 			=> $this->input->post('user_limit'),
		'esic_deduct' 		=> $this->input->post('esic_dud'),
		'esic_no' 			=> $this->input->post('ex_esic_no'),
		'una_no' 			=> $this->input->post('una_no'),
		'dobadhr' 			=> $this->input->post('dob_as_adhar'),
		'entity_name'		=> $this->input->post('comp_name'),
		'branch' 			=> $this->input->post('comp_branch'),
		'custid' 			=> $this->input->post('comp_code'),
		'dept' 				=> $this->input->post('dept'),
		'designation' 		=> $this->input->post('emp_post'),
		'location' 			=> $this->input->post('loc'),
		'join_date' 		=> $this->input->post('join_date'),
		'exit_date' 		=> $this->input->post('ex_date'),
		'member_date' 		=> $this->input->post('mem_date'),
		'int_worker' 		=> $this->input->post('worker'),
		'emp_status' 		=> $this->input->post('emp_sts'),
		'contractor_name' 	=> $this->input->post('contractor'),
		'vendor_id' 		=> $this->input->post('vendor')
		
	);

		return $this->security->xss_clean($save_employee);
	}
	/* Rules for employee form */
	 public function employee_rules($value='')
	 {
	 	$emp_rules = array(
       array(
             'field'   => 'emp_name', 
             'label'   => 'Employee Name', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'parent_name', 
             'label'   => 'Parent Name', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'gender', 
             'label'   => 'Gender', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'm_status', 
             'label'   => 'Marital Status', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'emp_dob', 
             'label'   => 'Employee Date of Birth', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'education', 
             'label'   => 'Education Qualification', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'p_address', 
             'label'   => 'Perment Address', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'c_address', 
             'label'   => 'Current Address', 
             'rules'   => 'required'
          ),array(
             'field'   => 'emp_mail', 
             'label'   => 'Employee Email Address', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'emp_mob', 
             'label'   => 'Employee phone number', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'handicap', 
             'label'   => 'Physical Handicap', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'phy_handi_cat', 
             'label'   => 'Physically Handicap Catogary', 
             'rules'   => 'required'
          ),array(
             'field'   => 'rel_name', 
             'label'   => 'Relation Name', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'rel_dob', 
             'label'   => 'Relation Date of Birth', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'rel_aadhar', 
             'label'   => 'Relation Aadhar', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'nom1', 
             'label'   => 'Nomination 1', 
             'rules'   => 'required'
          ),array(
             'field'   => 'nom2', 
             'label'   => 'Nomination 2', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'nom3', 
             'label'   => 'Nomination 3', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'nom4', 
             'label'   => 'Nomination 4', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'bank_name', 
             'label'   => 'Bank Name', 
             'rules'   => 'required'
          ),array(
             'field'   => 'branch_name', 
             'label'   => 'Branch Name', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'ac_no', 
             'label'   => 'Account Number', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'ifsc_no', 
             'label'   => 'IFSC Code', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'emp_pan', 
             'label'   => 'Employee PAN Number', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'pan_name', 
             'label'   => 'Name as per PAN Card', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'emp_aadhar', 
             'label'   => 'Aadhar Number', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'adhar_name', 
             'label'   => 'Name as per Aadhar', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'pf_dud', 
             'label'   => 'Require PF Deduction', 
             'rules'   => 'required'
          ),array(
             'field'   => 'user_limit', 
             'label'   => 'User Limit', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'esic_dud', 
             'label'   => 'Require ESIC Deduction', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'ex_esic_no', 
             'label'   => 'Existing ESIC Number', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'una_no', 
             'label'   => 'Existing UNA Number', 
             'rules'   => 'required'
          ),array(
             'field'   => 'dob_as_adhar', 
             'label'   => 'DOB as per Aadhar Card', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'comp_name', 
             'label'   => 'Company Name', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'comp_branch', 
             'label'   => 'Company Branch', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'dept', 
             'label'   => 'Department', 
             'rules'   => 'required'
          ),array(
             'field'   => 'emp_post', 
             'label'   => 'Designation', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'loc', 
             'label'   => 'Location', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'join_date', 
             'label'   => 'Employee Join Date', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'ex_date', 
             'label'   => 'Existing Date', 
             'rules'   => 'required'
          ),array(
             'field'   => 'mem_date', 
             'label'   => 'Membership Date', 
             'rules'   => 'required'
          ),
       array(
             'field'   => 'worker', 
             'label'   => 'Internation Worker', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'emp_sts', 
             'label'   => 'Employee Status', 
             'rules'   => 'required'
          ),
        array(
             'field'   => 'contractor', 
             'label'   => 'Contractor Name', 
             'rules'   => 'required'
          ),array(
             'field'   => 'vendor', 
             'label'   => 'Vendor ID', 
             'rules'   => 'required'
          )
      
				           );
		return $emp_rules;
	 }
}