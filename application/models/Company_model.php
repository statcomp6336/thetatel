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

}	