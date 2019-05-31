<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Salary {

	public function ShowSalaryExcel($page_data='')
	{
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
			    // $this->load->model('Employee_model','emp');
			    // $this->load->library("pagination");

		       $this->data['page_title'] = $page_data['page_title'];
		       $this->data['where'] = 'Employee';
		       $this->data['sub_menu'] = 'Salary';
		       $this->data['user_type'] = $page_data['user_type'];
		       $this->data['menu'] = $page_data['menu'];
		       // $this->data['result'] = $this->emp->get_allemployee();
		       

		        
		       $this->render('master_salary');
		     }
		     else
		     {
		      echo "404 no access";
		     }
	}

	public function SaveSalary($page_data, $user,$process='')
	{
		if (empty($process)) {

			$this->load->model('Employee_model','emp');
    		$path = 'uploads/';   
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
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
            $e_code = $this->emp->is_uploaded_salary($value['A'],$value['C'],$value['AE'],$value['AF']);
                  // if ($e_code == "N/A") {
                  //   put_msg($value['C']."employee id is not uniq ");
                  //  // goto_back();
                  //  exit();
                  //   # code...
                  // }

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
                }               
                // $result = $this->import->importdata($inserdata);   
                // if($result){
                //   echo "Imported successfully";
                // }else{
                //   echo "ERROR !";

                // } 
                $this->data['page_title'] = $page_data['page_title'];
		       $this->data['where'] = 'Employee';
		       $this->data['sub_menu'] = 'Salary';
		       $this->data['user_type'] = $page_data['user_type'];
		       $this->data['menu'] = $page_data['menu'];
                 $this->data['result'] =$d;

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
		for ($i=0; $i < $count; $i++) { 

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
				$saveExcelData = array(
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
									'year' 			=> 2019,//$this->input->post('year')[$i], 
									'month' 		=> 'May',//$this->input->post('month')[$i], 
									'epf_wages' 	=> 1,//$this->input->post('epf_wages')[$i], 
									'total_deduction'=> 1,//$this->input->post('total_dud')[$i]
									
								);
				$this->emp->create_Salary($saveExcelData);
			}

		}
		// var_dump($saveExcelData);
		// var_dump($editExcelData);
	}
}