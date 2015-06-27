<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

class Dispatcher_model extends MY_Crud{
	

	public function getAllUsers()
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM users WHERE 1 = %d ORDER BY id DESC', $parameter);
	
		return $this->executeQuery($sql);
	}
	
	public function getInfoUserById($user_id)
	{
		$parameter = 1;
		$sql = sprintf("SELECT * FROM users WHERE 1 = %d AND id = %d", $parameter, $user_id);
	
		return $this->executeQuery($sql);
	}
	
	public function getInfoUserByEmailPwd($email, $pwd)
	{
		$parameter = 1;
		$sql = sprintf("SELECT * FROM users WHERE 1 = %d AND email = '%s' AND pwd = '%s'", $parameter, $email, $pwd);

		return $this->executeQuery($sql);
	}
	
	public function addUser($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM users ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND email = '%s'";
		
		$sql = sprintf($sql, $parameter, $arr_data["email"]);
		
		//echo $sql;
		
		$result = $this->executeQuery($sql);
		
		if (count($result)==0)
		{
			$data = array(
				'email' => $arr_data["email"],
				'name' => $arr_data["name"],
				'last_name' => $arr_data["last_name"],
				'address1' => $arr_data["address1"],
				'address2' => $arr_data["address2"],
				'state' => $arr_data["state"],
				'colony' => $arr_data["colony"],
				'municipio' => $arr_data["municipio"],
				'postal_code' => $arr_data["postal_code"],
				'phone' => $arr_data["phone"],
				'mobile' => $arr_data["mobile"],
			);
			
			
			$this->setTable('users');
			$this->insert($data);
			
			return true;
		}
		
		return false;
	}
	
	public function updateUser($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM users ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
		
		$sql = sprintf($sql, $parameter, $arr_data["id"]);
		
		//echo $sql;
		
		$result = $this->executeQuery($sql);
		
		if (count($result)>0)
		{
			$data = array(
				'name' => $arr_data["name"],
				'last_name' => $arr_data["last_name"],
				'address1' => $arr_data["address1"],
				'address2' => $arr_data["address2"],
				'state' => $arr_data["state"],
				'colony' => $arr_data["colony"],
				'municipio' => $arr_data["municipio"],
				'postal_code' => $arr_data["postal_code"],
				'phone' => $arr_data["phone"],
				'mobile' => $arr_data["mobile"],
			);
			
			$this->db->where_in('id', $arr_data["id"]);
			$this->db->update('users', $data);
			
			return true;
		}
		
		return false;	
		
	}
	
	
	public function deleteUser($user_id)
	{
		$parameter = 1;
		$sql = "SELECT * FROM users ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
	
		$sql = sprintf($sql, $parameter, $arr_data["id"]);
	
		//echo $sql;
	
		$result = $this->executeQuery($sql);
	
		if (count($result)>0)
		{
				
			$this->db->where('id', $arr_data["id"]);
			$this->db->delete('users');
				
			return true;
		}
	
		return false;
	
	}
	
	
}