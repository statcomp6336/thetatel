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
}