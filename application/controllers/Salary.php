<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Salary {

/* display upload or import salary sheet */
	public function ShowSalaryExcel($page_data='')
	{
		if ($this->data['access'][$this->session->TYPE] == TRUE) {
			    
		       $this->data['where'] = 'Employee';
		       $this->data['sub_menu'] = 'Salary';
		       $this->render('master_salary');
		     }
		     else
		     {
		       $this->load->view('404');
		     }
	}
	/* insert temprory data in database*/

	public function SaveSalary($page_data, $user,$process='')
	{
		if (empty($process)) {
			$this->newdb=$this->load->database('db1',TRUE);

			$this->load->model('Employee_model','emp');
    		$path = 'uploads/salary/';   
            require_once APPPATH . "/third_party/excel/Classes/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if (!$this->upload->do_upload('file')) {
            	put_msg($this->upload->display_errors());
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
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
                //   if ($this->emp->company_exist($value['A'])== FALSE) {
                //     unlink($inputFileName);
                //     put_msg("company is not register your not file uploaded");  
                //     goto_back();            
                //     exit();
                // }
            $e_code = $this->emp->is_uploaded_salary($value['A'],$value['C'],$value['AE'],$value['AF']);
                  if ($e_code == TRUE) {

                  $d[$i]=array(
                    'cust_id' 	=> $value['A'],
                    'cust_name' => $value['B'],
                    'emp_id' 	=> $value['C'],
                    'pf_no' 	=> $value['D'],
                    'esic_no' 	=> $value['E'],
                    'emp_name' 	=> $value['F'],
                    'month_days'=> $value['G'],
                    'paid_days' => $value['H'],
                    'fix_gross' => $value['I'],
                    'basic' 	=> $value['J'],
                    'dearness' 	=> $value['K'],
                    'hra'		=> $value['L'],
                    'ca' 		=> $value['M'],
                    'cca' 		=> $value['N'],
                    'ea' 		=> $value['O'],
                    'or' 		=> $value['P'],
                    'oa' 		=> $value['Q'],
                    'ot' 		=> $value['R'],
                    'wa' 		=> $value['S'],
                    'lta' 		=> $value['T'],
                    'monthly_gross' => $value['U'],
                    'pf' 		=> $value['V'],
                    'vpf' 		=> $value['W'],
                    'esic' 		=> $value['X'],
                    'pt' 		=> $value['Y'],
                    'it' 		=> $value['Z'],
                    'lwf' 		=> $value['AA'],
                    'od' 		=> $value['AB'],
                    'net_pay' 	=> $value['AC'],
                    'payment_mode' => $value['AD'],
                    'year' 		=> $value['AE'],
                    'month' 	=> $value['AF'],
                    'epf_wages' => $value['AG'],
                    'total_dud' => $value['AH'],
                    'is_uploaded'=> $e_code
                      );
                  $i++;
               
                 	$saveExcelData[$i] = array(
									'entity_name' 	=> is($value['B']), 
									'custid' 		=> is($value['A']), 
									'spgid' 		=> user_id(),//$this->input->post('')[$i], 
									'empid' 		=> is($value['C']), 
									'pfno' 			=> is($value['D']), 
									'esicno' 		=> is($value['E']), 
									'name' 			=> is($value['F']), 
									'Month_days' 	=> is($value['G']), 
									'paid_days' 	=> is($value['H']), 
									'fixgross' 		=> is($value['I']), 
									'basic' 		=> is($value['J']), 
									'DA' 			=> is($value['K']), 
									'HRA' 			=> is($value['L']), 
									'CA' 			=> is($value['M']), 
									'CCA' 			=> is($value['N']), 
									'EA' 			=> is($value['O']), 
									'Other_reimb' 	=> is($value['P']), 
									'OA' 			=> is($value['Q']), 
									'OT' 			=> is($value['R']), 
									'WA' 			=> is($value['S']), 
									'LTA' 			=> is($value['T']), 
									'monthly_gross' => is($value['U']), 
									'PF' 			=> is($value['V']), 
									'VPF' 			=> is($value['W']), 
									'ESIC' 			=> is($value['X']), 
									'PT' 			=> is($value['Y']), 
									'IT' 			=> is($value['Z']), 
									'LWF' 			=> is($value['AA']), 
									'OD' 			=> is($value['AB']), 
									'net_pay' 		=> is($value['AC']), 
									'paymentmode' 	=> is( $value['AD']), 
									'year' 			=> $value['AE'],//$this->input->post('year', 
									'month' 		=> $value['AF'],//
									'epf_wages' 	=> $value['AG'],//
									'total_deduction'=> $value['AH'],//
									
									
								); 
				 } 
				 if (!empty($saveExcelData)) {
				 
				 $this->newdb->insert_batch('temp_salary_master',$saveExcelData);
				 }
				  
				}
							
                
		       $this->data['where'] = 'Employee';
		       $this->data['sub_menu'] = 'Salary';
		      
                 $this->data['result'] =$this->newdb->get('temp_salary_master')->result();

               $this->render('edit_salary');           
 
          } catch (Exception $e) {
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
            }
          }else{
              echo $error['error'];
            }
		}
		elseif (!empty($process) && $process == 'U') {
			# code...
		}
	}


	public function SaveExcelSalary($user)
	{
		$this->load->model('Employee_model','emp');
		$count=sizeof($this->input->post('cust_id'));
		$saveExcelData=[];
		echo $count;
		echo "<br>";
		for ($i=0; $i < $count; $i++) {
		// echo "<pre>";
		// echo $i;
		 	// var_dump($this->input->post('cust_name')[$i]);
		 	// exit();
		

			if ($this->input->post('is_uploaded')[$i] == TRUE) {
				$editExcelData[$i] = array(
									'entity_name' 	=> $this->input->post('cust_name')[$i], 
									'custid' 		=> $this->input->post('cust_id')[$i], 
									'spgid' 		=> user_id(),//$this->input->post('')[$i], 
									'empid' 		=> $this->input->post('emp_id')[$i], 
									'pfno' 			=> $this->input->post('pf_no')[$i], 
									'esicno' 		=> $this->input->post('esic_no')[$i], 
									'name' 			=> $this->input->post('emp_name')[$i], 
									'Month_days' 	=> $this->input->post('month_days')[$i], 
									'paid_days' 	=> $this->input->post('paid_days')[$i], 
									'fixgross' 		=> $this->input->post('fix_gross')[$i], 
									'basic' 		=> $this->input->post('basic')[$i], 
									'DA' 			=> $this->input->post('dearness')[$i], 
									'HRA' 			=> $this->input->post('hra')[$i], 
									'CA' 			=> $this->input->post('ca')[$i], 
									'CCA' 			=> $this->input->post('cca')[$i], 
									'EA' 			=> $this->input->post('ea')[$i], 
									'Other_reimb' 	=> $this->input->post('or')[$i], 
									'OA' 			=> $this->input->post('oa')[$i], 
									'OT' 			=> $this->input->post('ot')[$i], 
									'WA' 			=> $this->input->post('wa')[$i], 
									'LTA' 			=> $this->input->post('lta')[$i], 
									'monthly_gross' => $this->input->post('monthly_gross')[$i], 
									'PF' 			=> $this->input->post('pf')[$i], 
									'VPF' 			=> $this->input->post('vpf')[$i], 
									'ESIC' 			=> $this->input->post('esic')[$i], 
									'PT' 			=> $this->input->post('pt')[$i], 
									'IT' 			=> $this->input->post('it')[$i], 
									'LWF' 			=> $this->input->post('lwf')[$i], 
									'OD' 			=> $this->input->post('od')[$i], 
									'net_pay' 		=> $this->input->post('net_pay')[$i], 
									'paymentmode' 	=> $this->input->post('payment_mode')[$i], 
									'year' 			=> $this->input->post('year')[$i], 
									'month' 		=> $this->input->post('month')[$i], 
									'epf_wages' 	=> $this->input->post('epf_wages')[$i], 
									'total_deduction'=> $this->input->post('total_dud')[$i]
									
								);
			}
			else
			{
				 
			            // if (!isset($this->input->post()[$i])){
			            //     $this->input->post()[$i] = '';
			            //     } 
				// echo $this->input->post('epf_wages')[$i];
				// exit();
			       
				$saveExcelData	 = array(
									'entity_name' 	=> is($this->input->post('cust_name')[$i]), 
									'custid' 		=> is($this->input->post('cust_id')[$i]), 
									'spgid' 		=> user_id(),//$this->input->post('')[$i], 
									'empid' 		=> is($this->input->post('emp_id')[$i]), 
									'pfno' 			=> is($this->input->post('pf_no')[$i]), 
									'esicno' 		=> is($this->input->post('esic_no')[$i]), 
									'name' 			=> is($this->input->post('emp_name')[$i]), 
									'Month_days' 	=> is($this->input->post('month_days')[$i]), 
									'paid_days' 	=> is($this->input->post('paid_days')[$i]), 
									'fixgross' 		=> is($this->input->post('fix_gross')[$i]), 
									'basic' 		=> is($this->input->post('basic')[$i]), 
									'DA' 			=> is($this->input->post('dearness')[$i]), 
									'HRA' 			=> is($this->input->post('hra')[$i]), 
									'CA' 			=> is($this->input->post('ca')[$i]), 
									'CCA' 			=> is($this->input->post('cca')[$i]), 
									'EA' 			=> is($this->input->post('ea')[$i]), 
									'Other_reimb' 	=> is($this->input->post('or')[$i]), 
									'OA' 			=> is($this->input->post('oa')[$i]), 
									'OT' 			=> is($this->input->post('ot')[$i]), 
									'WA' 			=> is($this->input->post('wa')[$i]), 
									'LTA' 			=> is($this->input->post('lta')[$i]), 
									'monthly_gross' => is($this->input->post('monthly_gross')[$i]), 
									'PF' 			=> is($this->input->post('pf')[$i]), 
									'VPF' 			=> is($this->input->post('vpf')[$i]), 
									'ESIC' 			=> is($this->input->post('esic')[$i]), 
									'PT' 			=> is($this->input->post('pt')[$i]), 
									'IT' 			=> is($this->input->post('it')[$i]), 
									'LWF' 			=> is($this->input->post('lwf')[$i]), 
									'OD' 			=> is($this->input->post('od')[$i]), 
									'net_pay' 		=> $this->input->post('net_pay')[$i], 
									'paymentmode' 	=> $this->input->post('payment_mode')[$i], 
									'year' 			=> $this->input->post('year')[$i], 
									'month' 		=> $this->input->post('month')[$i], 
									'epf_wages' 	=> $this->input->post('epf_wages')[$i], 
									'total_deduction'=> $this->input->post('total_dud')[$i]
									
								);
				// var_dump($saveExcelData);
				// exit();
				$this->emp->create_Salary($saveExcelData);
			}

		}
		// echo "<pre>";
		// var_dump(is($saveExcelData));
		// var_dump(is($editExcelData));
	}
}