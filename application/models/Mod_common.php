<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_common extends CI_Model {

/*
* @Function_name : countData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function countData($type = null, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null, $like = null)
	{
		$command = "SELECT $select FROM $table";
	 	if ($joins != null)
			{	
				foreach($joins as $key => $values)
				{
					$command .= " LEFT JOIN $key ON $values ";
				}
			}
			
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}

		if ($like != null AND $where == null)
			{
				$command .= ' WHERE '.$like;
			}elseif ($like != null AND $where != null) {
				$command .= ' AND '.'('.$like.')';
			}

		if ($group != null)
			{	
				$command .= ' GROUP BY '.implode(', ',$group);
			}

		if ($order != null)
			{	
				$command .= ' ORDER BY '.implode(', ',$order);
			}
		if ($limit != null)
			{
				if ($offset != null)
					{
						$command .= " LIMIT $offset, $limit";
					}else{
						$command .= " LIMIT $limit";
					}	
			}
		$data = $this->db->query($command);
		return $data->num_rows();
	}

/*
* @Function_name : qry
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function qry($type = null, $command)
	{
		$data = $this->db->query($command);
		if ($type != null)
		{
			if ($type == 'bool') {
				return $data;
			}else{
				return ($type == 'result') ? $data->result() : $data->row();
			}
		}else{
			if ($data->num_rows() > 0)
			{
				return true;
			}else{
				return false;
			}
		}
	}

/*
* @Function_name : query
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function query($command)
	{
		$data = $this->db->query($command);
		return $data;
	}

/*
* @Function_name : query_non
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function query_non($command)
	{
		$data = $this->db->query($command);
		return false;
	}
	
/*
* @Function_name : checkData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function checkData($row, $table, $where)
	{
		$command = "SELECT $row FROM $table";
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}
		
		$data = $this->db->query($command);
		if ($data->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}

	}

/*
* @Function_name : autoNumber
* @Return_type : autoIncrement
* @Author : Anton Purnama /082118115288
*/
	function autoNumber($field, $table, $format, $digit)
	{
		$qry = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS KodeAkhir FROM $table WHERE $field LIKE '$format%'");
		if ($qry->num_rows() > 0){
			$nextCode = $qry->row('KodeAkhir') + 1;
		}else{
			$nextcode = 1;
		}
		$kode = $format.sprintf("%0".$digit."s", $nextCode);
		return $kode;
	}

/*
* @Function_name : get_table_list
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function get_table_list(){
		$table = $this->db->list_tables();
		$table_list = array();
		$x=0;
		foreach($table as $val){
			$ex = explode('_',$val);
			if($ex[0] <> 'sysx' ){
				$table_list[$x] = $val;
				$x++;
			}
		}
		return $table_list;
	}

/*
* @Function_name : query_field_data
* @Return_type : Date
* @Author : Anton Purnama /082118115288
*/
	function query_field_data($select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null, $like = null)
	{
		$command = "SELECT $select FROM $table";
	 	if ($joins != null)
			{	
				foreach($joins as $key => $values)
				{
					$command .= " LEFT JOIN $key ON $values ";
				}
			}
			
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}

		if ($like != null AND $where == null)
			{
				$command .= ' WHERE '.$like;
			}elseif ($like != null AND $where != null) {
				$command .= ' AND '.'('.$like.')';
			}

		if ($group != null)
			{	
				$command .= ' GROUP BY '.implode(', ',$group);
			}

		if ($order != null)
			{	
				$command .= ' ORDER BY '.implode(', ',$order);
			}
		if ($limit != null)
			{
				if ($offset != null)
					{
						$command .= " LIMIT $offset, $limit";
					}else{
						$command .= " LIMIT $limit";
					}	
			}
		$data = $this->db->query($command);
		return $data->field_data();
	}
	
/*
* @Function_name : get_field_data
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function get_field_data($table_name){
		return $this->db->field_data($table_name);
	}

/*
* @Function_name : create_field_user_input
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function create_field_user_input($table_name){
		$this->load->dbforge();
		if (!$this->db->field_exists('user_input', $table_name)){
				$fields = array( 'user_input' => array('type' => 'INT'));
				$this->dbforge->add_column($table_name, $fields);
		}
		
	}

/*
* @Function_name : get_count
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function get_count($table_name){
      return $this->db->count_all($table_name);
	}

/*
* @Function_name : qry_session
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function qry_session(){
		$query=$this->db->query('SET SESSION sql_mode = ""');
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_common.php */