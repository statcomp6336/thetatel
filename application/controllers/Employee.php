<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Employee {

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
		$this->load->model('Employee_model','emp');
		// $ruls=!empty($this->input->post('acts'))?$this->act_rules():$this->sub_act_rules();
		$this->form_validation->set_rules($this->employee_rules());
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/employee/create'));   
	        } 
	        else
	        {
	         	
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
		array('' => $this->input->post('emp_nane'), 
		'' => $this->input->post('parent_name'),
		'' => $this->input->post('gender'),
		'' => $this->input->post('m_status'),
		'' => $this->input->post('emp_date'),
		'' => $this->input->post('education'),
		'' => $this->input->post('p_address'),
		'' => $this->input->post('c_address'),
		'' => $this->input->post('emp_mail'),
		'' => $this->input->post('emp_mob'),
		'' => $this->input->post('handicap'),
		'' => $this->input->post('phy_handi_cap'),
		'' => $this->input->post('rel_name'),
		'' => $this->input->post('rel_dob'),
		'' => $this->input->post('rel_age'),
		'' => $this->input->post('rel_aadhar'),
		'' => $this->input->post('nom1'),
		'' => $this->input->post('nom2'),
		'' => $this->input->post('nom3'),
		'' => $this->input->post('nom4'),
		'' => $this->input->post('bank_name'),
		'' => $this->input->post('branch_name'),
		'' => $this->input->post('ac_no'),
		'' => $this->input->post('ifsc_no'),
		'' => $this->input->post('emp_pan'),
		'' => $this->input->post('pan_name'),
		'' => $this->input->post('emp_aadhar'),
		'' => $this->input->post('adhar_name'),
		'' => $this->input->post('pf_dud'),
		'' => $this->input->post('user_limit'),
		'' => $this->input->post('esic_dud'),
		'' => $this->input->post('ex_esic_no'),
		'' => $this->input->post('una_no'),
		'' => $this->input->post('dob_as_adhar'),
		'' => $this->input->post('comp_name'),
		'' => $this->input->post('comp_branch'),
		'' => $this->input->post('comp_code'),
		'' => $this->input->post('dept'),
		'' => $this->input->post('emp_post'),
		'' => $this->input->post('loc'),
		'' => $this->input->post('join_date'),
		'' => $this->input->post('ex_date'),
		'' => $this->input->post('mem_date'),
		'' => $this->input->post('worker'),
		'' => $this->input->post('emp_sts'),
		'' => $this->input->post('contractor'),
		'' => $this->input->post('vendor'),
		
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
             'field'   => 'phy_handi_cap', 
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