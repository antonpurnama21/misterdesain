<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_crud extends CI_Model {
/*
* @Function_name : getData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function getData($type = null, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null, $like = null)
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
		if ($data->num_rows() > 0)
		{
			return  ($type == 'result') ? $data->result() : $data->row();
		}else{
			return false;
		}
	}

/*
* @Function_name : insertData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function insertData($table,$data)
	{
		$data = $this->db->insert($table,$data);
		return $data;
	}

/*
* @Function_name : insert_batch
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function insertBatch($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}

/*
* @Function_name : updateData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function updateData($table,$data,$where)
	{
		foreach ($where as $key => $values) {
			$this->db->where($key, $values);
		}
		$data = $this->db->update($table,$data);
		return $data;
	}

/*
* @Function_name : deleteData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function deleteData($table,$where)
	{
		foreach ($where as $key => $values) {
			$this->db->where($key, $values);
		}
		$data = $this->db->delete($table);
		return $data;
	}

/*
* @Function_name : deleteAllData
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
	function delete_allData($table)
	{
		$delete = $this->db->truncate($table);
		if ($delete) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
//////////////////////////////////////

	/*Notifications Model*/
	public function notifications_user($id) {
		$sql = "SELECT `tbl_notes`.*,
		`tbl_users`.`full_name`, `image`
		FROM `tbl_notes` 
		LEFT JOIN `tbl_users` ON `tbl_notes`.`comment_id` = `tbl_users`.`id_user`
		WHERE `tbl_notes`.`id_user` = '$id' AND `notification_status` = 'unseen' AND `tbl_notes`.`comment_id` != '$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function getCount($table_name){
		return $this->db->count_all($table_name);
	}

	function getCount_byID($table_name, $where){
		foreach ($where as $key => $values) {
			$data = $this->db->where($key, $values);
		}
		$data = $this->db->get($table_name);
		return $data->num_rows();
		
	}

	function getCountData($type, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		if ($select != null) 
		{
			$data = $this->db->select($select);
		}

		if ($joins != null) 
		{	
			foreach($joins as $key => $values)
			{
				$data = $this->db->join($key, $values,'LEFT');
			}
		}

		if ($where != null)
		{	
			foreach ($where as $key => $values) {
				$data = $this->db->where($key, $values);
			}
		}

		if ($group != null)
		{	
			$data = $this->db->group_by($group);
		}

		if ($order != null)
		{	
			foreach($order as $key => $values){
				$data = $this->db->order_by($key, $values);
			}
		}

		if ($limit != null)
		{
			if ($offset != null)
			{
				$data = $this->db->limit($limit, $offset);
			}else{
				$data = $this->db->limit($limit);
			}	
		}

		if ($table != null) 
		{
			$data = $this->db->get($table);
		}
		
		return $data->num_rows();

	}

	function get_data_list($limit, $start, $table, $where = null){
		if ($where != null)
		{	
			foreach ($where as $key => $values) {
				$data = $this->db->where($key, $values);
			}
		}

		$data = $this->db->get($table, $limit, $start);
		
        return $data;
    }

}





/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */