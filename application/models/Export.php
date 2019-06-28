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

	/* export PF newjoinee report */
	public function PFnewjoinee($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("Custid","Company name","Name","UAN No.(if any)","DOB as per Aadhar","Gender","Fathers name","Spouse Name","Marital Status","Mobile NO","Email ID","Date of Joining","Bank Account no","IFSC code no","Name as per Bank A/c","PAN No","Name as per PAN card","AADHAAR","Name as per Aadhar card");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("custid,entity_name,emp_name,uan_no,dobadhr,gender,fath_hus_name,if(fath_hus_name!=NULL,`fath_hus_name`,'NIL')as spouse,marital_status,mob,email,join_date,bank_ac,ifsc,nameinbank,pan,namepan,adhaar,nameadhr")
							  ->from('employee_master_new')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid,'uan_no'=>'0','uan_no'=>' '))
							  ->get()
							  ->result();	
							 
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->emp_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->uan_no);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->dobadhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->gender);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->fath_hus_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->spouse);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->marital_status);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->mob);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->email);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->join_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->bank_ac);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->ifsc);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->nameinbank);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->pan);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->namepan);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->adhaar);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(18,$start_row,$key->nameadhr);
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'PFnewJoinee.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export PF Summary report */
	public function PFSummary($spgid,$custid)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("NOE","Gross Salary","PF Sal","EPS Sal","EDLI Sal","PF","EPS","Co PF","Admin charges","Other Charges","Total");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("entity_name,count(member_name) as name,sum(gross_wages) as gross,sum(EPF_wages) as epfwages,sum(EPS_wages) as epswages,sum(EDLI_wages) as edliwages,sum(EPF_contri_remitted) as epfcontri,sum(EPS_contri_remitted) as epscontri,sum(EPS_EPF_diff) as diff,CAST(((sum(EPF_wages)*0.5)/100) as UNSIGNED)as admin,CAST(((sum(EDLI_wages)*0.5)/100) as UNSIGNED) as other,CAST(((sum(EPF_contri_remitted))+(sum(EPS_contri_remitted))+(sum(EPS_EPF_diff))+(((sum(EPF_wages)*0.5)/100))+(((sum(EDLI_wages)*0.5)/100))) as UNSIGNED) as total")
							  ->from('pf_template')							  
							  ->where(array('spgid'=>$spgid,'custid' => $custid,'UANno!='=>'0'))
							  ->get()
							  ->result();	
							 
		$start_row = 2;
		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->gross);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->epfwages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->epswages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->edliwages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->epfcontri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->epscontri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->diff);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->admin);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->other);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->total);
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'PFSummary.xlsx"');
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
	  header('Content-Disposition: attachment;filename="'.$comp_name.'ESICnewJoinee.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export esic template report companywise */
	public function ESICTemplate($spgid,$custid,$month,$year,$check)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("custid","entity_name","Emp ID","IP No","IP Name","No of days for which wages paid","Total Monthly Wages","Reasons code for zero working days","Last working days","Month","Year");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}
			$this->db->select('*');
			if($check=='old')
			{
				$this->db->from('esic_template_history');	
			}
			else
			{
				$this->db->from('esic_template');	
			}			  						  
			$this->db->where(array(	'spgid'	 => $spgid,
									'custid' => $custid,
									'month'	 => $month,
									'year'	 => $year    ));
		$emp_data=$this->db->get()->result();	
							  
		$start_row = 2;

		foreach ($emp_data as $key) {

			//"esicno,name,no_of_days,monthly_wages,reason_code,last_working_day"
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
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->flag);
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->created_at);
			
			$start_row++;
			//$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="ESICTempate.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export ESIC Template EmPID Companywise report in Excel formate*/
	public function ESICTemplateEmpid($spgid,$custid,$month,$year,$location,$check)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("custid","entity_name","IP No","EMP ID","IP Name","No of days for which wages paid","Total Monthly Wages","Employee Contribution","Employer Contribution","Reasons code for zero working days","Last working days","Date of Join","Date of Birth","Vender ID","Contractor Name","Location","Month","Year");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

			$this->db->select('a.custid,a.entity_name,a.esicno,a.empid,a.name,a.no_of_days,a.monthly_wages,CAST(((a.monthly_wages*1.75)/100) as UNSIGNED) as emp_contri,CAST(((a.monthly_wages*4.75)/100) as UNSIGNED) as empr_contri,a.reason_code,a.last_working_day,b.join_date,b.birth_date,b.vendor_id,b.contractor_name,b.location,a.month,a.year');
			if($check=='old')
			{
				$this->db->from('esic_template_history a');
			}
			else
			{
				$this->db->from('esic_template a');	
			}	    
			$this->db->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
			if($location=="ALL")
			{
			$this->db->where(array(		'a.spgid'    => $spgid,
										'a.custid'   => $custid,
										'a.month'	 => $month,
										'a.year'	 => $year   ));
			}
			else
			{
			$this->db->where(array(		'a.spgid'    => $spgid,
										'a.custid'   => $custid,
										'a.month'	 => $month,
										'a.year'	 => $year,
										'b.location' => $location  ));
			}						  
							  
			$emp_data=$this->db->get()->result();
							  	
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->esicno);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->no_of_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->monthly_wages);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->emp_contri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->empr_contri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->reason_code);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->last_working_day);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->join_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->birth_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->vendor_id);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->contractor_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->location);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->month);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->year);
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->flag);
			//$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->created_at);
			
			$start_row++;
			//$comp_name=$key->entity_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="ESICTemplateEmpID.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export ESIC Summary report */
	public function ESICSummary($spgid,$custid,$month,$year,$check)
	{
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				

		$table_cols = array("Total IP Contribution","Total Employer Contribution","Grand Total Employee & Employer Contribution","Total Central Government Contribution","Total Wages");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

			$this->db->select("a.entity_name,CAST(sum((a.monthly_wages*(1.75/100))) as UNSIGNED) as eps_contri,CAST(sum((a.monthly_wages)*4.75/100) as UNSIGNED) as total_contri,CAST(((sum((a.monthly_wages*(1.75/100))))+(sum((a.monthly_wages)*4.75/100))) as UNSIGNED) as grand,if(monthly_wages!=NULL,`monthly_wages`,'-') as tcgc,sum(a.monthly_wages) as gross_wages");
			if($check=='old')
			{
				$this->db->from('esic_template_history a');
			}
			else
			{
				$this->db->from('esic_template a');
			}
				$this->db->join('employee_master_new b', 'a.empid=b.emp_id AND a.custid=b.custid');
						
				$this->db->where(array(	'a.spgid' => $spgid,
										'a.custid' => $custid,
										'a.month'	 => $month,
										'a.year'	 => $year,
										'b.esic_deduct'=>'Yes'   ))	;				  
							
		$emp_data=$this->db->get()->result();							  	
							 
		$start_row = 2;
		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->eps_contri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->total_contri);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->grand);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->tcgc);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->gross_wages);
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'ESICSummary.xlsx"');
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

	/* export MissingUAN report */
	public function MissingUAN($spgid,$custid)
	{
		//echo "hello";
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);		 	 				


		$table_cols = array("Entity Name","Entity Code","Employee Name","Employee Code","Gender","Marital Status","PF Deduction","Upper Limit","ESIC Deduction","Existing ESIC No."," Existing UAN No","Branch","Department","Designation","Father/Husband Name","Relation DOB","Relation Adhar No","Relation Name","Relation Age","Nomination 1","Nomination 2","Nomination 3","Nomination 4","Email","Phone","Permanent Address","Temporary Address","Pan No","Name as per Pan Card","Aadhar No","Name as per Adhar Card","Bank A/c No","IFSC Code","Bank Name","Bank Branch","DOB as per Adhar Card","Education Qualifications","Employee Status","Physically Handicap","Physically Handicap Category","Birth Date","Joining Date","Membership Date","Existing Date","International Worker","Vendor ID","Contractor Name","Location");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->db->select("entity_name,custid,emp_name,emp_id,gender,marital_status,pf_deduct,ul_pf,esic_deduct,esic_no,uan_no,branch,dept,designation,fath_hus_name,reldob,reladhr,relname,relage,nom1,nom2,nom3,nom4,email,mob,per_address,temp_address,pan,namepan,adhaar,nameadhr,bank_ac,ifsc,bank_name,bank_branch,dobadhr,education,emp_status,phy_handi,phy_handi_cat,birth_date,join_date,member_date,exit_date,int_worker,vendor_id,contractor_name,location")
							  ->from('employee_master_new')							  
							  ->where(array('spgid' =>$spgid,'custid' => $custid,'uan_no'=>'0','uan_no'=>' '))
							  ->get()
							  ->result();	
							 
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->entity_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->custid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->emp_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,$key->emp_id);			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->gender);			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->marital_status);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,$key->pf_deduct);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,$key->ul_pf);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,$key->esic_deduct);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,$key->esic_no);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,$key->uan_no);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,$key->branch);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,$key->dept);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,$key->designation);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,$key->fath_hus_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,$key->reldob);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,$key->reladhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,$key->relname);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(18,$start_row,$key->relage);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(19,$start_row,$key->nom1);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(20,$start_row,$key->nom2);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(21,$start_row,$key->nom3);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(22,$start_row,$key->nom4);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(23,$start_row,$key->email);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(24,$start_row,$key->mob);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(25,$start_row,$key->per_address);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(26,$start_row,$key->temp_address);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(27,$start_row,$key->pan);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(28,$start_row,$key->namepan);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(29,$start_row,$key->adhaar);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(30,$start_row,$key->nameadhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(31,$start_row,$key->bank_ac);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(32,$start_row,$key->ifsc);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(33,$start_row,$key->bank_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(34,$start_row,$key->bank_branch);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(35,$start_row,$key->dobadhr);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(36,$start_row,$key->education);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(37,$start_row,$key->emp_status);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(38,$start_row,$key->phy_handi);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(39,$start_row,$key->phy_handi_cat);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(40,$start_row,$key->birth_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(41,$start_row,$key->join_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(42,$start_row,$key->member_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(43,$start_row,$key->exit_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(44,$start_row,$key->int_worker);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(45,$start_row,$key->vendor_id);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(46,$start_row,$key->contractor_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(47,$start_row,$key->location);
						
			
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'PFnewJoinee.xlsx"');
		$obj_writer->save('php://output');
	}

	/* export FormQ report */
	public function FormQ($spgid,$custid,$month,$year,$location,$check)
	{
		//echo $check;
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);
		$table_cols = array("Emp_Id","Full Name of the worker","Designation of the worker and nature of work","Age","Sex","Date of entry into service","Working hours","","Interval for Rest","","Date of the Month","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","Total Days worked","Minimum rate of wages payable Rs.","Total production in case of piece rate Rs.","Actual Wages Paid Rs.","House Rent Allowance Paid Rs.","All others","Dearness Allowance Paid Rs.","Total hours of overtime worked during the month","Overtime earnings Rs.","Gross Amount Payable Rs.","Provident Fund Contribution Rs.","Family Pension / VPF Rs.","ESI Contribution Rs.","Professional Tax Rs.","Income Tax Rs. (if any)","Loan and Interest Rs.","Advances Rs.","Other Deductions Rs. (if any)","Total Deduction Rs.","Net Payable Rs.","Date of Payment","Bank Account Number of Worker","Cheque Number and date/ RTGS/NEFT transfer date","Amount Deposited Rs.","Signature / Thumb Impression of the worker(if required)");	
	
		// echo "\r\n";
		
		// $table_cols = array("","","","","","","","","","","","","","","","","","","","","","","","From","To","From","TO","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		
				$this->db->select("*");
				$this->db->from('employee_master_new a');

			if($check=='old'){
				//echo $check;
				$this->db->join('salary_master_history b', 'a.emp_id=b.empid AND a.custid=b.custid');
			}
			else{
				$this->db->join('salary_master b', 'a.emp_id=b.empid AND a.custid=b.custid');
			}						  
			if($location=="ALL"){
				$this->db->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year   ));
			}
			else{
				$this->db->where(array(	'a.spgid'    => $spgid,
									'a.custid'   => $custid,
									'b.month'	 => $month,
									'b.year'	 => $year,
									'a.location' => $location  ));
			} 
				$emp_data=$this->db->get()->result();
		
				
							  
							 
		$start_row = 2;

		foreach ($emp_data as $key) {

			$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$start_row,$key->empid);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$start_row,$key->emp_name);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(2,$start_row,$key->designation);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(3,$start_row,'');			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(4,$start_row,$key->gender);	
			$obj->getActiveSheet()->setCellValueByColumnAndRow(5,$start_row,$key->join_date);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(6,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(7,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(8,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(9,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(10,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(11,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(12,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(13,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(14,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(15,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(16,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(17,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(18,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(19,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(20,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(21,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(22,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(23,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(24,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(25,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(26,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(27,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(28,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(29,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(30,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(31,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(32,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(33,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(34,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(35,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(36,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(37,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(38,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(39,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(40,$start_row,'');
		    $obj->getActiveSheet()->setCellValueByColumnAndRow(41,$start_row,$key->paid_days);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(42,$start_row,$key->basic);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(43,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(44,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(45,$start_row,$key->HRA);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(46,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(47,$start_row,$key->DA);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(48,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(49,$start_row,$key->OT);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(50,$start_row,$key->monthly_gross);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(51,$start_row,$key->PF);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(52,$start_row,$key->VPF);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(53,$start_row,$key->PT);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(54,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(55,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(56,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(57,$start_row,$key->OD);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(58,$start_row,$key->total_deduction);
			$obj->getActiveSheet()->setCellValueByColumnAndRow(59,$start_row,$key->net_pay);			
			$obj->getActiveSheet()->setCellValueByColumnAndRow(60,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(61,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(62,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(63,$start_row,'');
			$obj->getActiveSheet()->setCellValueByColumnAndRow(64,$start_row,'');
			// $obj->getActiveSheet()->setCellValueByColumnAndRow(65,$start_row,'');
			// $obj->getActiveSheet()->setCellValueByColumnAndRow(66,$start_row,'');
						
			$start_row++;
			$comp_name=$key->entity_name;
			//echo $comp_name;
		}

		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'formq.xlsx"');
		$obj_writer->save('php://output');
	}
}