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
		$this->newdb->select('*')->from('customer_master a');
	 // $this->newdb->from('completed_compliance a');
	 // $this->newdb->join('customer_master b','a.custid=b.custid ');
	 // $this->newdb->where('YEAR(a.Statutory_due_date)',$year);
	if (IS_COMPANY == TRUE) {
	 	$this->newdb->where('a.custid',user_id());
	 }else
	 {
	 	$this->newdb->where('a.spgid',user_id());
	 }
	  
	 $this->newdb->group_by('a.custid');
	 // $this->newdb->order_by('a.act','desc');
	 $companies=$this->newdb->get()->result();
	
				 return $companies;	
	}
	//get files for companies completed
	public function get_files($custid,$year='',$page='' )
	{
		if ((IS_COMPANY == TRUE || IS_SPG == TRUE) && $page== 'share-files' ) {
			return $this->fetch('customer_dump','*',array('custid' => $custid, 'year'=>$year))->result();
		}
		
		else
		{
			$companies=$this->newdb->select('*')
				 ->from('completed_compliance a')
				 ->join('comp_doc_temp b','a.srno=b.sl AND a.custid="'.$custid.'"')//AND a.spg_id="'.user_id().'"
				 ->where('YEAR(a.Statutory_due_date)',$year)				
				 ->order_by('a.act','desc')
				 ->get()
				 ->result();
				 return $companies;	
		}
	}
	//get companies for sharing
	public function get_companiesForSharing($year='')
	{
		$this->newdb->select('a.entity_name,a.custid')->from('customer_master a');
		// ->join('customer_dump b','a.custid=b.custid')->where('b.year',$year);
				 if (IS_COMPANY == TRUE) {
				 	
				 	$this->newdb->where('a.custid',user_id());
				 }else
				 {

				 	$this->newdb->where('a.spgid',user_id());
				 }

				$companies= $this->newdb->order_by('a.entity_name','desc')
				 ->get()
				 ->result();
				
				 return $companies;	
	}
	public function get_company_name($id='')
	{
		return $this->newdb->select('entity_name')->from('customer_master')->where('custid',$id)->get()->row();
	}
	public function save_company_doc($data)
	{
		return $this->add_batch('customer_dump',$data);
	}
}