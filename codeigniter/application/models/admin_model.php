<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

class Admin_model extends MY_Crud{
	

	
	
	public function getInfoAdmin($email, $pwd)
	{
		$parameter = 1;
		$sql = sprintf("SELECT * FROM admins WHERE 1 = %d AND username = '%s' AND pwd = '%s'", $parameter, $email, $pwd);
	
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
	
	public function getAllProjectsPhotos($project_id)
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects_photos pp WHERE 1 = %d AND project_id = %d ORDER BY pp.order ASC', $parameter, $project_id);
	
		return $this->executeQuery($sql);
	}
	
	public function getProjectPhoto($project_id, $id)
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects_photos pp WHERE 1 = %d AND project_id = %d AND id = %d ORDER BY pp.order ASC', $parameter, $project_id, $id);
	
		return $this->executeQuery($sql);
	}
	
	public function addProjectPhoto($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects_photos ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND project_id = %d";
		$sql .= " AND image = '%s'";
	
		$sql = sprintf($sql, $parameter, $arr_data['project_id'], $arr_data["image"]);
	
		//echo $sql;
	
		$result = $this->executeQuery($sql);
	
		if (count($result)==0)
		{
			$data = array(
					'project_id' => $arr_data["project_id"],
					'image' => $arr_data["image"],
					'order' => $arr_data["order"],
			);
				
				
			$this->setTable('projects_photos');
			$this->insert($data);
				
			return true;
		}
	
		return false;
	}
	
	public function editProjectPhoto($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects_photos ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
	
		$sql = sprintf($sql, $parameter, $arr_data["id"]);
	
		//echo $sql;
	
		$result = $this->executeQuery($sql);
	
		if (count($result)>0)
		{
			$data = array(
					'image' => $arr_data["image"],
					'order' => $arr_data["order"],
					'active' => $arr_data["active"],
			);
				
			$this->db->where_in('id', $arr_data["id"]);
			$this->db->update('projects_photos', $data);
				
			return true;
		}
	
		return false;
	
	}
	
	
	public function deleteProjectPhoto($id)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects_photos ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
	
		$sql = sprintf($sql, $parameter, $id);
	
		//echo $sql;
	
		$result = $this->executeQuery($sql);
	
		if (count($result)>0)
		{
	
			$this->db->where('id', $id);
			$this->db->delete('projects_photos');
	
			return true;
		}
	
		return false;
	
	}
	
	
	
	///////////////////////////////
	
	public function getAllProjects()
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects WHERE 1 = %d ORDER BY id DESC', $parameter);
	
		return $this->executeQuery($sql);
	}
	
	public function getProject($id)
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects WHERE 1 = %d AND id = %d ORDER BY id DESC', $parameter, $id);
	
		return $this->executeQuery($sql);
	}
	
	public function addProject($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND name = '%s'";
		
		$sql = sprintf($sql, $parameter, $arr_data["name"]);
		
		//echo $sql;
		
		$result = $this->executeQuery($sql);
		
		if (count($result)==0)
		{
			$data = array(
				'name' => $arr_data["name"],
				'description' => $arr_data["description"],
				'image' => $arr_data["image"],
			    'order' => $arr_data["order"],
			    'link' => $arr_data["link"],
			);
			
			
			$this->setTable('projects');
			$this->insert($data);
			
			return true;
		}
		
		return false;
	}
	
	public function editProject($arr_data)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
		
		$sql = sprintf($sql, $parameter, $arr_data["id"]);
		
		//echo $sql;
		
		$result = $this->executeQuery($sql);
		
		if (count($result)>0)
		{
			$data = array(
				'name' => $arr_data["name"],
				'description' => $arr_data["description"],
				'image' => $arr_data["image"],
			    'order' => $arr_data["order"],
			    'link' => $arr_data["link"],
				'active' => $arr_data["active"],
			);
			
			$this->db->where_in('id', $arr_data["id"]);
			$this->db->update('projects', $data);
			
			return true;
		}
		
		return false;	
		
	}
	
	
	public function deleteProject($project_id)
	{
		$parameter = 1;
		$sql = "SELECT * FROM projects ";
		$sql .= " WHERE 1 = %d";
		$sql .= " AND id = '%d'";
	
		$sql = sprintf($sql, $parameter, $project_id);
	
		//echo $sql;
	
		$result = $this->executeQuery($sql);
	
		if (count($result)>0)
		{
				
			$this->db->where('id', $project_id);
			$this->db->delete('projects');
				
			return true;
		}
	
		return false;
	
	}
	
	
}