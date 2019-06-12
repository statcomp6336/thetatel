<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Act_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}
	public function get_act_code()
	{
		$c = $this->newdb->select_max('act_code')->from('act_particular')->get()->row()->act_code;
		$last_code= empty($c) || $c== NULL?10000:$c;
       	$last_code_id= ($last_code - 10000)/100;
     	$code=($last_code_id * 100) + 10100;
     	return $code;
	}
	public function get_pcr_code($value='')
	{
		$p = $this->newdb->select_max('pcr_code')->from('act_particular')->where('act_code',$value)->get()->row()->pcr_code;
		if (!empty($p) || $p !== NULL) {
			$p_code = $p + 1;
		}
		else
		{
			$p_code=20001+(($value-10000));
		}       	
     	return $p_code;
	}
	public function get_acts()
	{
		return $this->newdb->get('act_particular')->result();
	}
	public function Create_act($value='')
	{
		if($this->newdb->insert('act_particuler',$value)){
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	public function get_bulk($custid)
	{
		$select="a.custid,a.name,b.act_code,b.act,b.Particular,b.`act type`,b.freq,b.due_date,b.stat_date";
		$query=$this->db->select($select)->from('act_applicable_to_customer a')
							->join('act_particular b','a.act_code = b.act_code')
							->where(array('custid' => $custid))
							->get()->result();
							return $query;
	}
}