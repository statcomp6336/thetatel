<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Login_model extends CI_Model
{
	
	function __construct()
	{
		# code...

	}

	public function check_login($value)
	{
		$username=$value['username'];
		$cid=$value['cid'];
		$password= $value['password'];

		$where = array('username ' => $username , 'custid ' => $cid);
		$result=$this->db->where($where)->get('users');

		if ($result->num_rows() > 0) {

			$result=$result->row();
			$hashpass=$result->password;
			$type=$result->user_type;
			$accesscode=$result->access_code;


			$spg_result=$this->db->where('spg_id',$cid)->get('spg_master')->row();
			$cust_result=$this->db->where('custid',$cid)->get('customer_master')->row();


			if(crypt($password, $hashpass) == $hashpass) 
			{
				if($accesscode == "1") 
				 {
				 	$sess_data = array(
				    						'popup' => "popup",
				    						'SESS_CUST_ID' => $result->custid,
				    						'SESS_USER_NAME' => $result->username,
				    						'SESS_CUST_NAME' => '', 
				    						'SESS_USER_TYPE' => '', 
				    						'SESS_USER_SENDERID' => '',
				    						'SESS_PROD_CODE' =>'',
				    						'SESS_SID' =>'',
				    						'TYPE'=> $type);
				 	
			        if($type == "9") 
				    {
				    	$sess_data['SESS_CUST_NAME']= $spg_result->org;
				    	$sess_data['SESS_USER_TYPE']=$spg_result->custtype;
				    	$sess_data['SESS_USER_SENDERID']=$spg_result->senderid;
				    	

				    	
				    	$this->session->set_userdata($sess_data);
				        	// session_regenerate_id();
						
				   //           header("location: ../users/spg/access?user=dashboard&spg=dashboard");
				    	return TRUE;
				    	exit();
		              } 
		    //end if
		              elseif($type =="1") 
		              {
		              	$sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              	$sess_data['SESS_PROD_CODE']= $cust_result->custtype;


		          
				    	$this->session->set_userdata($sess_data);
						return TRUE;
						exit();
				   
				   //          header("location: ../users/company/access?user=users_dashboard&spg=dashboard");
				  	  }
				  	  //end if	
				  	  elseif($type =="2")
				  	  {
				  	  	 $sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              	$sess_data['SESS_PROD_CODE']= $cust_result->custtype;

				  	  
				    	$this->session->set_userdata($sess_data);
						return TRUE;
						exit();
							
							// header("location: ../users/branch/access?user=users_dashboard&spg=dashboard");
				   
			   		  } 
			   		  //end if
			   		  elseif($type =="3") {
			   		  	 	$sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              		$sess_data['SESS_PROD_CODE']= $cust_result->custtype;
			   		  		
				    	$this->session->set_userdata($sess_data);
						return TRUE;
						exit();
							
							// header("location: ../users/contractor/access?user=users_dashboard&spg=dashboard");
				   
			   		  }
			   		   //end if
			   		  elseif($type =="4") 
			   		  {
			   		  	$sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              		$sess_data['SESS_PROD_CODE']= $cust_result->custtype;
			   		  	
				    	$this->session->set_userdata($sess_data);
						return TRUE;
							exit();
							
							// header("location: ../users/subcontractor/access?user=users_dashboard&spg=dashboard");
				  	   }
				  	   	//end if
				  	   elseif($type =="5") 
				  	   {
				  	   	$sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              		$sess_data['SESS_PROD_CODE']= $cust_result->custtype;
				  	  
				    	$this->session->set_userdata($sess_data);
						return TRUE;

						exit();
							
							// header("location: ../users/spg_users/access?spguser=uudashboard");
				  		}
				  		// end if	
						elseif($type =="55") 
						{
							$sess_data['SESS_CUST_NAME']= $cust_result->entity_name;
		              		$sess_data['SESS_PROD_CODE']= $cust_result->custtype;
							
				    	$this->session->set_userdata($sess_data);
						return TRUE;
						exit();

							
							// header("location: ../users/spg_users/access?spguser=uudashboard");
				  		}
				  		//end if
						else 
						{
							put_msg('You are authorised, please contact system your administrator');
			               
							return FALSE;
		    
		   		    	}//end else

			}
			else
			{
				put_msg("access deniedted");
				return FALSE;
			}
				
		}
		else
		{
			put_msg("wrong password");
			return FALSE;
		}
			}
			else
			{
				put_msg("wrong username or customer id");
			return FALSE;
			}
		
	}

}