<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Dashboard {

	public function dashboard($page_data="")
	{
		$this->load->model('Dashboard_model','dash');
		 $type=$this->session->TYPE;
		switch ($type) {
			
			case '1':
				echo "1";
				break;
			case '2':
				echo "2";
				break;
			case '3':
				echo "3";
				break;
			case '4':
				echo "4";
				break;
			case '5':
				echo "5";
				break;
			case '55':
				echo "55";
				break;
			case '9':
			 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Home';
			 $this->data['sub_menu'] = 'Dashboard';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];

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
		$this->render('dashboard');		
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
		 	echo "404 no access";
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
		        	put("uploaded");
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




	/* Dashboar read more content views */
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
		 	echo "404 no access";
		 }
		
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
		 	echo "404 no access";
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
		 	echo "404 no access";
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
		 	echo "404 no access";
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
		 	echo "404 no access";
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
		 	echo "404 no access";
		 }
		
	}





}