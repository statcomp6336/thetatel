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
			$this->data['total_notis'] = $this->dash->countOfNotis();

				
			
		}
		$this->render('dashboard');		
	}
	//message of users in inbox
	public function showInbox($page_data='')
	{
		if ($page_data['access'][$this->session->TYPE] == TRUE) {
		 	 $this->data['page_title'] = $page_data['page_title'];
			 $this->data['where'] = 'Message';
			 $this->data['sub_menu'] = 'Inbox';
			 $this->data['user_type'] = $page_data['user_type'];
			 $this->data['menu'] = $page_data['menu'];
			 $this->render('inbox');
		 }
		 else
		 {
		 	echo "404 no access";
		 }
	}
	
}