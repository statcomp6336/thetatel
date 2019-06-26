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
$route['spg/inbox']			= 'spg/Spg/show_inbox';// display mail messages
$route['spg/company/registration']	= 'spg/Spg/company_registration_view';// display company registration view
$route['spg/company/save']			= 'spg/Spg/add_company';// display company registration view

/* work with act */
$route['spg/company/act']			= 'spg/Spg/act_view'; //display act view for company
$route['spg/company/attachAct']		= 'spg/Spg/attachAct'; //display act view for company
/* work with complince */
$route['spg/compliance/bulk-update']= 'spg/Spg/show_bulk_update'; //display bulk update view for company
$route['spg/compliance/bulk-compliance']= 'spg/Spg/show_bulk_compliance'; //display bulk compliance view for company
$route['spg/compliance/bulk-compliance/comment/(:any)/(:num)/(:any)']= 'spg/Spg/show_bulk_compliance'; //display bulk compliance view for company
$route['spg/compliance/bulk-compliance/update']= 'spg/Spg/edit_bulk_compliance'; //display bulk compliance view for company
$route['spg/compliance/bulk-approval']= 'spg/Spg/show_bulk_approval'; //display bulk approval view for company 
$route['spg/compliance/bulk-approval/comment/(:any)/(:num)/(:any)']= 'spg/Spg/show_bulk_approval'; //display bulk approval view for company 
$route['spg/compliance/bulk-approval/update']= 'spg/Spg/edit_bulk_approval'; //display bulk approval view for company 
$route['spg/compliance/bulk-timeline']= 'spg/Spg/show_bulk_timeline'; //display bulk timeline view for company
$route['spg/compliance/bulk-timeline/(:any)']= 'spg/Spg/show_timeline'; //display bulk timeline view for company

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

/*export PF new joinee report start*/
$route['spg/export/pfnewjoinee'] = 'spg/Spg/show_pf_newjoinee';
$route['spg/download/pfnewjoin/(:num)/(:num)']= 'spg/Spg/download_pfnewjoinee';

/*export PF Summary report start*/
$route['spg/export/pfsummary'] = 'spg/Spg/show_pf_summary';
$route['spg/download/pfsummary/(:num)/(:num)']= 'spg/Spg/download_pfsummary';

/*export esic new joinee report start*/
$route['spg/export/esicnewjoinee'] = 'spg/Spg/show_esic_newjoinee';
$route['spg/download/esicnewjoin/(:num)/(:num)']= 'spg/Spg/download_esicnewjoinee';

/*export esic Template report start*/
$route['spg/export/esictemplate'] = 'spg/Spg/show_esic_template';
$route['spg/download/esictemplate/(:num)/(:num)']= 'spg/Spg/download_esic_template';

/*export esic Template empid report start*/
$route['spg/export/esictemplateempid'] = 'spg/Spg/show_esic_template_empid';
$route['spg/download/esictemplateempid/(:num)/(:num)']= 'spg/Spg/download_esic_template_empid';

/*export esic Summary report start*/
$route['spg/export/esicsummary'] = 'spg/Spg/show_esic_summary';
$route['spg/download/esicsummary/(:num)/(:num)']= 'spg/Spg/download_esic_summary';

/*export compliance report start*/
$route['spg/export/compliance'] = 'spg/Spg/show_compliance';
$route['spg/download/compliance/(:num)/(:num)']= 'spg/Spg/download_compliance';

/*export non compliance report start*/
$route['spg/export/noncompliance'] = 'spg/Spg/show_noncompliance';
$route['spg/download/noncompliance/(:num)/(:num)']= 'spg/Spg/download_noncompliance';

/*export approval(current month(duedate) approved) report start*/
$route['spg/export/approval'] = 'spg/Spg/show_approval';

/*export Rejected report start*/
$route['spg/export/rejected'] = 'spg/Spg/show_rejected';

/*export Compliance Document report start*/
$route['spg/export/compliancedocument'] = 'spg/Spg/show_compliance_document';

/*export entity details(company registered details) report start*/
$route['spg/export/entitydetails'] = 'spg/Spg/show_entity_details';

/*export Employee Details report start*/
$route['spg/export/employeedetails'] = 'spg/Spg/show_employee_details';

/*export Compliance Request Details report start*/
$route['spg/export/compliancerequest'] = 'spg/Spg/Show_compliance_request_details';

/*export Salary Details report start*/
$route['spg/export/salarydetails'] = 'spg/Spg/show_salary_details';




/* work with users */
$route['spg/users']	= 'spg/Spg/show_user_list';//display salary file upload form
$route['spg/user/save']	= 'spg/Spg/create_user';//Save the user detailes in db
$route['spg/user/update']	= 'spg/Spg/edit_user';//Save the user detailes in db
$route['spg/user/remove/(:any)']	= 'spg/Spg/remove_user';//Save the user detailes in db

$route['spg/user/remove-companys/(:any)']	= 'spg/Spg/user_remove_companys';//Save the user detailes in db
$route['spg/user/get-companys/(:any)']	= 'spg/Spg/user_get_companys';//Save the user detailes in db
$route['spg/user/add-remove-comany']	= 'spg/Spg/user_AddRemove_companys';//Save the user detailes in db
$route['spg/user/reset-password']	= 'spg/Spg/reset_password';//Reset the password
$route['spg/user/company-access']	= 'spg/Spg/company_access';//Reset the password


/* work with users */
$route['spg/explore']	= 'spg/Spg/show_explore';//display salary file upload form
$route['spg/share-files']	= 'spg/Spg/show_explore';//display salary file upload form
$route['spg/explore/companies/(:num)']	= 'spg/Spg/show_companiesExplore';//display companies for explore view  
$route['spg/share-files/companies/(:num)']	= 'spg/Spg/show_companiesExplore';//display companies for explore view  
$route['spg/explore/companies/(:num)/(:any)']	= 'spg/Spg/show_companiesActExplore';//display companies for explore view 


