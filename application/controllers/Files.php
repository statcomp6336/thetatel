<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Files {

	public function ShowExplore($page_data='')
	{
		 if ($this->data['access'][$this->session->TYPE] == TRUE && (IS_SPG== TRUE || IS_SPGUSER == TRUE || IS_COMPANY== TRUE)) {
      $this->load->model('Files_model','files');
      $this->load->library("pagination");
       $page=is($this->uri->segment(2),'N/A');
       $sub_menu='';
      if ($page=='explore') {
       $sub_menu="explore";       
      }

       
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = is($sub_menu,'share-files');
       
       $this->data['page'] = $page;
       $this->data['start_year'] = 2019;
      
       $this->render('files');
     }
     else
     {
     $this->load->view('404');
     }
	}
  // show companies in explore with year
  public function ShowCompaniesWithYear($page_data='')
  {
    if ($this->data['access'][$this->session->TYPE] == TRUE && (IS_SPG== TRUE || IS_SPGUSER == TRUE || IS_COMPANY== TRUE) ) {
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
      
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = is($sub_menu,'share-files').'-<strong>'.$year.'</strong>';
      
       $this->data['page'] = $page;
      ;
       $this->data['result'] = is($get,$this->files->get_companiesForSharing($year));

     
       $this->render('companies_explore');
     }
     else
     {
      $this->load->view('404');
     }
  }
  // show Companies act releted files in explore with year
  public function ShowCompaniesActWithYear($page_data='')
  {
    if ($this->data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('Files_model','files');
      $this->load->library("pagination");
      $year=is($this->uri->segment(4),NULL);
       $custid=is(verify_id($this->uri->segment(5)),NULL);      
       $this->data['where'] = 'Files';
       $this->data['sub_menu'] = 'Explore-<strong>'.$year.'</strong>';
       $this->data['year'] = $year;
       $this->data['custid'] = $custid;
        $page=is($this->uri->segment(2),'N/A');
       $this->data['page'] = $page;
      
      
      
     
       $this->data['result'] = $this->files->get_files($custid,$year,$page);
      
       $this->render('explore_data');
     }
     else
     {
      $this->load->view('404');
     }
  }
  public function upload_companyDocs($user='')
  {
     $path = 'files'; 
    $this->load->model('Files_model','files');
    $cust_name=$this->files->get_company_name($this->input->post('custid'))->entity_name;
   
   $dir_name=$path.'/'.str_replace(' ', '_', $cust_name);
   if (!file_exists($dir_name)) {
    mkdir($dir_name, 0777, true);    
    }

   $filesCount = count($_FILES['files']['name']);
    $counts=0;
     $savefile=[];
      for($i = 0; $i < $filesCount; $i++)
      {
        $counts++;
        $_FILES['file']['name']     = $_FILES['files']['name'][$i];
        $_FILES['file']['type']     = $_FILES['files']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
        $_FILES['file']['error']     = $_FILES['files']['error'][$i];
        $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
     
        
        $config['upload_path'] = $dir_name;
        $config['allowed_types'] = 'xlsx|xls|jpg|jpeg|pdf|docs|png';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config); 

        if (!$this->upload->do_upload('file')) 
        {
          put_msg($this->upload->display_errors());
            $error = array('error' => $this->upload->display_errors());
          redirect(base_url(''.$user.'/share-files/companies/'.$this->input->post('year').'/'.hash_id($this->input->post('custid')).''));
            exit();
        } 
        else 
        {
            $fileData = $this->upload->data();
            $data = array('upload_data' => $this->upload->data());
            $uploadData[$i]['file_name'] = $fileData['file_name'];
            $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
        }
        if(empty($error))
        {
          if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
                 redirect(base_url(''.$user.'/share-files/companies/'.$this->input->post('year').'/'.hash_id($this->input->post('custid')).''));
                exit();
            }
            $inputFileName = $dir_name.'/'. $import_xls_file;
            $savefile[$counts]=array('custid'=> $this->input->post('custid'),
                            'entity_name' => $cust_name,
                            'send_doc'=> $inputFileName,
                            'month'=> $this->input->post('month'),
                            'year'=> $this->input->post('year')
            );
          
            
          }

  }
  if ($this->files->save_company_doc($savefile)) {
              put_msg('file sucessfully uploaded..!!');
              redirect(base_url(''.$user.'/share-files/companies/'.$this->input->post('year').'/'.hash_id($this->input->post('custid')).''));

            }
            else
            {
                put_msg('something went wronge..!!');
              redirect(base_url(''.$user.'/share-files/companies/'.$this->input->post('year').'/'.hash_id($this->input->post('custid')).''));
            }

}

}