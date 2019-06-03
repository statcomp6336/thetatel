<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
require_once APPPATH."core\Base_model.php";
class DB_install extends Base_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->newdb=$this->load->database('db1',TRUE);
		 $this->load->dbforge($this->newdb);

	}	

	public function CreateTable_customer_master()
	{
		 $fields = array(
            		'cust_id' 		=> array(
					                    'type' => 'INT',					                 
					                    'auto_increment' => TRUE
							            ),
		            'custtype'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '2'					                    
							            ),
		            'custid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '13',
					                    'unique' => TRUE					                    
							            ),
		            'allianceid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'					                    
							            ),
		            'entity_pan'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '10'					                    
							            ),
		            'entity_name'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'address'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '400'					                    
							            ),
		            'landmark'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'entity_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'pin'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '6'					                    
							            ),
		            'ph_no'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '30'					                    
							            ),
		            'res_person'=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'res_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'res_ph'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '30'					                    
							            ),
		            'hr_person'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'hr_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'hr_ph'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'vp_person'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'vp_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'vp_ph'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),


		            'dh_person'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_ph'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_mgr'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'mgr_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'mgr_ph'=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_vp'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_vp_email'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'dh_vp_ph'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'enable'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '5'					                    
							            ),
		            'branch_code'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '4'					                    
							            ),
		            'spgid'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'state'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            // 'dat'		=> array(		
					         //            'type' 	=>'TIMESTAMP',
					         //           	'default' => 'CURRENT_TIMESTAMP'					                   			                    
							       //      )
		             'dat TIMESTAMP DEFAULT CURRENT_TIMESTAMP'

    );
    $this->dbforge->add_key('cust_id', TRUE);
    $this->dbforge->add_field($fields);
    return $this->dbforge->create_table('customer_master',TRUE);
	}
	public function DropTable_customer_master()
	{
		$this->dbforge->drop_table('customer_master');
	}

	public function CreateTable_custid_backup($value='')
	{
		 $fields = array(
            		'SrNo' 		=> array(
					                    'type' => 'INT',					                 
					                    'auto_increment' => TRUE
							            ),
		            'custtype'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '2'					                    
							            ),
		            'custid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '13',
					                    'unique' => TRUE					                    
							            ),
		            'allianceid'	=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'					                    
							            ),
		            'entity_name'	=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'entity_email'	=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'pin'			=> array(
		            					'type' =>'INT',
					                    'constraint' => '11'		            						
		            		            ),
		            'ph_no'			=> array(
		            					'type' =>'VARCHAR',
					                    'constraint' => '20'	
		            						),
		             'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		            		);
	$this->dbforge->add_key('SrNo', TRUE);
    $this->dbforge->add_field($fields);
    return $this->dbforge->create_table('custid_backup',TRUE);
		
	}
	public function DropTable_custid_backup()
	{
		$this->dbforge->drop_table('custid_backup');
	}


	public function CreateTable_act_particular()
	{
		$fields = array(
            		'srno' 			=> array(
					                    'type' => 'INT',					                 
					                    'auto_increment' => TRUE
							            ),
		            'act_code'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '6'					                    
							            ),
		            'act'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '105'
					                    			                    
							            ),
		            'pcr_code'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '6',
					                    'unique' => TRUE							                    
							            ),
		            'Paritcular'	=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            'shortname'	   	=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '60'					                    
							            ),
		            'act_type'			=> array(
		            					'type' =>'VARCHAR',
					                    'constraint' => '50'		            						
		            		            ),
		            'freq'			=> array(
		            					'type' =>'VARCHAR',
					                    'constraint' => '12'	
		            						),
		            'weight'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '1'					                    
							            ),
		            'obligantion'	=> array(
		            					'type' =>'VARCHAR',
					                    'constraint' => '241'		            						
		            		            ),
		            'due_date'		=> array(
		            					'type' =>'DATE',					                   	
		            						),
		            'stat_date'	=> array(
		            					'type' =>'DATE',                               						
		            		            ),
		            'comp_req'		=> array(
		            					'type' =>'VARCHAR',
					                    'constraint' => '10'	
		            						),
		             'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		            		);
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('act_particular',TRUE);
	}
	public function DropTable_act_particular()
	{
		$this->dbforge->drop_table('act_particular');
	}


	public function CreateTable_act_applicable_to_customer()
	{
		$fields = array(
            		'srno' 			=> array(
					                    'type' => 'INT',					                 
					                    'auto_increment' => TRUE
							            ),
		            'custid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'					                    
							            ),
		            'name'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '50'
					                    			                    
							            ),
		            'act_code'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '11'
					                						                    
							            ),
		            'spgid'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),
		            
		             'date TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		            		);
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('act_applicable_to_customer',TRUE);
	}
	public function DropTable_act_applicable_to_customer()
	{
		$this->dbforge->drop_table('act_applicable_to_customer');
	}

	public function CreateTable_compliance_scope()
	{
		$fields = array(
            		'srno' 			=> array(
					                    'type' => 'INT',					                 
					                    'auto_increment' => TRUE
							            ),
		            'custid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'					                    
							            ),
		            'spg_id'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'
					                    			                    
							            ),
		            'act_code'		=> array(
					                    'type' =>'INT',
					                    'constraint' => '11'
					                						                    
							            ),
		            'act'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'					                    
							            ),

		            // 
		            'Particular' 	=> array(
					                    'type' => 'TEXT'
					                    
							            ),
		            'year'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '10'					                    
							            ),
		            'Reg_freq'		=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '200'
					                    			                    
							            ),
		            'due_date'		=> array(
					                    'type' =>'DATE'     						                    
							            ),
		            'Statutory_due_date'=> array(
					                    'type' =>'DATE'                   				                    
							            ),
		            //
		            'doc_req' 			=> array(
					                    'type' => 'VARCHAR',					                 
					                    'constraint' => '100'
							            ),
		            'Application_date'	=> array(
					                    'type' =>'DATETIME'
					                   				                    
							            ),
		            'Certi_rece_date'	=> array(
					                    'type' =>'DATETIME'                    			                    
							            ),
		            'Valid_upto'		=> array(
					                    'type' =>'DATE'
					                						                    
							            ),
		            'Renewal_date'		=> array(
					                    'type' =>'DATE'					                    
							            ),

		            // 
		            'Issuing_authority' => array(
					                   'type' =>'TEXT'
							            ),
		            'Copy_of_docu'		=> array(
					                    'type' =>'TEXT'					                    
							            ),
		            'Resp_prsn_frm_client'	=> array(
					                    'type' =>'TEXT'
					                    			                    
							            ),
		            'Resp_prsn'			=> array(
					                    'type' =>'TEXT'
					                						                    
							            ),
		            'Remarks'			=> array(
					                    'type' =>'TEXT'				                    
							            ),
		            //
		            'Data_recev_frm_client' => array(
					                   'type' =>'TEXT'
							            ),
		            'Task_complitn_date'=> array(
					                    'type' =>'DATE'					                    
							            ),
		            'Retrn/Chanllan_genrtn_date'=> array(
					                   'type' =>'DATE'		
					                    			                    
							            ),
		            'Submisn/Pay_date'	=> array(
					                    'type' =>'DATE'		
					                						                    
							            ),
		            'Docu_submit_to_GOVT_in_nos'=> array(
					                    'type' =>'INT',
					                    'constraint' => '10'					                    
							            ),

		            // 
		            'Pend_docu_in_nos' 	=> array(
					                   'type' =>'INT',
					                    'constraint' => '10'
							            ),
		            'status'			=> array(
					                    'type' =>'INT',
					                    'constraint' => '10'					                    
							            ),
		            'act_type'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '300'
					                    			                    
							            ),
		            'approval'			=> array(
					                    'type' =>'INT',
					                    'constraint' => '11'
					                						                    
							            ),
		            'Applicable_date'	=> array(
					                    'type' =>'DATETIME'					                    
							            ),
		            //
		           
		            'registration_no'	=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'					                    
							            ),
		            'pcr_code'			=> array(
					                    'type' =>'INT',
					                    'constraint' => '6'
					                    			                    
							            ),
		            
		            // 
		             'date TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		            		);
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('compliance_scope',TRUE);
	}
	public function DropTable_compliance_scope()
	{
		$this->dbforge->drop_table('compliance_scope');
	}

	public function CreateTable_employee_master_new()
	{
		$fields = array(
            		'srno' 			=> array(
					                    'type' => 'INT',                 
					                    'auto_increment' => TRUE
							            ),
		            'spgid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '12'					                    
							            ),
		            'custid'		=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'
					                    			                    
							            ),
		            'entity_name'		=> array(
					                    'type' =>'TEXT'
					                						                    
							            ),
		            'emp_name'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'emp_id'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '100'                  
							            ),
		            'gender'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'pf_deduct'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'ul_pf'			=> array(
					                    'type' =>'INT',
					                    'constraint' => '7'                  
							            ),
		            'esic_deduct'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'esic_no'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'uan_no'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '12'                  
							            ),
		            'brnach'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'dept'			=> array(
					                    'type' =>'TEXT'                
							            ),
		            'designation'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '300'                  
							            ),
		            'fath_hus_name'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'nom1'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'nom2'			=> array(
					                    'type' =>'TEXT'                
							            ),
		            'nom3'			=> array(
					                   'type' =>'TEXT'                
							            ),
		            'nom4'			=> array(
					                   'type' =>'TEXT'             
							            ),
		            'email'			=> array(
					                   'type' =>'TEXT'                  
							            ),
		            'mob'			=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'                  
							            ),
		            'per_address'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'temp_address'			=> array(
					                    'type' =>'TEXT'                
							            ),
		            'pan'			=> array(
					                   'type' =>'TEXT'                
							            ),
		            'adhaar'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '20'                  
							            ),
		            'bank_ac'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'ifsc'			=> array(
					                   'type' =>'TEXT'                  
							            ),
		            'bank_name'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'bank_branch'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'education'			=> array(
					                   'type' =>'TEXT'                  
							            ),
		            'phy_handi'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'phy_handi_cat'			=> array(
					                   'type' =>'TEXT'                
							            ),
		            'marital_status'			=> array(
					                    'type' =>'TEXT'         
							            ),
		            'emp_status'			=> array(
					                   'type' =>'TEXT'                 
							            ),
		            'birth_date'			=> array(
					                    'type' =>'DATE'                  
							            ),
		            'join_date'			=> array(
					                    'type' =>'DATE'                 
							            ),
		            'member_date'			=> array(
					                    'type' =>'DATE'

							            ),
		            'exit_date'			=> array(
					                    'type' =>'DATE'                
							            ),
		            'int_worker'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'reldob'			=> array(
					                    'type' =>'DATE'               
							            ),
		            'reladhr'			=> array(
					                    'type' =>'BIGINT',
					                    'constraint' => '20'                  
							            ),
		            'relname'			=> array(
					                    'type' =>'TEXT'               
							            ),
		            'relage'			=> array(
					                    'type' =>'INT',
					                    'constraint' => '11'                  
							            ),
		            'namepan'			=> array(
					                   'type' =>'TEXT'                  
							            ),
		            'nameadhr'			=> array(
					                    'type' =>'TEXT'                  
							            ),
		            'nameinbank'			=> array(
					                    'type' =>'TEXT'                 
							            ),
		            'dobadhr'			=> array(
					                   'type' =>'DATE'                 
							            ),
		            'vendor_id'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '20'                  
							            ),
		            'contractor_name'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '30'                  
							            ),
		            'location'			=> array(
					                    'type' =>'VARCHAR',
					                    'constraint' => '50'                  
							            ),

		            'date TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		        );
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('employee_master_new',TRUE);
	}

	public function DropTable_employee_master_new()
	{
		$this->dbforge->drop_table('employee_master_new');
	}

	public function CreateTable_salary_master()
	{
		$fields = array(
	'srno' 			=> array(
	                    'type' => 'INT',                 
	                    'auto_increment' => TRUE
			            ),
    'spgid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'					                    
			            ),
    'custid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'
	                    			                    
			            ),
    'entity_name'		=> array(
	                    'type' =>'TEXT'
	                						                    
			            ),
    'empid'			=> array(
	                    'type' =>'TEXT'                  
			            ),
    'pfno'			=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'                  
			            ),
    'esicno'			=> array(
	                     'type' =>'VARCHAR',
	                    'constraint' => '20'            
			            ),
    'name'			=> array(
	                     'type' =>'VARCHAR',
	                    'constraint' => '50'          
			            ),
    'Month_days'			=> array(
	                    'type' =>'INT',
	                    'constraint' => '11'                  
			            ),
    'paid_days'			=> array(
	                     'type' =>'VARCHAR',
	                    'constraint' => '20'                
			            ),
    'fixgross'			=> array(
	                     'type' =>'VARCHAR',
	                    'constraint' => '20'               
			            ),
    'basic'			=> array(
	                  'type' =>'TEXT'                 
			            ),
    'DA'			=> array(
	                    'type' =>'TEXT'                 
			            ),
    'HRA'			=> array(
	                    'type' =>'TEXT'                
			            ),
    'CA'			=> array(
	                    'type' =>'TEXT'               
			            ),
    'CCA'			=> array(
	                    'type' =>'TEXT'                 
			            ),
    'EA'			=> array(
	                    'type' =>'TEXT'                  
			            ),
    'Other_reimb'			=> array(
	                    'type' =>'TEXT'                
			            ),
    'OA'			=> array(
	                   'type' =>'TEXT'                
			            ),
    'OT'			=> array(
	                   'type' =>'TEXT'             
			            ),
    'WA'			=> array(
	                   'type' =>'TEXT'                  
			            ),
    'LTA'			=> array(
	                    'type' =>'TEXT'                 
			            ),
    'monthly_gross'			=> array(
	                    'type' =>'TEXT'                  
			            ),
    'PF'			=> array(
	                    'type' =>'TEXT'                
			            ),
    'VPF'			=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'                
			            ),
    'ESIC'			=> array(
	                     'type' =>'TEXT'                    
			            ),
    'PT'			=> array(
	                    'type' =>'TEXT'                  
			            ),
    'IT'			=> array(
	                   'type' =>'INT',
	                    'constraint' => '20'                  
			            ),
    'LWF'			=> array(
	                   'type' =>'INT',
	                    'constraint' => '20'                  
			            ),
    'OD'			=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'                  
			            ),
    'net_pay'			=> array(
	                   'type' =>'INT',
	                    'constraint' => '20'                 
			            ),
    'paymentmode'			=> array(
	                   'type' =>'VARCHAR',
	                    'constraint' => '20'                
			            ),
    'year'			=> array(
	                  'type' =>'VARCHAR',
	                    'constraint' => '20'                   
			            ),
    'month'			=> array(
	                   'type' =>'VARCHAR',
	                    'constraint' => '20'         
			            ),
    'epf_wages'			=> array(
	                   'type' =>'VARCHAR',
	                    'constraint' => '20'                    
			            ),
    'total_deduction'			=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'                     
			            ),
  
    

		            'present_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		        );
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('salary_master',TRUE);
	}

	public function DropTable_salary_master()
	{
		$this->dbforge->drop_table('salary_master');
	}

	public function CreateTable_master_process()
	{
		$fields = array(
	'srno' 			=> array(
	                    'type' => 'INT',                 
	                    'auto_increment' => TRUE
			            ),
    'spgid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'					                    
			            ),
    'custid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'
	                    			                    
			            ),
    'entity_name'		=> array(
	                    'type' =>'TEXT'
	                						                    
			            ),
    'empid'			=> array(
	                    'type' =>'TEXT'                  
			            ),
	'month'		=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'            
			            ),
    'year'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ),			                

	'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		        );
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('master_process',TRUE);
	}

	public function DropTable_master_process()
	{
		$this->dbforge->drop_table('master_process');
	}

	public function CreateTable_backlog_process()
	{
		$fields = array(
	'srno' 			=> array(
	                    'type' => 'INT',                 
	                    'auto_increment' => TRUE
			            ),
    'spgid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'					                    
			            ),
    'custid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'
	                    			                    
			            ),
    'entity_name'		=> array(
	                    'type' =>'TEXT'
	                						                    
			            ),
    'empid'			=> array(
	                    'type' =>'TEXT'                  
			            ),
    'month'		=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'            
			            ),
    'year'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ), 
    'is_sal'			=> array(
	                    'type' =>'TEXT'                  
			            ), 


		            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		        );
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('backlog_process',TRUE);
	}

	public function DropTable_backlog_process()
	{
		$this->dbforge->drop_table('backlog_process');
	}

	public function CreateTable_pf_template()
	{
		$fields = array(
	'srno' 			=> array(
	                    'type' => 'INT',                 
	                    'auto_increment' => TRUE
			            ),
    'spgid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'					                    
			            ),
    'custid'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'
	                    			                    
			            ),
    'entity_name'		=> array(
	                    'type' =>'TEXT'
	                						                    
			            ),
    'empid'			=> array(
	                    'type' =>'TEXT'                  
			            ), 

    'UANno'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'member_name'		=> array(
	                    'type' =>'TEXT'
			            ),
    'gross_wages'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EPF_wages'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EPS_wages'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EDLI_wages'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EPF_contri_remitted'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EPS_contri_remitted'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'EPS_EPF_diff'		=> array(
	                    'type' =>'BIGINT',
	                    'constraint' => '20'            
			            ),
    'NCP_days'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ),
    'refund_advance'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ),
    'month'		=> array(
	                    'type' =>'VARCHAR',
	                    'constraint' => '20'            
			            ),
    'year'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ),
    'flag'		=> array(
	                    'type' =>'INT',
	                    'constraint' => '20'            
			            ),
    'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
		        );
		$this->dbforge->add_key('srno', TRUE);
	    $this->dbforge->add_field($fields);
	    return $this->dbforge->create_table('pf_template',TRUE);
	}

	public function DropTable_pf_template()
	{
		$this->dbforge->drop_table('pf_template');
	}


}	