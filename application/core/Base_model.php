<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */

class Base_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->newdb=$this->load->database('db1',TRUE);
	}
	protected function add()
	{

	}
	protected function edit($value='')
	{
		# code...
	}
	protected function get($table)
	{
		return $this->db->get($table);
	}
	protected function get_id()
	{

	}
	protected function getby_id($table,$select,$where)
	{
		$this->db->select($select);
		$this->db->where($where);
		$query=$this->db->get($table);
		return $query;

	}
	protected function remove()
	{

	}
	protected function join($f_table,$s_table,$match,$select='',$where='',$id )
	{
		$select=!empty($select)?$select:'*';

			$this->db->select($select);
			$this->db->from($f_table);
		
		$this->db->join($s_table,$match);
		if (!empty($where)) {			
			$this->db->where($where,$id);
		}
			return $query=$this->db->get();
	}


	/*SELECT act,act_code, IF(EXISTS(
             SELECT *
             FROM act_applicable_to_customer
             WHERE `custid` =  '14000590001'), 'true','false') AS is_act
FROM act_particular*/
	
}