<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
trait Users {

	public function ShowUsers($page_data='')
	{
		 if ($this->data['access'][$this->session->TYPE] == TRUE) {
      $this->load->model('User_model','users');
      $this->load->library("pagination");    
       $this->data['where'] = 'Users';
       $this->data['sub_menu'] = 'Details';      
       // $this->data['result'] = $this->emp->get_allemployee();
       $config["base_url"] = base_url() .$this->data['user_type']."/users";
        $config["total_rows"] = $this->users->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
            $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
       

        $this->data["links"] = $this->pagination->create_links();

        $this->data['result'] = $this->users->get_users($config["per_page"], $page);
        $this->load->model('Employee_model','emp');
        $this->data['companys']=$this->emp->get_companyies(); 

        
       $this->render('user_list');
       
     }
     else
     {
     $this->load->view('404');
     }
	}

  /* create user */
  public function CreateUser($value='')
  {
    
    $this->load->model('User_model','users');
     $this->load->helper('Password');
    $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

    $this->form_validation->set_rules('custid', 'Customer id', 'required|trim|numeric|xss_clean|strip_tags');
      $this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('mailid', 'User Email Id', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('code', 'Entity Code', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('cust_name', 'Company Name', 'required|trim|xss_clean|strip_tags');

          $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|strip_tags|callback_valid_password');  
           $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|xss_clean|strip_tags|matches[password]');       
      
           if ($this->form_validation->run() == FALSE) {            
            put_msg(validation_errors());
           goto_back(); 
           exit();
          }           
    if (!empty($this->input->post('spg_user'))) {


      $saveUser = array("custid"    => is($this->input->post('custid'),'NULL'), 
                        "email"     => is($this->input->post('mailid'),'NULL'), 
                        "username"  => is($this->input->post('username'),'NULL'), 
                        "password"  => is($hasher->HashPassword($this->input->post('password')),'NULL'), 
                        "access_code"=> is($this->input->post('code'),'NULL'), 
                        "user_type" => is($this->input->post('type'),'NULL'), 
                        "entity_name"=> is($this->input->post('cust_name'),'NULL')      
                      );

    }
    elseif (!empty($this->input->post('user'))) {
      $saveUser = array("custid"    => is($this->input->post('custid'),'NULL'), 
                        "email"     => is($this->input->post('mailid'),'NULL'), 
                        "username"  => is($this->input->post('username'),'NULL'), 
                        "password"  => is($hasher->HashPassword($this->input->post('password')),'NULL'), 
                        "access_code"=> is($this->input->post('code'),'NULL'), 
                        "user_type" => is($this->input->post('type'),'NULL'), 
                        "entity_name"=> is($this->input->post('cust_name'),'NULL')      
                      );
    }
   
      if ($this->users->saveUser($saveUser)) {
          put_msg('User successfully save..!!');
          goto_back();

      }
      else
      {
         put_msg('something is wrong..!!');
         goto_back();
      }
      goto_back();
  }

   /* edit the user */
  public function EditUser($value='')
  {
    
    $this->load->model('User_model','users'); 

      $saveUser = array("custid"    => is($this->input->post('custid'),'NULL'), 
                        "email"     => is($this->input->post('mailid'),'NULL'), 
                        "username"  => is($this->input->post('username'),'NULL'), 
                        // "password"  => is($hasher->HashPassword($this->input->post('password')),'NULL'), 
                        "access_code"=> is($this->input->post('code'),'NULL'), 
                        "user_type" => is($this->input->post('type'),'NULL'), 
                        "entity_name"=> is($this->input->post('cust_name'),'NULL')      
                      );
      // var_dump($saveUser);
      // echo verify_id($saveUser['username']);


    if (!empty($this->input->post('srno'))) {
      if ($this->users->updateUser($this->input->post('srno'),$saveUser)) {
          put_msg('User successfully update..!!');
          goto_back();
      }
      else
      {
         put_msg('something is wrong..!!');
        goto_back();
      }
    }
    else
    {
      goto_back();
    }
    
  }
  /* delete user */
  public function RemoveUser($value='')
  {
    $id=is($this->uri->segment(4),'NULL');
    $id=verify_id($id);
       $this->load->model('User_model','users');   
      if ($this->users->deleteUser($id)) {
          put_msg('User successfully deleted..!!');
          goto_back();
      }
      else
      {
         put_msg('something is wrong..!!');
         goto_back();
      }   
    
  }
  //
  public function ShowAddCompanysToUser($value='')
  {
   $this->load->model('User_model','users'); 
   
    $id=verify_id($this->uri->segment(4));
   // $id=verify_id($this->input->post('srno'));
// echo $id;

    $company=$this->users->select_companys($id);
    // echo $company;
    $out="<table><tr><th></th><th>Company Name</th><th>Company Register id</th></tr>";
    foreach ($company as $key) {
      $out.="<tr><td> <input type='hidden' name='userid' value='".$id."'>";
        if ($key->is_check == 'check') {
         $out.="<input type='checkbox'  name='custid[]' id='custid[]'  value='". $key->custid."' disabled='disabled' checked/> ";
        }
        else
        {
          $out .="<input type='checkbox'  name='custid[]'' id='custid[]'  value='".$key->custid."'/>";
        }
        $out .="</td><td><input type='hidden' name='entity_name[]' value='".$key->entity_name."'>".$key->entity_name."</td><td>".$key->custid."</td></tr>";
    }
    echo $out;
  }
  public function ShowRemoveCompanysToUser($value='')
  {
    
   $this->load->model('User_model','users'); 
   
    $id=verify_id($this->uri->segment(4));
   // $id=verify_id($this->input->post('srno'));
// echo $id;

    $company=$this->users->remove_companys($id);
    // echo $company;
    $out="<table><tr><th></th><th>Company Name</th><th>Company Register id</th></tr>";
    foreach ($company as $key) {
      $out.="<tr><td>";
       
         $out.="<input type='checkbox'  name='custid[]' id='custid[]'  value='". $key->custid."'  checked/> ";
        
        $out .="</td><td><input type='hidden' name='entity_name[]' value='".$key->entity_name."'>".$key->entity_name."</td><td>".$key->custid."</td></tr>";
    }
    echo $out;
             
           
  }
  /* attach company for user work */
  public function attach_companies($user='')
  {
    $count=sizeof($this->input->post('custid'));
    echo $count;
     $addCompanies=[];
      $this->load->model('User_model','users');
 
    if (!empty($this->input->post('action')) && $this->input->post('action') == 'add') {
    
        for ($i=0; $i < $count ; $i++) {
          $addCompanies[] = array('spgid' => is(user_id(),'N/A'),
                            'userid' => is($this->input->post('userid'),'N/A'),
                            'custid' => is($this->input->post('custid')[$i],'N/A'),
                            'username' => is($this->input->post('username'),'N/A'),
                            'entity_name' => is($this->input->post('entity_name')[$i],'N/A'),
                         );
     
      }

      if($this->users->add_comptoUsers($addCompanies))
      {
          put_msg('attach company to users');
      }
      else
      {
          put_msg('insert failed');
      }
        goto_back();
    } 
    elseif (!empty($this->input->post('action')) && $this->input->post('action') == 'remove') {
       for ($i=0; $i < $count; $i++) {
          $userid=is($this->input->post('userid'),'N/A');
          $custid= is($this->input->post('custid')[$i],'N/A');

        if($this->users->remove_comptoUsers($userid,$custid)){
            put_msg('remove company to users');
          }
        else
        {
            put_msg('remove failed');
        }
      }
        goto_back();

    }   
    
  }

  //Reste passwoord for user 
  public function RestePassword($page_data='')
  {
     $this->load->model('User_model','users');
    
    if (!empty($this->input->post('submit'))) {  
   

        $user=is($this->input->post('username'),'N/A');
        $oldpassword=is($this->input->post('oldpassword'),'N/A');
        $newpassword=is($this->input->post('newpassword'),'N/A');
        $custid=is($this->input->post('custid'),'N/A');
        $email=is($this->input->post('email'),'N/A');
        
        $getmessage=$this->users->set_password($custid,$user,$email,$oldpassword,$newpassword); 
         put_msg($getmessage);
         // echo $getmessage;
         // exit(); 


    }
    
      if ($this->data['access'][$this->session->TYPE] == TRUE) {
     
       $this->data['where'] = 'Users';
       $this->data['sub_menu'] = 'Rest-Password';
        $this->load->model('Employee_model','emp');
        $this->data['companys']=$this->emp->get_companyies();      
       $this->render('reset_password');
       
     }
     else
     {
        $this->load->view('404');
     }
    
  }
  /* set Access for company */
  public function SetAccess($page_data='')
  {
    $this->load->model('User_model','users');
    
    if (!empty($this->input->post('submit'))) {        
       
      
        $custid=is($this->input->post('custid'),'N/A');
        $code=is($this->input->post('code'),'N/A');
        
        $getmessage=$this->users->set_access($custid,$code); 
        put_msg($getmessage);     

    }   
      if ($this->data['access'][$this->session->TYPE] == TRUE) {
     
       $this->data['where'] = 'Users';
       $this->data['sub_menu'] = 'Rest-Password';       
    $this->load->model('Employee_model','emp');
    $this->data['companys']=$this->emp->get_companyies();

       $this->render('access');
       
     }
     else
     {
       $this->load->view('404');
     }
  }
  public function valid_password($password = '')
  {
    $password = trim($password);
    $regex_lowercase = '/[a-z]/';
    // $regex_uppercase = '/[A-Z]/';
    $regex_number = '/[0-9]/';
    $regex_special = '/[!@#$%^&*()\-_=+;:,.§~]/';
    if (empty($password))
    {
      $this->form_validation->set_message('valid_password', 'The {field} field is required.');
      return FALSE;
    }
    if (preg_match_all($regex_lowercase, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
      return FALSE;
    }
    // if (preg_match_all($regex_uppercase, $password) < 1)
    // {
    //  $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
    //  return FALSE;
    // }
    if (preg_match_all($regex_number, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
      return FALSE;
    }
    if (preg_match_all($regex_special, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+;:,.§~'));
      return FALSE;
    }
    if (strlen($password) < 5)
    {
      $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
      return FALSE;
    }
    if (strlen($password) > 32)
    {
      $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
      return FALSE;
    }
    return TRUE;
  }


}