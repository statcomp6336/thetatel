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
	// public function countOfNotis()
	// {

	// 	$id=$this->session->SESS_CUST_ID;
		


	// 	$result = $this->db->select('COUNT(*) AS notis')
 //             ->from('compose_email')
 //             ->where('flag',1)
 //             ->like('recevier_id',$id)
 //             ->get();

	// 	return $result->row()->notis;	

	// }

	//save and send the message to users
	public function save_mail($data='')
	{
		 /*
			@mail_status=1=>new mail
			@mail_status=2=>old mail			

		 */
		return $this->add('compose_email',$data);
	}
	//show all msg to user
	public function get_allMail()
	{	$data = array('custid' => user_id());
		return $this->fetch('compose_email','*',$data)->result();
	}
	//show all msg to user
	public function get_allSendMail()
	{	$data = array('sender_id' => user_id());
		return $this->fetch('compose_email','*',$data)->result();
	}
	//get newest msg
	public function countOfNewMail()
	{
		$data = array('custid' => user_id(),'mail_status' => 1);
		return $this->fetch('compose_email','COUNT(*) AS notis',$data)->row()->notis;
	}
	//update mail status
	public function update_mail_status()
	{
		$data = array('mail_status' => 2);
		return $this->edit('compose_email',array('custid'=> user_id()),$data);
	}
	/* READ MORE VIEWS MODELS ARE STARTS */
	//GET COMAPNYS FOR DASHBOARD
	public function get_DashSompanyes($value='')
	{
		return $this->db->where('spg_id',user_id())->group_by(array('act_code'))->get('compliance_scope_master_view')->result();
	}
	public function get_totalScope($custid='',$act_code='')
	{
		$this->db->select('*');
		$this->db->from('compliance_scope a');
		$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id=b.spgid');

		if ($custid !== "ALL" && $act_code !=="ALL") {
			$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
		}
		elseif ($custid !== "ALL" && $act_code =="ALL") {
			$this->db->where('a.custid',$custid);
		}
		elseif ($custid == "ALL" && $act_code !=="ALL") {
			$this->db->where('a.act_code',$act_code);
		}
		$this->db->where('a.spg_id',user_id());
	$result=$this->db->get()->result();
	
	return $result;


	}




}