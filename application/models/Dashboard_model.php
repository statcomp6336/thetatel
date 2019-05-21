<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Dashboard_model extends Base_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function countOfScope()
	{
		$f_table="compliance_scope a";
		$s_table="customer_master b";
		$match="a.custid=b.custid";
		$select="COUNT(*) AS particular";
		$where="a.spg_id";
		$id=$this->session->SESS_CUST_ID;
		$result=$this->join($f_table,$s_table,$match,$select,$where,$id);	

		return $result->row()->particular;	
	}
	public function countOfBultUpdate()
	{
		$result=$this->db->select('count(*) c1 ')
						->from('act_applicable_to_customer a')
						->where(array('b.year'=>'', 'b.reg_freq'=> '','b.due_date'=>'0000-00-00','b.Statutory_due_date'=> '0000-00-00'))
						->join('compliance_scope b','a.act_code = b.act_code  AND a.custid=b.custid')
						->get()
						->row();
		return $result->c1;				

	}
	public function countOfComplience()
	{
		$f_table="completed_compliance a";
		$s_table="customer_master b";
		$match="a.custid=b.custid";
		$select="count(*) as compl_completed";
		$where="a.spg_id";
		$id=$this->session->SESS_CUST_ID;
		$result=$this->join($f_table,$s_table,$match,$select,$where,$id);	

		return $result->row()->compl_completed;	
	}
	public function countOfNonComplience()
	{
		$id=$this->session->SESS_CUST_ID;
			$result=$this->db->select('count(srno) as noncompliance')
						->from('compliance_working_prior')
						 ->where('spg_id',$id)
                    	 ->where(' status!=',5,FALSE)					
						->get()
						->row();
		return $result->noncompliance;	

	}
	public function countOfPending()
	{
		$f_table="compliance_working_prior a";
		$s_table="customer_master b";
		$match="a.custid=b.custid";
		$select="sum(case when a.`status` = '2' then 1 else 0 end) as pending";
		$where="a.spg_id";
		$id=$this->session->SESS_CUST_ID;
		$result=$this->join($f_table,$s_table,$match,$select,$where,$id);	

		return $result->row()->pending;

	}
	public function countOfcomplatence()
	{
		$id=$this->session->SESS_CUST_ID;
		$result=$this->db->select('count(*) as compliance ')
						->from('completed_compliance a')
						->where(array('a.due_date'=>'CURDATE()', 'a.spg_id'=> $id,))//error
						->join('customer_master b','a.custid=b.custid')
						->get()
						->row();
		return $result->compliance;		
	}
	public function countOfAlert()
	{
		$f_table="compliance_working_prior a";
		$s_table="customer_master b";
		$match="a.custid=b.custid";
		$select="sum(`Statutory_due_date`<=timestampadd(day, 10, now()) AND `Statutory_due_date` >= now())  as alert";
		$where="a.spg_id";
		$id=$this->session->SESS_CUST_ID;
		$result=$this->join($f_table,$s_table,$match,$select,$where,$id);	

		return $result->row()->alert;
	}
	public function countOfMyApprovals()
	{
		$f_table="compliance_working_prior a";
		$s_table="customer_master b";
		$match="a.custid=b.custid";
		$select="sum(case when a.`status` = '3' then 1 else 0 end)as view_compliance";
		$where="a.spg_id";
		$id=$this->session->SESS_CUST_ID;
		$result=$this->join($f_table,$s_table,$match,$select,$where,$id);	

		return $result->row()->view_compliance;
	}
	public function countOfNotis()
	{

		$id=$this->session->SESS_CUST_ID;
		$result = $this->db->select('COUNT(*) AS notis')
             ->from('compose_email')
             ->where('flag',1)
             ->like('recevier_id',$id)
             ->get();

		return $result->row()->notis;	

	}


}