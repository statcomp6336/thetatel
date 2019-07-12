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
	
	
	protected function add($table,$data)
	{
		if($this->newdb->insert($table,$data)){
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	protected function add_batch($table, $data)
	{
		$insert = $this->newdb->insert_batch($table,$data);
        return $insert?TRUE:FALSE;

	}
	protected function edit($table,$where,$data)
	{
		$this->newdb->where($where);
 		if( $this->newdb->update($table,$data))
	      {
	        return TRUE;
	      }
	      else
	      {
	        return FALSE;
	      }
	}
	protected function get($table)
	{
		return $this->db->get($table);
	}
	protected function get_id($table,$get_id,$where)
	{
		$u = $this->newdb->select($get_id)->from($table)->where($where)->get();
		if ($u->num_rows() >0) {
			return $u->row();
		}
		else
		{
			return FALSE;
		}
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
	protected function remove($table,$where="")
	{
		if (!empty($where)) {
			return $this->newdb->delete($table,$where);
		}
		else
		{
			return $this->newdb->empty_table($table);
		}
		
	}
	protected function join($f_table,$s_table,$match,$select='',$where='',$id='' )
	{
		$select=!empty($select)?$select:'*';

			$this->newdb->select($select);
			$this->newdb->from($f_table);
		
		$this->newdb->join($s_table,$match);
		if (!empty($where)) {
			if (!empty($id)) {
					
			$this->newdb->where($where,$id);
			}else{
				$this->newdb->where($where);
			}		
		}
			return $query=$this->newdb->get();
	}
	protected function is_uniq($table,$arr)
	{
		$u = $this->newdb->select('*')->from($table)->where($arr)->get();
		if ($u->num_rows() > 0) {
			// echo " TRUE";
			// var_dump($u->result());
			return TRUE;
			// exit();
		}
		else
		{
			// echo "FALSE";
			// var_dump($u->result());
			return FALSE;

			// exit();
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