<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Export extends Base_model
{
	function __construct()
	{
		parent::__construct();
		$this->newdb=$this->load->database('db1',TRUE);
			$this->load->library('Excel');

	}
	/* export pf report */
	public function PF($spgid,$custid,$month='',$year='')
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("custid","entity_name","empid","UANno","member_name","gross_wages","EPF_wages","EPS_wages","EDLI_wages","EPF_contri_remitted","EPS_contri_remitted","EPS_EPF_diff","NCP_days","refund_advance","month","year","flag","created_at");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('*')
							  ->from('pf_template')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid))
							  ->group_by('empid')
							  ->get()
							  ->result();	
		$start_row = 2;

		foreach ($emp_data as $key) {

			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->UANno);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->member_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->gross_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->EPF_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->EPS_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->EDLI_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->EPF_contri_remitted);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->EPS_contri_remitted);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->EPS_EPF_diff);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->NCP_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->refund_advance);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->month);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->year);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->flag);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->created_at);
			
			$start_row++;
			$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'PFReport.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export esic template report companywise */
	public function ESICTemplate($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("custid","entity_name","empid","esicno","name","no_of_days","monthly_wages","reason_code","last_working_day","month","year","flag","created_at");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
		$emp_data=$this->newdb->select('*')
							  ->from('esic_template')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid))
							  ->group_by('empid')
							  ->get()
							  ->result();	
		$start_row = 2;

		foreach ($emp_data as $key) {

			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->esicno);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->no_of_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->monthly_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->reason_code);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->last_working_day);
		
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->month);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->year);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->flag);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->created_at);
			
			$start_row++;
			$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'ESICReport.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export ESIC newjoinee report */
	public function ESICnewjoinee($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("Custid","Company name","Name as per aadhar record","Father Name","Husband Name (only for female)","Date of Birth","Date of Joining","Sex","Marital Status","Contact","Aadhar no","Residential Address","Permanent Address","Permanent Address","Family Details - DOB","Family Details - Age","Family Details - Relation","Family Details - Adhar No.","Residing with Her/Him");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("custid,entity_name,nameadhr,fath_hus_name,if(fath_hus_name!=NULL,`fath_hus_name`,'NIL') as HusbandName,birth_date,join_date,gender,marital_status,mob,adhaar,temp_address,per_address,relname,reldob,relage,if(relname!=NULL,`relname`,'NIL') as Relation,reladhr,if(reladhr!=NULL,`reladhr`,'NIL') as Residing ")
							  ->from('employee_master_new')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid,'esic_no'=>'0'))
							  ->get()
							  ->result();	
							 
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->nameadhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->fath_hus_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->HusbandName);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->birth_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->join_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->gender);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->marital_status);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->mob);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->adhaar);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->temp_address);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->per_address);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->relname);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->reldob);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->relage);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->Relation);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->reladhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(18,$start_row,$key->Residing);
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'ESICnewJoineeReport.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export Compliance report */
	public function compliance($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("Customer ID","Company name","Particular","Statutory Due Date","Task Completion Date","Return/Challan Generation Date","Submission/Payment Date","Document Submitted to GOVT in Nos.","Pending documents in Nos.","Copy of Document","Responsible Person from Client","Responsible Person from consultant","Remarks");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("a.custid,a.entity_name,b.Particular,b.Statutory_due_date,b.Task_complitn_date,b.`Retrn/Challan_genrtn_date` as ret,b.`Submisn/Pay_date` as sub,b.Docu_submit_to_GOVT_in_nos,b.Pend_docu_in_nos,b.Copy_of_docu,b.Resp_prsn_frm_client,b.Resp_prsn,b.Remarks")
							->from('customer_master a')
							->join('completed_compliance b', 'a.custid=b.custid')
							->where(array(	'b.spg_id' =>$spgid,
											'b.custid'=>$custid))
							->get()->result();

		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->Particular);
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->Data _recev_frm_client);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->Statutory_due_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->Task_complitn_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->ret);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->sub);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->Docu_submit_to_GOVT_in_nos);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->Pend_docu_in_nos);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->Copy_of_docu);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->Resp_prsn_frm_client);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->Resp_prsn);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->Remarks);
			
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'compliance.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export Compliance report */
	public function noncompliance($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("Customer ID","Company name","Particular","Statutory Due Date","Task Completion Date","Return/Challan Generation Date","Submission/Payment Date","Document Submitted to GOVT in Nos.","Pending documents in Nos.","Copy of Document","Responsible Person from Client","Responsible Person from consultant","Remarks");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("a.custid,a.entity_name,b.Particular,b.Statutory_due_date,b.Task_complitn_date,b.`Retrn/Challan_genrtn_date` as ret,b.`Submisn/Pay_date` as sub,b.Docu_submit_to_GOVT_in_nos,b.Pend_docu_in_nos,b.Copy_of_docu,b.Resp_prsn_frm_client,b.Resp_prsn,b.Remarks")
							->from('customer_master a')
							->join('compliance_working_prior b', 'a.custid=b.custid')
							->where(array(	'b.spg_id' =>$spgid,
											'b.custid'=>$custid))
							->get()->result();

		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->Particular);
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->Data _recev_frm_client);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->Statutory_due_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->Task_complitn_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->ret);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->sub);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->Docu_submit_to_GOVT_in_nos);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->Pend_docu_in_nos);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->Copy_of_docu);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->Resp_prsn_frm_client);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->Resp_prsn);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->Remarks);
			
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'noncompliance.xlsx"');
		$obj_writer->save('php://output');
	}
}