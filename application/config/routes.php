<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*spg role controller*/
//dashboard
$route['install']					='spg/Spg/CREATE_SYSTEM';
$route['destroy']					='spg/Spg/DESTROY_SYSTEM';
$route['spg'] 						= 'spg/Spg';
$route['spg/logout'] 				= 'spg/Spg/logout';// logout and redirect to login page
$route['spg/notification']			= 'spg/Spg/notification_view';// display notification
$route['spg/company/registration']	= 'spg/Spg/company_registration_view';// display company registration view
$route['spg/company/save']			= 'spg/Spg/add_company';// display company registration view

/* work with act */
$route['spg/company/act']			= 'spg/Spg/act_view'; //display act view for company
$route['spg/company/attachAct']		= 'spg/Spg/attachAct'; //display act view for company
/* work with complince */
$route['spg/compliance/bulk-update']= 'spg/Spg/show_bulk_update'; //display bulk update view for company
$route['spg/compliance/bulk-compliance']= 'spg/Spg/show_bulk_compliance'; //display bulk compliance view for company
$route['spg/compliance/bulk-compliance/update']= 'spg/Spg/edit_bulk_compliance'; //display bulk compliance view for company
$route['spg/compliance/bulk-approval']= 'spg/Spg/show_bulk_approval'; //display bulk approval view for company 
$route['spg/compliance/bulk-approval/update']= 'spg/Spg/edit_bulk_approval'; //display bulk approval view for company 
$route['spg/compliance/bulk-timeline']= 'spg/Spg/show_bulk_timeline'; //display bulk timeline view for company

/* create acts*/
$route['spg/act/create']		= 'spg/Spg/create_Act'; // display register act form
$route['spg/act/save']			= 'spg/Spg/save_Act'; // insert act to database

/* work with Employee*/
$route['spg/employee/create']		= 'spg/Spg/view_employee_form'; // show Employee master form
$route['spg/employee/save']			= 'spg/Spg/save_employee'; // insert Employee master form
$route['spg/employee/show']			= 'spg/Spg/view_employee_master'; // show Employee master table
$route['spg/employee/show/(:num)']	= 'spg/Spg/view_employee_master'; // show Employee master table
$route['spg/employee/missing-uan']	= 'spg/Spg/view_missing_uan'; // show Employee master table


/* work with salary*/
$route['spg/salary/import']	= 'spg/Spg/import_salary';//display salary file upload form


/* work with Reports */
$route['spg/report/sanitize']			= 'spg/Spg/genrate_santize_rec';//display sanitize report
$route['spg/report/sanitize/genrate']	= 'spg/Spg/sanitize_process';//genrate santizing report
$route['spg/report/process']			= 'spg/Spg/genrate_process_report';//display process table data for pf
$route['spg/report/proccess/genrate/pf/(:num)/(:num)']	= 'spg/Spg/process_for_pf';//display process table data for pf
$route['spg/report/proccess/genrate/esic/(:num)/(:num)']	= 'spg/Spg/process_for_esic';//display process table data for esic
$route['spg/report/backlog']	= 'spg/Spg/genrate_backloag_report';//display backlog table data 
$route['spg/report/backlog/employee/edit/(:num)/(:num)']	= 'spg/Spg/edit_backlog_emp';//display backlog table data  edit and correct
$route['spg/report/backlog/salary/edit/(:num)/(:num)']	= 'spg/Spg/edit_backlog_sal';//display backlog table data  edit and correct

/*export report start*/
$route['spg/export/pf'] = 'spg/Spg/show_company_pf';
$route['spg/download/pf/(:num)/(:num)'] = 'spg/Spg/download_pf';
/* export missing uan no*/
$route['spg/export/missing-uan'] = 'spg/Spg/show_missing_uan';


/* work with users */
$route['spg/users']	= 'spg/Spg/show_user_list';//display salary file upload form



/* work with users */
$route['spg/explore']	= 'spg/Spg/show_explore';//display salary file upload form




