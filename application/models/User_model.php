<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class User_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}

	/* save the user */
	public function saveUser($data)
	{
		return $this->add('users',$data);
	}
	/* update user */
	public function updateUser($id,$data)
	{
		return $this->edit('users',array('srno'=>$id),$data);
	}
	/* delete user */
	public function deleteUser($id)
	{
		return $this->remove('users',array('srno'=>$id));
	}

	/* get user data */
	public function get_users($limit, $start)
	{	
		$this->newdb->limit($limit, $start);
		$this->newdb->order_by('date', 'desc');
        $query = $this->newdb->get('users');
        return $query->result();
	}
	public function get_count() {
        return $this->db->count_all('users');
    }
    //select the company for user
    public function select_companys($id)
    {
    	// echo $id='minal';
    	$select="a.entity_name, a.custid,IF(b.userid = '".$id."','check','uncheck') as is_check";;
    	

    	$result=$this->db->select($select)
    					 ->from('customer_master as a')
    					 ->join('uu_companyselection as b','a.allianceid=b.spgid AND a.custid=b.custid AND b.userid="'.$id.'"','left')
    					 ->order_by('a.entity_name','desc')
    					 ->get()
    					 ->result();
    	return $result;				 

    }
    //remove the company for user
    public function remove_companys($id)
    {
    	// echo $id='minal';
    	$select="a.entity_name, a.custid,IF(b.userid = '".$id."','check','uncheck') as is_check";;
    	

    	$result=$this->db->select($select)
    					 ->from('customer_master as a')
    					 ->join('uu_companyselection as b','a.allianceid=b.spgid AND a.custid=b.custid AND b.userid="'.$id.'"','left')
    					 ->where('b.userid IS NOT NULL', null, false)
    					 ->order_by('a.entity_name','desc')
    					 ->get()
    					 ->result();
    	return $result;				 

    }
    //
    public function add_comptoUsers($data='')
    {
    	return $this->newdb->insert_batch('add_companies_for_users',$data);

    }
     public function remove_comptoUsers($userid,$custid)
    {
    	return $this->remove('add_companies_for_users',array('userid'=>$userid,'custid'=>$custid));

    }
    //set the password
    public function set_password($custid,$user,$email,$password,$newpassword,$is_master='')
    {
        $this->load->helper('Password');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $reset=array(
                      'password'=>is( $hasher->HashPassword($newpassword))
                    );
        $username=$this->get_id('users','password,username',array('email'=>$email,'custid'=>$custid));       

       
        if (!empty($username->username) && $username->username!==NULL) {
            $name=$username->username;

            $name=$this->encrypt->decode($name);      
           
                if ($name == $user){
                    if($hasher->CheckPassword($password, $username->password)) {
                    
                       $id=$this->get_id('users','srno',array('email'=>$email,'custid'=>$custid))->srno;
                       if($this->edit('users',array('srno'=>$id),$reset))
                       {
                        $msg="set password";
                        return $msg;
                       }
                       else
                       {
                        $msg="not updated ";
                        return $msg;
                       }
                   }
                   else
                   {
                     $msg="old password not match..!";
                    return $msg; 
                   }

                }
                else
                {
                     $msg="Invalid User..!";
                    return $msg;                 
                }
            }


    }




}
