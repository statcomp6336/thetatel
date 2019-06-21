<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Files_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
			$this->newdb=$this->load->database('db1',TRUE);
	}
	//get companies for explore
	public function get_companiesForExplore($year='')
	{
		$companies=$this->db->select('*')
				 ->from('completed_compliance a')
				 ->join('customer_master b','a.custid=b.custid AND a.spg_id="'.user_id().'"')
				 ->where('YEAR(a.Statutory_due_date)',$year)
				 ->group_by('a.custid')
				 ->order_by('a.act','desc')
				 ->get()
				 ->result();
				 return $companies;	
	}
	//get files for companies completed
	public function get_files($custid,$year='')
	{
		$companies=$this->db->select('*')
				 ->from('completed_compliance a')
				 ->join('comp_doc_temp b','a.srno=b.sl AND a.spg_id="'.user_id().'" AND a.custid="'.$custid.'"')
				 ->where('YEAR(a.Statutory_due_date)',$year)				
				 ->order_by('a.act','desc')
				 ->get()
				 ->result();
				 return $companies;	
	}
	//get companies for sharing
	public function get_companiesForSharing($year='')
	{
		$companies=$this->db->select('*')
				 ->from('customer_master a')
				 ->join('customer_dump b','a.custid=b.custid AND a.allianceid="'.user_id().'"')
				 ->where('b.year',$year)
				 ->where('flag',1)				
				 ->order_by('a.entity_name','desc')
				 ->get()
				 ->result();
				 return $companies;	
	}
}