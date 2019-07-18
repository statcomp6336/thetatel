<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 require_once APPPATH."core\Base_model.php";
class Eg_model extends Base_model
{
	function __construct()
	{
		parent::__construct();
		$this->newdb=$this->load->database('db1',TRUE);
			$this->load->library('Excel');

	}

	public function MissingUAN($spgid,$custid)
	{
		
		$obj = new PHPExcel();
		$obj->setActiveSheetIndex(0);
		$table_cols = array("Entity Name","Entity Code","Employee Name","Employee Code","Gender","Marital Status","PF Deduction","Upper Limit","ESIC Deduction","Existing ESIC No."," Existing UAN No","Branch","Department","Designation","Father/Husband Name","Relation DOB","Relation Adhar No","Relation Name","Relation Age","Nomination 1","Nomination 2","Nomination 3","Nomination 4","Email","Phone","Permanent Address","Temporary Address","Pan No","Name as per Pan Card","Aadhar No","Name as per Adhar Card","Bank A/c No","IFSC Code","Bank Name","Bank Branch","DOB as per Adhar Card","Education Qualifications","Employee Status","Physically Handicap","Physically Handicap Category","Birth Date","Joining Date","Membership Date","Existing Date","International Worker","Vendor ID","Contractor Name","Location");
		$col= 0;
		foreach ($table_cols as $k) {
			$obj->getActiveSheet()->setCellValueByColumnAndRow($col,1,$k);
			$col++;
		}

		$emp_data=$this->newdb->select("entity_name,custid,emp_name,emp_id,gender,marital_status,pf_deduct,ul_pf,esic_deduct,esic_no,uan_no,branch,dept,designation,fath_hus_name,reldob,reladhr,relname,relage,nom1,nom2,nom3,nom4,email,mob,per_address,temp_address,pan,namepan,adhaar,nameadhr,bank_ac,ifsc,bank_name,bank_branch,dobadhr,education,emp_status,phy_handi,phy_handi_cat,birth_date,join_date,member_date,exit_date,int_worker,vendor_id,contractor_name,location")
							  ->from('employee_master_new')							  
							  ->where(array('spgid' =>$spgid,'custid' => $custid,'uan_no'=>'N/A'))
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
			
		}
	ob_end_clean();
		$obj_writer = PHPExcel_IOFactory::createWriter($obj,'Excel2007');
	 	header("Content-Type: application/vnd.ms-excel");
	  header('Content-Disposition: attachment;filename="'.$comp_name.'-MissingUan.xlsx"');
		$obj_writer->save('php://output');
	}
}	