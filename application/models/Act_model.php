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
	public function get_actss()
	{
		return $this->db->group_by('act')->get('act_particular')->result();
	}
	public function get_companies($value='')
	{
		return $this->db->select('custid,entity_name')->from('customer_master')->get()->result();
	}
	public function get_timelineData($id='')
	{
		return $this->fetch('timeline_data','*',array('custid'=>$id))->result();
	}
	public function save_TimelineComment($data='')
	{
		return $this->add('timeline_data',$data);
	}


	public function get_compActs($id)
	{
		return $this->newdb->where('spgid',$id)->get('act_applicable_to_customer')->result();
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
	/* bulk compliance start*/
	public function bulk_compliance($id,$type,$month)
	{
		
		$this->db->select("a.act_type,a.Particular,a.Remarks,a.status,a.Task_complitn_date,a.Retrn_Challan_genrtn_date,a.Submisn_Pay_date,a.Pend_docu_in_nos,a.srno,b.obligation,b.act,b.act_code,a.registration_no,a.Application_date,a.Applicable_date,a.Valid_upto,a.Renewal_date");
		$this->db->from('compliance_working_prior a');
		$this->db->join('act_particular b','a.act=b.act AND a.Particular=b.Particular');
		$this->db->where(array('a.custid' => $id, 'a.spg_id'=>user_id(),'a.status !=' => '3'));		
		if ($type == 'Preventive_Compliance') {
		$this->db->where(array('a.act_type' => 'Preventive Compliance'));

		}
		elseif ($type == 'Compliance') {		
			$this->db->where(array('a.act_type' => 'Compliance'));
		}
		elseif ($type == 'Registration') {
			$this->db->where(array('a.act_type' => 'Registration'));
		}

		if (!empty($month) && $month!=="ALL") {
				$this->db->where("monthname(a.due_date)",$month);
			}
		$result=$this->db->limit(10)->get();

	$result= $result->result();

	return $result;
	

	}
	/* end bulk compliance */
	/* start bulk_approval */
	public function bulk_approval($id,$act,$type)
	{
		$this->db->select("*");
		$this->db->from('compliance_working_prior');
		// $this->db->join('act_particular b','a.act=b.act AND a.Particular=b.Particular');
		$this->db->where(array('custid' => $id, 'spg_id'=>user_id(),'status' => '3' ));

		if ($type == 'Preventive_Compliance') {
		$this->db->where(array('act_type' => 'Preventive Compliance'));

		}
		elseif ($type == 'Compliance') {		
			$this->db->where(array('act_type' => 'Compliance'));
		}
		elseif ($type == 'Registration') {
			$this->db->where(array('act_type' => 'Registration'));
		}

		if (!empty($act) && $act!=="ALL") {
				$this->db->where("act_code",$act);
			}
		$result=$this->db->limit(10)->get();

	$result= $result->result();

	return $result;
	}
	/* end  bulk_approval */


	public function docs($srno)
	{
		$result=$this->db->select('*')->from('comp_doc_temp')->where('sl',$srno)->get()->result();
		return $result;
	}
	public function add_docs($docs)
	{
		if($this->db->insert('comp_doc_temp',$docs)){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	/* update data of bulk compilence */
	public function edit_bulkComplince($data,$id)
	{
		return $this->db->where('srno',$id)->update('compliance_working_prior',$data);
	}
	/* when compliance process complete then this function call */
	public function complete_compliance()
	{
		$select = $this->db->select('*')->where('status', 5)->get('compliance_working_prior');
		if($select->num_rows())
		{
		    if($this->add('completed_compliance', $select->result_array()))
		    {
		    	if ($this->remove('compliance_working_prior',array('status'=> 5))) {
		    		return TRUE;
		    	}
		    }
		}		
	}

	/* flow work for approval and rejection */
	public function saveFlowOfWork($saveData='')
	{
		return $this->add('flow_of_timeline',$saveData);
	}
	public function flowOfWork($id='')
	{
		$result=$this->newdb->select('*')->from('flow_of_timeline')->where('row_id',$id)->order_by('date', "desc")->get()->result();
		return $result;
	}
	/*
		*@IS_FileRecive [0=not-completed,1=completed,]
		*@IS_FileUpload [0=not-completed,1=completed,2=emp_excel up,3=sal_excel up]
		*@IS_PfProcess	[0=not-completed,1=completed,]
		*@IS_Compliation[0=not-completed,1=completed,2=upload-data,3=rejectd]
		*@IS_Approve	[0=not-completed,1=completed,2=rejected]
		*@IS_Complete   [0=not-completed,1=completed]
	*/
	public function update_timeline($id='',$data='')
	{
		return $this->edit('timeline',array('custid'=>$id),$data);
	}

}