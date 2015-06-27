<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

class Front_model extends MY_Crud{

	public function getAllProjectsPhotos($project_id)
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects_photos pp WHERE 1 = %d AND project_id = %d AND active = 1 ORDER BY pp.order ASC', $parameter, $project_id);
	
		return $this->executeQuery($sql);
	}
	
	
	///////////////////////////////
	
	public function getAllProjects()
	{
		$parameter = 1;
		$sql = sprintf('SELECT p.* FROM projects p WHERE 1 = %d AND p.active = 1 ORDER BY p.order DESC', $parameter);
	
		return $this->executeQuery($sql);
	}
	
	public function getProject($project_id)
	{
		$parameter = 1;
		$sql = sprintf('SELECT * FROM projects WHERE 1 = %d AND id = %d AND active = 1 ORDER BY id DESC', $parameter, $project_id);
	
		return $this->executeQuery($sql);
	}
	
	public function likeProject($project_id)
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
		    
		    $info = $result[0];
		    
			$data = array(
					'num_likes' => (intval($info) + 1),
			);
	
			$this->db->where('id', $project_id);
			$this->db->update('projects', $data);
	
			return true;
		}
	
		return false;
	
	}
	
	
	
	
}