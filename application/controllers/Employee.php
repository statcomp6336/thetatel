<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Employee {

  public function ShowEmployees($page_data='')
  {
    if ($this->data['access'][$this->session->TYPE] == TRUE) {
          $this->load->model('Employee_model','emp');
          $this->load->library("pagination");  
          $this->data['where'] = 'Employee';
          $this->data['sub_menu'] = 'Details';    
          $config["base_url"] = base_url() .$this->data['user_type']."/employee/show";
          $config["total_rows"] = $this->emp->get_count();
          $config["per_page"] = 10;
          $config["uri_segment"] = 2;
          // $config['use_page_numbers'] = TRUE;
          $config['num_links'] = $this->emp->get_count();
                      // Open tag for CURRENT link.
            $config['cur_tag_open'] = '&nbsp;<a class="current">';

            // Close tag for CURRENT link.
            $config['cur_tag_close'] = '</a>';

            // By clicking on performing NEXT pagination.
            $config['next_link'] = 'Next';

            // By clicking on performing PREVIOUS pagination.
            $config['prev_link'] = 'Previous';


          $this->pagination->initialize($config);
           $this->data["links"] = explode('&nbsp;',$this->pagination->create_links() );

        $page = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        if ($this->is_spg()== TRUE) {
                $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);
            }
            elseif ($this->is_company()== TRUE) {
                $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);
            }
            elseif ($this->is_spg_user()== TRUE) {
                $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);
            }

        //$this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);
        $this->data['srno']=$page;

       $this->render('master_employee');
     }
     else
     {
      $this->load->view('404');
     }
  }

  /* import multipal employee from excel sheet  */
  public function SaveMasterEmployee($user="")
  {
    $this->load->model('Employee_model','emp');
    $path = 'uploads/employee/';   
            require_once APPPATH . "/third_party/excel/Classes/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if(empty($error)){
              if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                $ids=FALSE;
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
                if ($this->emp->company_exist($value['A'])== FALSE) {
                    unlink($inputFileName);
                    put_msg("company is not register your file uploaded");  
                    goto_back();            
                    exit();
                }
                  $excelid=$value['A'];       

    $e_code = $this->emp->is_uniqemployee(is($value['A']),is($value['D']),is($value['AB']),is($value['K']),is($value['AD']))?$value['D']:"N/A";
                  if ($e_code !== "N/A") {
                    if (!empty($value['A'])) {
                       if ($this->emp->in_employee_error($value['A'],$value['D']) == FALSE) {                  
                         $inserErrorData[$i]=array(
                                        'spgid'           => user_id(),
                                        'emp_name'        => $value['C'], 
                                        'emp_id'          => $value['D'],
                                        'fath_hus_name'   => $value['O'],
                                        'gender'          => $value['E'],
                                        'marital_status'  => $value['F'],
                                        'birth_date'      => $value['AP'],
                                        'education'       => $value['AL'],
                                        'per_address'     => $value['Z'],
                                        'temp_address'    => $value['AA'],
                                        'email'           => $value['X'],
                                        'mob'             => $value['Y'],
                                        'phy_handi'       => $value['AN'],
                                        'phy_handi_cat'   => $value['AO'],
                                        'relname'         => $value['R'],
                                        'reldob'          => $value['P'],
                                        'relage'          => $value['S'],
                                        'reladhr'         => $value['Q'],
                                        'nom1'            => $value['T'],
                                        'nom2'            => $value['U'],
                                        'nom3'            => $value['V'],
                                        'nom4'            => $value['W'],
                                        'bank_name'       => $value['AH'],
                                        'bank_branch'     => $value['AI'],
                                        'bank_ac'         => $value['AF'],
                                        'ifsc'            => $value['AG'],
                                        'pan'             => $value['AB'],
                                        'namepan'         => $value['AC'],
                                        'adhaar'          => $value['AD'],
                                        'nameadhr'        => $value['AE'],
                                        'pf_deduct'       => $value['G'],
                                        'ul_pf'           => $value['H'],
                                        'esic_deduct'     => $value['I'],
                                        'esic_no'         => $value['J'],
                                        'uan_no'          => is($value['K'],'N/A'),
                                        'dobadhr'         => $value['AK'],
                                        'entity_name'     => $value['B'],
                                        'branch'          => $value['L'],
                                        'custid'          => $value['A'],
                                        'dept'            => $value['M'],
                                        'designation'     => $value['N'],
                                        // 'location'        => !empty($value['AW'])?$value['AW']:'',
                                        'location'        => is($value['AW'],'N/A'),
                                        'join_date'       => $value['AQ'],
                                        'exit_date'       => $value['AS'],
                                        'member_date'     => $value['AR'],
                                        'int_worker'      => $value['AT'],
                                        'emp_status'      => $value['AM'],
                                        // 'contractor_name' => !empty($value['AV'])?$value['AV']:'',
                                        'contractor_name' => is($value['AV'],'N/A'),
                                        // 'current_emp_id'  => !empty($value['A'])?$value['A']:'',
                                        'current_emp_id'  => is($value['A'],'N/A'),
                                        // 'current_entity_name'=> !empty($value['D'])?$value['D']:'',
                                        'current_entity_name'=> is($value['D'],'N/A'),
                                        'flag'       => 1,

                                        );
                       }
                       else
                       {
                        // echo "error updated<br>";
                        $editErrorData=array(
                                        'spgid'           => user_id(),
                                        'emp_name'        => $value['C'], 
                                        'emp_id'          => $value['D'],
                                        'fath_hus_name'   => $value['O'],
                                        'gender'          => $value['E'],
                                        'marital_status'  => $value['F'],
                                        'birth_date'      => $value['AP'],
                                        'education'       => $value['AL'],
                                        'per_address'     => $value['Z'],
                                        'temp_address'    => $value['AA'],
                                        'email'           => $value['X'],
                                        'mob'             => $value['Y'],
                                        'phy_handi'       => $value['AN'],
                                        'phy_handi_cat'   => $value['AO'],
                                        'relname'         => $value['R'],
                                        'reldob'          => $value['P'],
                                        'relage'          => $value['S'],
                                        'reladhr'         => $value['Q'],
                                        'nom1'            => $value['T'],
                                        'nom2'            => $value['U'],
                                        'nom3'            => $value['V'],
                                        'nom4'            => $value['W'],
                                        'bank_name'       => $value['AH'],
                                        'bank_branch'     => $value['AI'],
                                        'bank_ac'         => $value['AF'],
                                        'ifsc'            => $value['AG'],
                                        'pan'             => $value['AB'],
                                        'namepan'         => $value['AC'],
                                        'adhaar'          => $value['AD'],
                                        'nameadhr'        => $value['AE'],
                                        'pf_deduct'       => $value['G'],
                                        'ul_pf'           => $value['H'],
                                        'esic_deduct'     => $value['I'],
                                        'esic_no'         => $value['J'],
                                        'uan_no'          => is($value['K'],'N/A'),
                                        'dobadhr'         => $value['AK'],
                                        'entity_name'     => $value['B'],
                                        'branch'          => $value['L'],
                                        'custid'          => $value['A'],
                                        'dept'            => $value['M'],
                                        'designation'     => $value['N'],
                                        'location'        => !empty($value['AW'])?$value['AW']:'',
                                        'join_date'       => $value['AQ'],
                                        'exit_date'       => $value['AS'],
                                        'member_date'     => $value['AR'],
                                        'int_worker'      => $value['AT'],
                                        'emp_status'      => $value['AM'],
                                        'contractor_name' => !empty($value['AV'])?$value['AV']:'',
                                        'current_emp_id'  => !empty($value['A'])?$value['A']:'',
                                        'current_entity_name'=> !empty($value['D'])?$value['D']:'',
                                        'flag'       => 1,

                                        );
                       }
                    }
                    
                  } 
                  else{                 
                   if (!empty($value['A'])) {
                    // echo "inserted<br>";
                    // echo "birth_date: ".$value['AQ'];

                     
                    $inserdata[$i]=array(
                    'spgid'           => user_id(),
                    'emp_name'        => $value['C'], 
                    'emp_id'          => $value['D'],
                    'fath_hus_name'   => $value['O'],
                    'gender'          => $value['E'],
                    'marital_status'  => $value['F'],
                    'birth_date'      => date('Y-m-d',strtotime($value['AP'])),
                    'education'       => $value['AL'],
                    'per_address'     => $value['Z'],
                    'temp_address'    => $value['AA'],
                    'email'           => $value['X'],
                    'mob'             => $value['Y'],
                    'phy_handi'       => $value['AN'],
                    'phy_handi_cat'   => $value['AO'],
                    'relname'         => $value['R'],
                    'reldob'          => date('Y-m-d',strtotime($value['P'])),
                    'relage'          => $value['S'],
                    'reladhr'         => $value['Q'],
                    'nom1'            => $value['T'],
                    'nom2'            => $value['U'],
                    'nom3'            => $value['V'],
                    'nom4'            => $value['W'],
                    'bank_name'       => $value['AH'],
                    'bank_branch'     => $value['AI'],
                    'bank_ac'         => $value['AF'],
                    'ifsc'            => $value['AG'],
                    'pan'             => $value['AB'],
                    'namepan'         => $value['AC'],
                    'adhaar'          => $value['AD'],
                    'nameadhr'        => $value['AE'],
                    'pf_deduct'       => $value['G'],
                    'ul_pf'           => $value['H'],
                    'esic_deduct'     => $value['I'],
                    'esic_no'         => $value['J'],
                    'uan_no'          => is($value['K'],'N/A'),
                    'dobadhr'         => date('Y-m-d',strtotime($value['AK'])),
                    'entity_name'     => $value['B'],
                    'branch'          => $value['L'],
                    'custid'          => $value['A'],
                    'dept'            => $value['M'],
                    'designation'     => $value['N'],
                    'location'        => !empty($value['AW'])?$value['AW']:'',
                    'join_date'       => date('Y-m-d',strtotime($value['AQ'])),
                    'exit_date'       => date('Y-m-d',strtotime($value['AS'])),
                    'member_date'     => $value['AR'],
                    'int_worker'      => $value['AT'],
                    'emp_status'      => $value['AM'],
                    'contractor_name' => !empty($value['AV'])?$value['AV']:'',
                    'vendor_id'       => !empty($value['AU'])?$value['AU']:''
                  );
                }
              }
                  $i++;
                }  
                // var_dump($inserdata);        
                 $this->newdb=$this->load->database('db1',TRUE);     
               if (!empty($inserdata)) {
                put_msg('save employee data successfully...!');
                 $this->load->model('Employee_model','emp');
                 $this->emp->save_employeesData($inserdata,$excelid);
                  
                 
               }
               elseif (!empty($inserErrorData)) {
                put_msg('some data has an error ..!');
                 $this->newdb->insert_batch('employee_error',$inserErrorData);
               }
             goto_back();

                          
 
          } catch (Exception $e) {
             unlink($inputFileName);
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
            }
          }else{
              echo $error['error'];
            }
  }
 

  

	public function CreateEmployee($page_data="")
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {		 	
			 $this->data['where'] = 'Employee';
			 $this->data['sub_menu'] = 'Registration';		
             $this->render('employee_register');
			
		 }
		 else
		 {
		 	$this->load->view('404');
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
	         	// echo "<pre>";
	         	// var_dump($this->fillup_employee());
	         
	         	if ($this->emp->create_Employee($this->fillup_employee())) {
	         		
	         		 put_msg("your Employee is registerd successfully..!!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	        }
	}

	/* get detail from employee form */
	public function fillup_employee($value='')
	{
		$save_employee = 
		array(
		'emp_name' 			=> $this->input->post('emp_name'), 
        'emp_id'        =>$this->input->post('emp_id'),
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
		'uan_no' 			=> $this->input->post('una_no'),
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

   /* start the missing uan number process */
   public function ShowMissingUan($page_data = '')
   {
    if (!empty($this->input->post('submit'))) 
    {
      $custid =!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;
      $spgid  =!empty($this->input->post('spgid'))?$this->input->post('spgid'):NULL;
      $location =!empty($this->input->post('location'))?$this->input->post('location'):NULL;
      //echo $spgid;

        if ($this->data['access'][$this->session->TYPE] == TRUE) 
        {
           
              $this->data['where'] = 'Employee';
              $this->data['sub_menu'] = 'Missing-uan';
             
              /* table data */
              $this->data['tableHeading'] = "Show Employee Details of Missing UAN Number";
            
              $this->data['tableTools'] = array(
                          0 =>array(
                            //'link'=> base_url(''.$page_data['user_type'].'/download/missinguan/'.$custid.''),
                            'link'=> base_url(''.$this->data['user_type'].'/download/missinguan/'.hash_id($custid).''),
                            'button' =>'Download in Excel',
                            'class'  =>'btn-success'
                              )
                        ); 

            // colomns name
            $this->data['tableCol'] = array("Entity Name","Entity Code","Employee Name","Employee Code","Gender","Marital Status","PF Deduction","Upper Limit","ESIC Deduction","Existing ESIC No."," Existing UAN No","Branch","Department","Designation","Father/Husband Name","Relation DOB","Relation Adhar No","Relation Name","Relation Age","Nomination 1","Nomination 2","Nomination 3","Nomination 4","Email","Phone","Permanent Address","Temporary Address","Pan No","Name as per Pan Card","Aadhar No","Name as per Adhar Card","Bank A/c No","IFSC Code","Bank Name","Bank Branch","DOB as per Adhar Card","Education Qualifications","Employee Status","Physically Handicap","Physically Handicap Category","Birth Date","Joining Date","Membership Date","Existing Date","International Worker","Vendor ID","Contractor Name","Location");    

            //data  
            $this->data['tableData']=$this->checkmissinguan($spgid,$custid,$location);//
            // $this->data['tableButtons']  = array();
        
            $this->render('export_table');
           }
           else
           {
             $this->load->view('404');
           }        
    }
    else
    {
        if ($this->data['access'][$this->session->TYPE] == TRUE) 
        {
           $this->load->model('Employee_model','emp');
            $this->load->library("pagination");
           
             $this->data['where'] = 'Employee';
             $this->data['sub_menu'] = 'Missing-uan';

             // All Company data
             $this->data['result1']=$this->emp->get_entitydetails();              
             // location data
             $this->data['result']=$this->emp->get_location();
             
             $this->data['companys']=$this->emp->get_companyies();

            
             $this->render('export_missing_uan');
           }
           else
           {
            $this->load->view('404');
           }
    }
   }

   /* Check missing uan no with validation */
   public function checkmissinguan($spgid,$custid,$location)
   {
    $this->load->model('Employee_model','emp');   
     
     if ($custid !== NULL && $spgid !== NULL) 
      {
        if ($location =="ALL") 
        {
          $result=$this->emp->get_missinguan($spgid,$custid,'ALL');
          return $result;
        }
        else
        {
          $result=$this->emp->get_missinguan($spgid,$custid,$location);
          return $result;
        } 
      }
      else
      {
        put_msg('Sorry custid and user are invalid');
          goto_back();
      }             
    }

    /* download esic Template report in excel formate*/
   public function DownloadMissingUan()
   {
    //echo "hello";
    $this->load->model('Export');
    $spg = user_id();
    $cust = verify_id($this->uri->segment(4));
   
    $this->Export->MissingUAN($spg,$cust);
   }




   


}