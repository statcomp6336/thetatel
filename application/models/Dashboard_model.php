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
	function search_blog($title){
		$this->db->like('entity_name', $title , 'both');
		$this->db->order_by('entity_name', 'ASC');
		$this->db->limit(10);
		return $this->db->get('customer_master')->result();
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
	/* READ MORE VIEWsS MODELS ARE STARTS */
	//GET COMAPNYS FOR DASHBOARD
	public function get_DashSompanyes($value='')
	{
		if (IS_SPG== TRUE)
		{
			return $this->db->where('spg_id',user_id())->group_by(array('act_code'))->get('compliance_scope_master_view')->result();
		} 
		elseif (IS_COMPANY== TRUE)
		{
			return $this->db->where('spg_id',user_id())->group_by(array('act_code'))->get('compliance_scope_master_view')->result();
		} 
		elseif (IS_SPGUSER== TRUE)
		{
			return $this->db->where(array('spg_id'=>user_id(),'username'=>USERNAME))->group_by(array('act_code'))->get('scope_uucompany_view')->result();
		} 		
	}
	public function get_totalScope($custid='',$act_code='')
	{		
		if (IS_SPG== TRUE) 
		{
			$this->db->select('*');
			$this->db->from('compliance_scope a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
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
		elseif (IS_COMPANY== TRUE) 
		{
			$this->db->select('*');
			$this->db->from('compliance_scope a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
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
		elseif (IS_SPGUSER== TRUE) 
		{
			$this->db->select('*');
			$this->db->from('compliance_scope a');
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();
			return $result;
		}
	}
	//current Scope 
	public function get_CurrentScope($custid='',$act_code='')
	{
		if (IS_SPG== TRUE) 
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();		
			return $result;
		}
		elseif (IS_COMPANY== TRUE) 
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();		
			return $result;
		}
		elseif (IS_SPGUSER== TRUE) 
		{
			//select * from compliance_working_prior a INNER JOIN `customer_master` b on(a.custid=b.custid) where EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');		
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'','inner');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}		
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}		
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();	
			return $result;
		}
	}

	//Complince Done
	public function get_complianceDone($custid='',$act_code='')
	{
		if (IS_SPG== TRUE)
		{
			$this->db->select('a.custid ,b.entity_name,a.year,a.act,a.Particular,a.Reg_freq,a.due_date,a.Statutory_due_date,a.act_type,a.Certi_rece_date');
			$this->db->from('completed_compliance a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();	
			return $result;
		} 
		elseif (IS_COMPANY== TRUE)
		{
			$this->db->select('a.custid ,b.entity_name,a.year,a.act,a.Particular,a.Reg_freq,a.due_date,a.Statutory_due_date,a.act_type,a.Certi_rece_date');
			$this->db->from('completed_compliance a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();	
			return $result;
		} 
		elseif (IS_SPGUSER== TRUE)
		{
			$this->db->select('a.custid ,b.entity_name,a.year,a.act,a.Particular,a.Reg_freq,a.due_date,a.Statutory_due_date,a.act_type,a.Certi_rece_date');
			$this->db->from('completed_compliance a');
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}		
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE())");
			$this->db->where('a.spg_id',user_id());
			$result=$this->db->get()->result();	
			return $result;
		}
	}
	//Non Complince
	public function get_NonCompliance($custid='',$act_code='')
	{
		if (IS_SPG== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='5'");		
			$result=$this->db->get()->result();
			return $result;
		} 
		elseif (IS_COMPANY== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='5'");		
			$result=$this->db->get()->result();	
			return $result;
		} 
		elseif (IS_SPGUSER== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'');

			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}		
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='5'");		
			$result=$this->db->get()->result();
			return $result;
		}
	}

	//Pending compliance
	public function get_pendingCompliance($custid='',$act_code='')
	{
		if (IS_SPG== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='3'");		
			$result=$this->db->get()->result();
			return $result;
		} 
		elseif (IS_COMPANY== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='3'");		
			$result=$this->db->get()->result();
			return $result;
		} 
		elseif (IS_SPGUSER== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}		
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND a.status!='3'");		
			$result=$this->db->get()->result();
			return $result;		
		}
	}

	//Alert compliance
	public function get_AlertCompliance($custid='',$act_code='')
	{
		if (IS_SPG== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND (`Statutory_due_date`<=timestampadd(day, 10, now())) AND (`Statutory_due_date` >= now())");		
			$result=$this->db->get()->result();
			return $result;
		} 
		elseif (IS_COMPANY== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`customer_master` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array('a.custid'=>$custid,'a.act_code'=>$act_code));
			}
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where('a.custid',$custid);
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where('a.act_code',$act_code);
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND (`Statutory_due_date`<=timestampadd(day, 10, now())) AND (`Statutory_due_date` >= now())");		
			$result=$this->db->get()->result();	
			return $result;
		} 
		elseif (IS_SPGUSER== TRUE)
		{
			$this->db->select('*');
			$this->db->from('compliance_working_prior a');
			$this->db->join('`uu_companyselection` b','a.custid=b.custid AND a.spg_id='.user_id().'');
			if ($custid !== "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'a.act_code'=>$act_code,
										'b.username'=>USERNAME     ));
			}		
			elseif ($custid !== "ALL" && $act_code =="ALL") {
				$this->db->where(array(	'a.custid'=>$custid,
										'b.username'=>USERNAME  	));
			}
			elseif ($custid == "ALL" && $act_code !=="ALL") {
				$this->db->where(array(	'a.act_code'=>$act_code,
										'b.username'=>USERNAME 		));
			}
			$this->db->where("EXTRACT(YEAR_MONTH FROM a.`due_date`)=EXTRACT(YEAR_MONTH FROM CURDATE()) AND (`Statutory_due_date`<=timestampadd(day, 10, now())) AND (`Statutory_due_date` >= now())");		
			$result=$this->db->get()->result();		
			return $result;		
		}
	}

	// //graph count for employee salary pf and esic
	// public function get_graphElements($value='')
	// {
	// 	$q=array(
	// 		'total_emp'=> $this->select()->from()->where()
	// 	);
	// 	$select="COUNT(a.srno) as employees,COUNT(b.srno) as salries,COUNT(c.srno) as pf, COUNT(d.srno) as esic";
	// 	$this->db->select($select)->from('employee_master_new a')
	// 	->join('salary_master b'," a.spgid=b.spgid AND b.year=YEAR(CURDATE())")
	// 	->join('pf_template c',"a.spgid=c.spgid AND c.year=YEAR(CURDATE())")
	// 	->join('esic_template d',"a.spgid=d.spgid AND d.year=YEAR(CURDATE())")
	// 	->get()
	// 	->result();
	// }




}