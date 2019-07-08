<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Act {

	/* show display create act form */
	public function CreateActs($page_data='')
	{
		$this->load->model('Act_model');
		 if ($this->data['access'][$this->session->TYPE] == TRUE) {
		 
			 $this->data['where'] = 'Acts';
			 $this->data['sub_menu'] = 'Create'; 

			 // act detatails data
			  $this->data['act_data']=array('act_code'=> $this->Act_model->get_act_code(),
			  								'data'    => $this->Act_model->get_actss()
											);
			 $this->render('create_act');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }				
		
	}
	public function fillup_acts()
	{ 
		$this->load->model('Act_model','acts');
		if (!empty($this->input->post('acts'))) {
			$save_acts = array('act_code' 	=> $this->input->post('act_code'),
								'act' 		=> $this->input->post('act_name'),
								'shortname' => $this->input->post('shortname'),
								'act_type' 	=> $this->input->post('act_type') );			
		}
		elseif (!empty($this->input->post('sub_acts'))) {
			
			$save_acts = array('act_code' 	=> $this->input->post('act_code'),
								'act' 		=> $this->acts->set_acts($this->input->post('act_code'))->act,
								'shortname' => $this->acts->set_acts($this->input->post('act_code'))->shortname,
								'act_type' 	=> $this->acts->set_acts($this->input->post('act_code'))->act_type,
								'pcr_code' 	=> $this->input->post('pcr_code'),
								'Particular'=> $this->input->post('particular'),
								'freq' 		=> $this->input->post('freq'),
								'weight' 	=> $this->input->post('weight'),
								'obligation'=> $this->input->post('obligation'),
								'due_date' 	=> $this->input->post('due_date'),
								'stat_date' => $this->input->post('stat_date')
								 );

		}
		
		
		return $this->security->xss_clean($save_acts);
	}
	public function act_rules()
	{
		$main_act_rules = array(
				               array(
				                     'field'   => 'act_code', 
				                     'label'   => 'Act Code', 
				                     'rules'   => 'required'
				                  ),
				               array(
				                     'field'   => 'act_name', 
				                     'label'   => 'Act Name', 
				                     'rules'   => 'required'
				                  ),
				                array(
				                     'field'   => 'shortname', 
				                     'label'   => 'Short Name', 
				                     'rules'   => 'required'
				                  ),
				                 array(
				                     'field'   => 'act_type', 
				                     'label'   => 'Act TYPE', 
				                     'rules'   => 'required'
				                  )
				           );
		return $main_act_rules;
	}
	public function sub_act_rules()
	{
		$main_act_rules = array(
				               array(
				                     'field'   => 'pcr_code', 
				                     'label'   => 'Sub Act Code', 
				                     'rules'   => 'required'
				                  ),
				               array(
				                     'field'   => 'act_code', 
				                     'label'   => 'Act Name', 
				                     'rules'   => 'required'
				                  ),
				                array(
				                     'field'   => 'weight', 
				                     'label'   => 'Weight', 
				                     'rules'   => 'required'
				                  ),
				                 array(
				                     'field'   => 'obligation', 
				                     'label'   => 'Obligation', 
				                     'rules'   => 'required'
				                  ),
				                 array(
				                     'field'   => 'freq', 
				                     'label'   => 'Frequency', 
				                     'rules'   => 'required'
				                  ),
				                 array(
				                     'field'   => 'due_date', 
				                     'label'   => 'Due Date', 
				                     'rules'   => 'required'
				                  ),
				                  array(
				                     'field'   => 'stat_date', 
				                     'label'   => 'Statutary  Date', 
				                     'rules'   => 'required'
				                  )
				           );
		return $main_act_rules;
	}

	/* insert acts in database */
	public function SaveActs($user)
	{
		$this->load->model('Act_model');
		$ruls=!empty($this->input->post('acts'))?$this->act_rules():$this->sub_act_rules();
		$this->form_validation->set_rules($ruls);
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/act/create'));   
	        } 
	        else
	        {         
	         
	         	if ($this->Act_model->Create_act($this->fillup_acts())) {
	         		
	         		 put_msg("your Act is registerd successfully..!!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	        }
		
	}
	/* delect acto to database */
	public function RemoveActs($value='')
	{
		$this->load->model('Act_model');
	}
	/* update acts to database */
	public function EditActs($value='')
	{
		$this->load->model('Act_model');
	}

	/*  process of sub act creation with CRUD OPERATION*/
	
	public function get_sub_act_id($value='')
	{
		$this->load->model('Act_model');

		$e=$this->Act_model->get_pcr_code($this->input->post('act_code'));
			echo $e;
	}

	/* insert acts in database */
	public function SaveSubActs($user)
	{
		$this->load->model('Act_model');
		
		$this->form_validation->set_rules($this->sub_act_rules());
		 if ($this->form_validation->run() == FALSE) { 
	         	// echo validation_errors();
	         	 put_msg(validation_errors());
	         	redirect(base_url( $user.'/act/create'));   
	        } 
	        else
	        {
	         	var_dump($this->fillup_acts());
	         
	         	if ($this->Act_model->Create_SubAct($this->fillup_acts())) {
	         		
	         		 put_msg("your Act is registerd successfully..!!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	         	else
	         	{
	         		put_msg("somthing went wronge...!");
	         		 redirect(base_url( $user.'/act/create'));
	         	}
	        }
		
	}
	/* delect acto to database */
	public function RemoveSubActs($value='')
	{
		$this->load->model('Act_model');
	}
	/* update acts to database */
	public function EditSubActs($value='')
	{
		$this->load->model('Act_model');
	}




	/* work with Compilence */
	//display view bulk update
	public function ShowBulkUpdate($page_data='')
	{
		if (!empty($this->input->post('submit'))) {
			
			$this->bulk_update($page_data);
		}else{
		$this->load->model('Act_model');
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Compilance';
			 $this->data['sub_menu'] = 'Bulk-Update';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];

			 // act detatails data
			  $this->data['act_data']=array('act_code'=> $this->Act_model->get_act_code(),
			  								'data'    => $this->Act_model->get_actss()
											);
			 $this->render('bulk_update');
		 }
		 else
		 {
		 	echo "404 no access";
		 }
		 }	
	}
	//display view bulk compilence
	public function ShowBulkCompliance($page_data='')
	{
		$this->load->model('Act_model','act');
		$extract="";
		if (!empty($this->input->post('submit'))) {
			$custid = $this->input->post('custid');
			$act_type =$this->input->post('act_type');
			$month = $this->input->post('month');
			$extract = $this->act->bulk_compliance($custid,$act_type,$month);

			$extract = !empty($extract)?$extract:"N/A";
		}
		else{
			$extract=NULL;
		}
		
			
			 if ($this->data['access'][$this->session->TYPE] == TRUE) {
			 	 //$this->data['page_title'] = $page_data['page_title'];
				 $this->data['where'] = 'Compilance';
				 $this->data['sub_menu'] = 'Bulk-Compliance';
				 //$this->data['user_type'] = $page_data['user_type'];
				 //$this->data['menu'] = $page_data['menu'];

				 // act detatails data
				  $this->data['bulk_data']=array('companys'=> $this->act->get_compActs(user_id()),
				  								'data'    => $extract
												);
				 $this->render('bulk_compliance');
			 }
			 else
			 {
			 	$this->load->view('404');
			 }
		
	}
	private function bulk_update($page_data='')
	{
		$custid =!empty($this->input->post('custid'))?$this->input->post('custid'):NULL;		
 		if ($page_data['access'][$this->session->TYPE] == TRUE) {
 			$this->load->model('Act_model','act');
            $this->data['page_title'] = $page_data['page_title'];
              $this->data['where'] = 'Compilance';
              $this->data['sub_menu'] = 'Bulk-Update';
              $this->data['user_type'] = $page_data['user_type'];
              $this->data['menu'] = $page_data['menu'];
              /* table data */	
              // Table header name
          $this->data['tableHeading'] = "Show Company compliance "; 
          // tools data
          $this->data['tableTools'] = array(
                          0 =>array(
                            'link'=> base_url(''.$page_data['user_type'].'/download/pf/'.$custid.''),
                            'button' =>'Download in Excel',
                            'class'  =>'btn-success'
                              ),
                          1 =>array(
                            'link'=> base_url(''.$page_data['user_type'].'/compliance/bulk-update'),
                            'button' =>'Bulk-Update',
                            'class'  =>'btn-warning'
                              )
                        );  
          // colomns name
          $this->data['tableCol'] = array("Cust ID",	"Customer Name",	"Act Code",	"Act Name",	"Particulars",	"Act Type",	"Frequency","Due Date",	"Statutary Due Date",	"Action");
          //data  
          $this->data['tableData']=$this->act->get_bulk($custid);//
         
          // $this->data['tableButtons']  = array(
          //                       0 =>array(                                      
          //                                 'function'  =>'compliance/update',
          //                                 'action' =>'edit',
          //                                 'para'  =>'custid,act_code',
          //                               ),
          //                       1 =>array(
          //                             'function'  =>'compliance/remove',
          //                             'action' =>'remove',
          //                             'para'  =>'custid,act_code',

          //                               )
          //                      );
        
         return $this->render('export_table');
           }
           else
           {
            echo "404 no access";
           }
      
      
	}
	//display view bulk approval
	public function ShowBulkApproval($page_data='')
	{
		$this->load->model('Act_model','act');
		$extract="";
		if (!empty($this->input->post('submit'))) {
			$custid = $this->input->post('custid');
			$act_type =$this->input->post('act_type');
			$act = $this->input->post('act');
			$extract = $this->act->bulk_approval($custid,$act,$act_type);

			$extract = !empty($extract)?$extract:"N/A";
			// var_dump($extract);exit();
		}
		else{
			$extract=NULL;
		}			
			 if ($page_data['access'][$this->session->TYPE] == TRUE) {
			 	 $this->data['page_title'] = $page_data['page_title'];
				 $this->data['where'] = 'Compilance';
				 $this->data['sub_menu'] = 'Bulk-Approval';
				 $this->data['user_type'] = $page_data['user_type'];
				 $this->data['menu'] = $page_data['menu'];

				 // act detatails data
				  $this->data['bulk_data']=array('acts'=> $this->act->get_actss(),
				  								'data'    => $extract
												);
				 $this->render('my_approval');
			 }
			 else
			 {
			 	echo "404 no access";
			 }
	}
	//display view bulk timeline
	public function ShowBulkTimeline($page_data='')
	{
		$this->load->model('Act_model');
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Compilance';
			 $this->data['sub_menu'] = 'Bulk-Timeline';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];

			 // act detatails data
			  $this->data['companies']=$this->Act_model->get_companies();
			 $this->render('bulk_timeline');
		 }
		 else
		 {
		 	echo "404 no access";
		 }
	}
	//display view bulk timeline
	public function ShowTimeline($page_data='')
	{
		$this->load->model('Act_model');
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Compilance';
			 $this->data['sub_menu'] = 'Bulk-Timeline';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];

			$custid=is(verify_id($this->uri->segment(4)),'N/A');	
			// echo $custid;		 
			  $this->data['result']=$this->Act_model->get_timelineData($custid);
			 $this->render('timeline');
		 }
		 else
		 {
		 	echo "404 no access";
		 }
	}
	/* update bulk compilence */
	public function UpdateBulkCompliance($user)
	{
		if (!empty($this->input->post('srno'))) {
			$this->load->model('Act_model','act');
			$count=sizeof($this->input->post('srno'));
			for ($i=0; $i < $count; $i++) {				
	      		
	      		if (!empty($this->input->post('remark')[$i]) && !empty($this->input->post('statusforpending')[$i]))
	      		{
	      			
	      			$status=$this->input->post('statusforpending')[$i];
      				if ($status == 'cust' ) {
      					$sts=1;
      				}
      				elseif ($status == 'spg') {
      					$sts=2;
      				}
      				elseif ($status == 'approval') {
      					$sts=3;
      				}	      			
	      			$task_date=date('Y-m-d');
	      			if (empty($this->input->post('compliance_form')[$i]) && empty($this->input->post('registration_form')[$i])) {
	      				$editComplience = array(
				      		 	  'Remarks' 		=> $this->input->post('remark')[$i],
				                  'status' 			=> $sts,                 
				                  'Task_complitn_date' => $task_date,                 
	                      
	                     );      				

	      			}
	      			elseif (!empty($this->input->post('compliance_form')[$i])) {
	      				$editComplience = array(
 	'Remarks' 				=> $this->input->post('remark')[$i],
	'status' 				=> $sts,                 
	'Task_complitn_date' 	=> $task_date,
	'Retrn_Challan_genrtn_date' => is($this->input->post('Challan_genrtn_date')[$i],'0000-00-00'),
	'Submisn_Pay_date' 		=> is($this->input->post('Pay_date')[$i],'0000-00-00'),
	'Pend_docu_in_nos' 		=> $this->input->post('Pend_doc_no')[$i]
	                      
	                     );

	      			}
	      			elseif (!empty($this->input->post('registration_form')[$i])) {

	      				$editComplience = array(
 	'Remarks' 				=> $this->input->post('remark')[$i],
    'status' 				=> $sts,                 
    'Task_complitn_date' 	=> $task_date,
    'registration_no' 		=> $this->input->post('registration_no')[$i],
    'Application_date' 		=> is($this->input->post('Application_date')[$i],'0000-00-00'),
    'Applicable_date' 		=> is($this->input->post('Applicable_date')[$i],'0000-00-00'),
    'Valid_upto' 			=> is($this->input->post('Valid_upto')[$i],'0000-00-00'),
    'Renewal_date' 			=> is($this->input->post('Renewal_date')[$i],'0000-00-00')                      
	                     );

	      			}


	      			$saveFlowOfWork= array(
	      								'row_id'=> $this->input->post('srno')[$i],
	      								'custid'=> $this->input->post('custid'),
	      								'spgid'=> user_id(),
	      								'spg_name'=>"admin",//user_name(),
	      								'comment'=>$this->input->post('remark')[$i],
	      								'action' =>$sts
	      							);
	      			//      		 	  	
      		 	  // var_dump($editComplience);
	      			$this->act->saveFlowOfWork($saveFlowOfWork);
      		 	  if($this->act->edit_bulkComplince($editComplience,$this->input->post('srno')[$i]))
      		 	  {
      		 	  	$return=TRUE;
      		 	  }

	      		} 
				
			}
			if ($return == TRUE) {
				put_msg('Data Save successfully..!');

				$this->load->model('Act_model','timeline');

				$custid= $this->input->post('custid');			
				$url   = $user.'/compliance/bulk-compliance';
				$this->timeline->update_timeline($custid,array('IS_Compliation'=>1));
				redirect(base_url(''.$user.'/compliance/bulk-compliance/comment/'.hash_id($custid).'/4/'.hash_id($url)));
			}
		}
	}


	/* update bulk approval  */
	public function UpdateBulkApproval($user)
	{
		if (!empty($this->input->post('srno'))) {
			$this->load->model('Act_model','act');
			$countsr=sizeof($this->input->post('srno'));
			$rejected_count=0;
			$count=0;
			for ($i=0; $i < $countsr; $i++) {				
	      		
	      		if (!empty($this->input->post('comment')[$i]) && !empty($this->input->post('compliancestatus')[$i]))
	      		{
	      			
	      			$status=$this->input->post('compliancestatus')[$i];
      				if ($status == 'approval' ) {
      					$sts=5;      					
      				}
      				elseif ($status == 'rejection') {
      					$sts=4;
      					
      					$count++;
      				}
      				$editComplience = array('status'=> $sts); 	      				


	      			$saveFlowOfWork= array(
	      								'row_id'=> $this->input->post('srno')[$i],
	      								'custid'=> $this->input->post('custid'),
	      								'spgid'=> user_id(),
	      								'spg_name'=>"admin",//user_name(),
	      								'comment'=>$this->input->post('comment')[$i],
	      								'action' =>$sts
	      							);
	      			//      		 	  	
      		 	  // var_dump($editComplience);
	      			$this->act->saveFlowOfWork($saveFlowOfWork);
      		 	  if($this->act->edit_bulkComplince($editComplience,$this->input->post('srno')[$i]))
      		 	  {
      		 	  	$return=TRUE;
      		 	  }

	      		} 
				
			}
			if ($return == TRUE) {
				put_msg('Data Save successfully..!');
				$this->load->model('Act_model','timeline');

					$custid= $this->input->post('custid');			
					$url   = $user.'/compliance/bulk-approval';
					if ($count>1) {
						$IS_Approve=2;
						$IS_Compliation=3;
						$IS_Complete=0;
					}
					else
					{
						$IS_Approve=1;
						$IS_Compliation=1;
						$IS_Complete=1;
					}

				if($this->act->complete_compliance())
				{					
					$this->timeline->update_timeline($custid,array('IS_Approve'=>$IS_Approve,'IS_Compliation'=>$IS_Compliation,'IS_Complete'=>$IS_Complete));
					redirect(base_url(''.$user.'/compliance/bulk-approval/comment/'.hash_id($custid).'/5/'.hash_id($url)));
				}
				

			}
		}
	}


}