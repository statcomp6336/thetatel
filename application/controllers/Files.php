<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Files {

	public function ShowExplore($page_data='')
	{
		 if ($page_data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Files_model','files');
      $this->load->library("pagination");
       $page=is($this->uri->segment(2),'N/A');
       $sub_menu='';
      if ($page=='explore') {
       $sub_menu="explore";       
      }

       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = is($sub_menu,'share-files');
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
       $this->data['page'] = $page;
       $this->data['start_year'] = 2019;
      
       $this->render('files');
     }
     else
     {
      echo "404 no access";
     }
	}
  // show companies in explore with year
  public function ShowCompaniesWithYear($page_data='')
  {
    if ($page_data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Files_model','files');
      $this->load->library("pagination");
       $year=is($this->uri->segment(4),NULL);
        $page=is($this->uri->segment(2),'N/A');
       $sub_menu='';
       $get='';
      if ($page=='explore') {
       $sub_menu="explore";
       $get = $this->files->get_companiesForExplore($year);       
      }
       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = is($sub_menu,'share-files').'-<strong>'.$year.'</strong>';
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
       $this->data['page'] = $page;
      ;
       $this->data['result'] = is($get,$this->files->get_companiesForSharing($year));

      
       $this->render('companies_explore');
     }
     else
     {
      echo "404 no access";
     }
  }
  // show Companies act releted files in explore with year
  public function ShowCompaniesActWithYear($page_data='')
  {
    if ($page_data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Files_model','files');
      $this->load->library("pagination");
      $year=is($this->uri->segment(4),NULL);
       $custid=is(verify_id($this->uri->segment(5)),NULL);
       $this->data['page_title'] = $page_data['page_title'];
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = 'Explore-<strong>'.$year.'</strong>';
       $this->data['user_type'] = $page_data['user_type'];
       $this->data['menu'] = $page_data['menu'];
      
      

       $this->data['result'] = $this->files->get_files($custid,$year);
      
       $this->render('explore_data');
     }
     else
     {
      echo "404 no access";
     }
  }

}