<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Company_model extends Base_model
{
	
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}
	/*+++++ save company details +++++*/
	public function create_company($value='')
	{
		$save_details=$this->newdb->insert('customer_master',$value);
		if ($save_details) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function create_backup_company($value='')
	{
		$save_details=$this->newdb->insert('custid_backup',$value);
		if ($save_details) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	protected function get_data($table,$select,$where)
	{
		$this->newdb->select($select);
		$this->newdb->where($where);
		$query=$this->newdb->get($table);
		return $query;
	}
	 public function is_custid($pin,$type)
	 {
	 	$this->newdb->select('*');
		$this->newdb->where('pin',$pin);
		$this->newdb->where('custtype',$type);
		$query=$this->newdb->get('custid_backup');

		if ($query->num_rows() > 0) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	 }
	  public function get_custid($pin,$type)
	 {
	 	if ($this->is_custid($pin,$type) == TRUE) {
	 		$result=$this->get_data('custid_backup','Max(custid) AS custid',array('pin' =>$pin,'custtype' => $type));
	 		$result = $result->row()->custid;
	 		return $result + 1 ;
	 	}
	 	else
	 	{
	 		$result=$this->get_data('customer_master','count(custid) AS pincount',array('pin' =>$pin));
	 		$result = $result->row()->pincount;
	 		$result +=1;
	 		$custid= ($type*1000000+($pin));
	$custid = (($custid*10000)+$result);
	 		return $custid;
	 	}
	 }
	 public function get_branchCode($pan)
	 {
	 	$result=$this->get_data('customer_master','count(entity_pan) AS pancount',array('entity_pan' =>$pan));
	 		$result = $result->row()->pancount;
	 		return $result + 1 ;
	 }

	 public function all_companys($key='')
	 {	
	 	$result =$this->db->select('custid,entity_name')
	 					  ->from('customer_master')
	 					  ->where('spgid',user_id())
	 					  ->like('entity_name',$key)
	 					  ->get();
	 		$result = $result->result();
	 		
	 		 return json_encode($result);
	 }
	 public function acts($value='')
	 {	 	
	 	return $this->db->get('act_particular')->result();	 	
	 }
	 public function get_acts($cust_id='')
	 {
	 	$returnActs=[];
	 	$getActs =$this->db->query('SELECT DISTINCT act,act_code FROM `act_particular`');
	 	if ($getActs->num_rows() >0) {
	 		foreach ($getActs->result() as $key ) {
	 			$getCheckAct=$this->db->distinct()->select(' act_code')->from('act_applicable_to_customer')-> where(' custid',$cust_id)-> where(' act_code',$key->act_code)->get();	 			
	 			
	 			if ($getCheckAct->num_rows()>0 ) {				
	 					
	 				$returnActs[]=array('act'=> $key->act, 'act_code'=>$key->act_code,'is_act' => TRUE);	
	 			}
	 			else
	 			{
	 				$returnActs[]=array('act'=> $key->act, 'act_code'=>$key->act_code,'is_act' => FALSE);	
	 			} 			

	 		}
	 	}
	 	return $returnActs;
	 }
	 public function attach_act_to_company($value='')
	 {
	 	$len=count($value['act_code']);	
	 	// $valuesArr1=[];
	 	// $valuesArr=[];
	 	for ($i=0; $i < $len ; $i++) {

	 		$valuesArr1 = array('custid' => $value['custid'],
	 							'name'=>$value['name'],
	 							'act_code'=>$value['act_code'][$i],
	 							'spgid'=>$value['spgid']	 );

	 			if($this->newdb->insert('act_applicable_to_customer', $valuesArr1))
				 	{
				 		$get_act_data=$this->join('act_applicable_to_customer as A','act_particular as B','B.act_code = A.act_code','A.custid as id, A.act_code as code, B.act as act, B.particular as p',array('A.custid' =>$value['custid'], 'A.act_code' => $value['act_code'][$i] ));
	 		 	$get_act_data=$get_act_data->result();
	 		 // 	echo "<pre>";
	 			// var_dump($get_act_data);
				 		$valuesArr = array('custid' => $get_act_data->id,
	 							'act'=>$get_act_data->act,
	 							'act_code'=>$get_act_data->code,
	 							'spg_id'=>$value['spgid'],	 	
	 							'Particular'=>$get_act_data->p);
	 					$this->newdb->insert('compliance_scope', $valuesArr1);	
	 					return TRUE;		 	
				 	}
				 	else
				 	{
				 		return FALSE;
				 	}

	 		} 	
	 	
	 	// implode(',', $valuesArr);
	 	/*
SELECT A.custid ,'$spgid', A.act_code, B.act, B.particular
	  FROM act_applicable_to_customer A
	INNER   JOIN act_particular B
		ON B.act_code = A.act_code
	 WHERE A.custid  ='$entid' and A.act_code='$act_code'";
	 	*/
	 	

	 	
	 }

}	