<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core/Base_model.php";
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
	 	$result =$this->newdb->select('custid,entity_name')
	 					  ->from('customer_master')
	 					  // ->where('spgid',user_id())	 					 
	 					  ->get();
	 		$result = $result->result();
	 		
	 		 return $result;
	 }
	 public function acts($value='')
	 {	 	
	 	return $this->db->get('act_particular')->result();	 	
	 }
	 public function get_acts($id='')
	 {
	 	// $returnActs=[];
	 	$select="a.act,a.act_code,IF(b.custid = '".$id."','check','uncheck') as is_check";
	 	$result=$this->newdb->select($select)
    					 ->from('act_particular as a')
    					 ->join('act_applicable_to_customer as b','a.act_code=b.act_code AND b.custid="'.$id.'"','left')
    					 ->group_by('a.act_code')
                        
    					 ->order_by('a.act','desc')

    					 ->get()
    					 ->result();
    	return $result;	

	 	
	 }
	 public function attach_act_to_company($value='')
	 {
	 	
	 	if (!empty($value['act_code'])) {
	 			$len=count($value['act_code']);
	 	
	 	for ($i=0; $i < $len ; $i++) {

	 		$valuesArr1 = array('custid' => $value['custid'],
	 							'name'=>$value['name'],
	 							'act_code'=>$value['act_code'][$i],
	 							'spgid'=>user_id());

	 			if($this->newdb->insert('act_applicable_to_customer', $valuesArr1))
				 	{
				 		$get_act_data=$this->join('act_applicable_to_customer as A','act_particular as B',' B.act_code = A.act_code','A.custid as id, A.act_code as code, B.act as act, B.particular as p',array('A.custid' =>$value['custid'], 'A.act_code' => $value['act_code'][$i] ));
	 		 	$get_act_data=$get_act_data->row();
	 		 
				 		$valuesArr = array('custid' => $get_act_data->id,
	 							'act'=>$get_act_data->act,
	 							'act_code'=>$get_act_data->code,
	 							'spg_id'=>user_id(),	 	
	 							'Particular'=>$get_act_data->p
	 						);
	 					$this->newdb->insert('compliance_scope', $valuesArr);
	 					$r=TRUE;				
				 	}
				 } 
	 	}
	 	else
	 	{
	 		put_msg('Please Act selected....!');
	 		$r=FALSE;	 	
	 	}

	 		return $r;
	 }

	public function get_allCompanydetails($reg_type)
	{
	 				$this->newdb->select("entity_name,custid,allianceid");
					$this->newdb->from('customer_master');
					if($reg_type=="subcontractor")
					{
						$this->newdb->where(array(	'spgid' =>user_id(),'custtype' => 3));
					}
					else
					{
						$this->newdb->where(array(	'spgid' =>user_id(),'custtype' => 1));
					}
					
					$result=$this->newdb->get()->result();
					

					return $result;
	}

	// get act for for attact company
	public function get_attachActs($custid='')
	{
		return $custid;
	}

	public function get_Entities()
	{
		$select="entity_name,custid, CASE custtype 
						WHEN  1 THEN 'COMPANY'
						WHEN  2 THEN 'BRANCH'
						WHEN  3 THEN 'CONTRACTOR'
						WHEN  4 THEN 'SUB-CONTRACTOR'
						WHEN  5 THEN 'SPG-USER'
						WHEN  9 THEN 'SPG'
						ELSE 'OTHER'
						END AS catagory
			";
		$this->newdb->select($select);
		$this->newdb->from('customer_master');	
		$this->newdb->where(array('spgid' =>user_id()));	
		$result=$this->newdb->get()->result();
	

		return $result;
	}

}	