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

?>