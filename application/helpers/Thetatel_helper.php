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
?>