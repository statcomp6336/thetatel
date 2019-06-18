<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// ------------------------------------------------------------------------
if (! function_exists('show_msg')) {
	# code...
	function show_msg()
	  {
	  	$CI =& get_instance();
	      return $CI->session->flashdata('msg');
	  } 
}
// ------------------------------------------------------------------------
if (! function_exists('put_msg')) {
	# code...
	function put_msg($msg)
	  {
	  	$CI =& get_instance();
	      return $CI->session->set_flashdata('msg',$msg);
	  } 
}
// ------------------------------------------------------------------------
if (! function_exists('user_id')) {
	# code...
	function user_id()
	  {
	  	$CI =& get_instance();
	      return $CI->session->SESS_CUST_ID;
	  } 
}
// ------------------------------------------------------------------------

if (! function_exists('goto_back')) {
	# code...
	function goto_back()
	  {	  	
	    echo "<script> window.history.back(); </script>";
	  } 
}
// ------------------------------------------------------------------------


if (! function_exists('is')) {
	# code...
	function is($value,$val="")
	  {	 
	  	$val=!empty($val)?$val:" "; 	
	    $i=!empty($value)?$value:$val;
		return $i;
	  } 
}
// ------------------------------------------------------------------------
if (! function_exists('this_month')) {
	
	function this_month($month,$year='')
	{	  	
	    $year=!empty($year)?$year:date('Y');
	    if (strtotime($month." ".$year) == strtotime(date('M Y'))) {
	    	return TRUE;
	    }
	    else
	    {
	    	return FALSE;
	    }
		
	} 
}

	// ------------------------------------------------------------------------
if (! function_exists('is_last_month')) {
	
	function is_last_month($month,$year='')
	{	  	
	   //$ab = date_default_timezone_get(); 
			//date_default_timezone_set($ab);
			date_default_timezone_set("Asia/Kolkata");
		$lastyear=!empty($year)?$year:date('Y'); 
		$currmonth=date("M");//Janaury
		$lastmonth=Date('M', strtotime($currmonth . " last month"));//Janaury
			if (strtotime($lastmonth." ".date('Y')) == strtotime($month." ".$lastyear)) {
	    		return TRUE;
		    }
		    else
		    {
		    	return FALSE;
		    }
		
	} 
}
// ------------------------------------------------------------------------
	if (! function_exists('before_months')) {
	
	function before_months($month,$year='')
	{	  	
	   //$ab = date_default_timezone_get(); 
			//date_default_timezone_set($ab);
		date_default_timezone_set("Asia/Kolkata");
			$a= 12 - date('m');
		$byear=!empty($year)?$year:date('Y');
		for ($i = 1; $i <= $a; $i++) 
		{
		   $months = date("M", strtotime( date( 'M' )." +$i months"));
		   if (strtotime($months." ".date('Y')) == strtotime($month." ".$byear)) {
	    		$a = TRUE;	    		
		    }
		    else
		    {
		    	$a = FALSE;
		    }
		    if ($a == TRUE) {
		    	return TRUE;
		    	break;
		    }		   
		}		
		
	} 
}
// ------------------------------------------------------------------------


?>