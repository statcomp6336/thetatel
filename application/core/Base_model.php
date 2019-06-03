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
	protected function fetch($table,$select,$where)
	{
		$this->newdb->select($select);
		$this->newdb->where($where);
		$query=$this->newdb->get($table);
		return $query;

	}
	protected function remove($table,$where)
	{
		return $this->newdb->delete($table,$where);
	}
	protected function join($f_table,$s_table,$match,$select='',$where='',$id='' )
	{
		$select=!empty($select)?$select:'*';

			$this->db->select($select);
			$this->db->from($f_table);
		
		$this->db->join($s_table,$match);
		if (!empty($where)) {
			if (!empty($id)) {
					
			$this->db->where($where,$id);
			}else{
				$this->db->where($where);
			}		
		}
			return $query=$this->db->get();
	}
	protected function is_uniq($table,$arr)
	{
		$u = $this->db->select('*')->from($table)->where($arr)->get()->num_rows();
		if ($u>0) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	protected function is_exist($table,$arr)
	{
		$u = $this->newdb->select('*')->from($table)->where($arr)->get()->num_rows();
		if ($u>0) {
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}



	/*SELECT act,act_code, IF(EXISTS(
             SELECT *
             FROM act_applicable_to_customer
             WHERE `custid` =  '14000590001'), 'true','false') AS is_act
FROM act_particular*/
	
}