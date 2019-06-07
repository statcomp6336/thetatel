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

}