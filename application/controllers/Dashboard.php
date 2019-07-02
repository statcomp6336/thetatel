<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Dashboard {

	public function dashboard($page_data="")
	{
		$this->load->model('Dashboard_model','dash');
		if ($this->data['access'][$this->session->TYPE] == TRUE) {			 
			$this->data['where'] = 'Home';
			$this->data['sub_menu'] = 'Dashboard';
			if ($this->is_spg()== TRUE) {
				$this->data['total_scope'] = $this->dash->countOfScope();
				$this->data['total_bulk_update'] = $this->dash->countOfBultUpdate();
				$this->data['total_complience'] = $this->dash->countOfComplience();
				$this->data['total_non_complience'] = $this->dash->countOfNonComplience();
				$this->data['total_pending'] = $this->dash->countOfPending();
				$this->data['total_compl'] = $this->dash->countOfcomplatence();
				$this->data['total_alerts'] = $this->dash->countOfAlert();
				$this->data['total_approves'] = $this->dash->countOfMyApprovals();
				$this->data['total_notis'] = $this->dash->countOfNewMail();		
			}
			elseif ($this->is_company()== TRUE) {
				$this->data['total_scope'] = $this->dash->countOfScope();
				$this->data['total_bulk_update'] = $this->dash->countOfBultUpdate();
				$this->data['total_complience'] = $this->dash->countOfComplience();
				$this->data['total_non_complience'] = $this->dash->countOfNonComplience();
			}
			elseif ($this->is_spg_user()== TRUE) {
				$this->data['total_scope'] = $this->dash->countOfScope();
				$this->data['total_bulk_update'] = $this->dash->countOfBultUpdate();
				$this->data['total_complience'] = $this->dash->countOfComplience();
				$this->data['total_non_complience'] = $this->dash->countOfNonComplience();
			}			 
			
		
		$this->render('dashboard');	
		}	
		else
		 {
		 	$this->load->view('404');
		 }
	}
	//message of users in inbox
	public function showInbox($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		if ($page_data['access'][$this->session->TYPE] == TRUE) {

		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Message';
			 $this->data['sub_menu'] = 'Inbox';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['inbox'] = $this->dash->get_allMail();
			 $this->data['sendMail'] = $this->dash->get_allSendMail();
			 $this->render('inbox');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
	}

	public function SendMail($user='')
	{
		$this->load->model('Dashboard_model','dash');
		$extract="";
		if (!empty($this->input->post('submit'))) {

			$this->form_validation->set_rules('cust_name','Company Name','trim|required|xss_clean');
			$this->form_validation->set_rules('email','Email','trim|required|xss_clean');
			$this->form_validation->set_rules('subject','Subject','trim|required|xss_clean');
			$this->form_validation->set_rules('message','Message','required');    

		    if($this->form_validation->run() == false)
		    {
		    	 put_msg(validation_errors());

		        goto_back();
		    }
		    else
		    {
		    	$path = 'mail_attachments/'; 
				$config['upload_path'] = $path;
		        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xlsx|xls|docs';
		        $config['remove_spaces'] = TRUE;
		        $this->load->library('upload', $config);

		        if (!$this->upload->do_upload('attachment')) {
		        	put_msg("not upload ");
		                $error = array('error' => $this->upload->display_errors());
		        }
		        else {
		        	put_msg("uploaded");
		                $data = array('upload_data' => $this->upload->data());
		        }
		        if(empty($error)){
		          if (!empty($data['upload_data']['file_name'])) {
		            $import_xls_file = $data['upload_data']['file_name'];
		        } else {
		            $import_xls_file = 0;
		            goto_back();
		            exit;
		        }
		        $inputFileName = $path . $import_xls_file; 


		       
				$saveMail=array(
						'sender_id'=>user_id(),
						'custid' => is($this->input->post('custid'),'N/A'),
						'entity_name' =>is($this->input->post('cust_name'),'N/A'),
						'email' =>is($this->input->post('email'),'N/A'),
						'subject' => is($this->input->post('subject'),'N/A'),
						'message' => is($this->input->post('message'),'N/A'),
						'attachment' =>  $inputFileName,
						'mail_status' =>1
						);

				// var_dump($saveMail);
				$extract= $this->dash->save_mail($saveMail);
				put_msg('mail send successfully');
				goto_back();
			}		
		}
	}
		else{
			put_msg('form submition failed');
			goto_back();
		}
	}




	/* Dashboar read more content viewss */
	//Total Scope
	public function ShowTotalScope($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_totalScope(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Total-Scope';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_totalScope');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}

	/* download Totalscope report in excel formate*/
	 public function DownloadTotalScope()
	 {
	 	$this->load->model('Export');
	 	$spg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 	$cust = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	 	
	 	$this->Export->TotalScope($spg,$cust);			
		
	 }

	//Current Scope
	public function ShowDashCurrentScope($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_CurrentScope(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Current-scope';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_currentScope');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}

	//Compliance Done
	public function ShowDashComplianceDone($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_complianceDone(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Compliance-Done';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_compliance_done');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}
	//Non Compliance dashbooard
	public function ShowDashNonCompliance($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_NonCompliance(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Non-Compliance';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_nonCompliance');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}

	//Pending Compliance
	public function ShowDashPendingCompliance($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_pendingCompliance(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Pending-Compliance';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_pendingCompliance');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}
 
	//Alert Compliance
	public function ShowDashAlertCompliance($page_data='')
	{
		$this->load->model('Dashboard_model','dash');
		$result="";
		if (!empty($this->input->post('submit'))) {

			$result=$this->dash->get_AlertCompliance(is($this->input->post('custid'),'N/A'),is($this->input->post('act_code'),'N/A'));
		}

		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Dashboard';
			 $this->data['sub_menu'] = 'Alert-Compliance';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->data['result'] = $result;
			
			 $this->data['company'] = $this->dash->get_DashSompanyes();
			
			 $this->render('dash_alertCompliance');
		 }
		 else
		 {
		 	$this->load->view('404');
		 }
		
	}





}