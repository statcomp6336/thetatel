<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Files {

	public function ShowExplore($page_data='')
	{
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Employee_model','emp');
      $this->load->library("pagination");

       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = 'Explore';
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
       // $this->data['result'] = $this->emp->get_allemployee();
      
       $this->render('files');
     }
     else
     {
      echo "404 no access";
     }
	}

}