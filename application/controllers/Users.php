<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Users {

	public function ShowUsers($page_data='')
	{
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Employee_model','emp');
      $this->load->library("pagination");

       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Users';
       $this->data['sub_menu'] = 'Details';
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
       // $this->data['result'] = $this->emp->get_allemployee();
       $config["base_url"] = base_url() .$page_data['user_type']."/employee/show";
        $config["total_rows"] = $this->emp->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
            $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
       

        $this->data["links"] = $this->pagination->create_links();

        $this->data['result'] = $this->emp->get_allemployee($config["per_page"], $page);

        
       $this->render('user_list');
       
     }
     else
     {
      echo "404 no access";
     }
	}

}