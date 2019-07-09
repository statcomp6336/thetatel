  <?php defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH."controllers\Dashboard.php";
 require_once APPPATH."controllers\Notification.php";
 require_once APPPATH."controllers\Company_ext.php";
 require_once APPPATH."controllers\Act.php";
 require_once APPPATH."controllers\Employee.php";
 require_once APPPATH."controllers\Salary.php";
 require_once APPPATH."controllers\Reports.php";
 require_once APPPATH."controllers\Users.php";
 require_once APPPATH."controllers\Files.php";

class Base_controller extends CI_Controller
{
  protected $data = array();
  // protected $page = array();
  function __construct()
  {
    parent::__construct();
   // $this->load->model('Employee_model','emp');
    $this->data['page_title'] = 'Complaincetrack';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
    $this->data['msg'] ='';
    define('USERNAME', username());
    define('IS_SPG', $this->is_spg());
    define('IS_COMPANY', $this->is_company());
    define('IS_SPGUSER', $this->is_spg_user());
    define('IS_BRANCH', $this->is_branch());
    define('IS_CONTRACTOR', $this->is_contractor());
    define('IS_SUBCONTRACTOR', $this->is_sub_contractor());
   // $this->data['error_count'] = $this->emp->emp_error();
    $this->data['menu']=array(
      // dashbord access if true to dispaly and flase it hide
      "dashboard_access"    => FALSE,
      // notification access if true to dispaly and flase it hide
      "notification_access" => FALSE,//
      "setup"               =>FALSE,
      "company"             =>FALSE,
      "company_registration" =>FALSE,
      "branch_registration" =>FALSE,
      "contractor"          =>FALSE,
      "contractor_registration" =>FALSE,
      "sub_contractor_registration" =>FALSE,
      "acts"                =>FALSE,
      "create_act"          =>FALSE,
      "act_selection"       =>FALSE,
      "act_due_date"        =>FALSE,
      "my_activity"         =>FALSE,
      "employee"            =>FALSE,
      "employee_registration" =>FALSE,
      "salary"              =>FALSE,
      "pf"                  =>FALSE,
      "pf_new_joinee_report"=>FALSE,
      "pf_template"         =>FALSE,
      "pf_summary"          =>FALSE,

      "report_access"          =>FALSE,
      "salary_report"          =>FALSE,
      "compliance_report"      =>FALSE,
      "employee_info"      =>FALSE,
      "register_menu"      =>FALSE,
      "entity_report"      =>FALSE,
      "compliance_req"      =>FALSE,
      "user_info"      =>FALSE,

      "non_compliance_report"   =>FALSE,
      "compliance_doc"          =>FALSE,
      "emp_compliance"          =>FALSE,
      "compliance_reject"          =>FALSE,
      "approval_report"          =>FALSE,

      );

  }  

  protected function render($template = '')
  {
    $this->load->view('layout/header', $this->data);
       $this->load->view($template, $this->data);
        $this->load->view('layout/footer');
          
  }
  /* check is login or not */
   protected function is_login()// get the access level
  {
    if (!empty($this->session->SESS_CUST_ID) && $this->session->SESS_CUST_ID !== '') {
          return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
  

  /* ----- GET THE TYPE OF USER ----- */
  protected function user_type_is()// get the access level
  {
    if (!empty($this->session->TYPE) && $this->session->TYPE !== '') {
      return $this->session->TYPE;
    }
    else
    {
      return 0;
    }
  }

  /*----- check the role ----*/

  protected function is_spg()// check admin or not
  {
  	if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '9') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
  }
  protected function is_spg_user()// check spg user or not
  {
  	if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '5') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
  }
  protected function is_company() // check user or not
  {
  	if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '1') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
  }
   protected function is_branch()
   {
    if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '2') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
   }
   protected function is_contractor()
   {
    if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '3') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
   }
   protected function is_sub_contractor()
   {
    if ($this->is_login() == TRUE) {
        if ($this->user_type_is() == '4') {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    else
    {
      return FALSE;
    }
   }
  

}