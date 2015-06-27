<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', true);


require_once(APPPATH.'third_party/twitteroauth/twitteroauth.php');
require_once(APPPATH.'third_party/API/TwitterAPIExchange.php');

class Admin extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('url');
    }
    
	public function login()
	{
		$this->load->view('admin/login.php');
	}
	
	public function projects_photos($project_id = null)
	{
		$this->load->library( 'nativesession' );
		if(isset($_SESSION['user_id'])) //check whether user already logged in with twitter
		{
				
			$this->load->model('admin_model');
				
			$rows = $this->admin_model->getAllProjectsPhotos($project_id);
				
			$this->load->view('admin/projects_photos.php', array('rows' => $rows, 'project_id' => $project_id));
		}
		else
		{
			$this->session->set_flashdata('error', 'No hay sesión activa.');
			redirect(base_url()."admin/login");
		}
	}
	
	public function add_project_photo($project_id = null)
	{
		if(empty($_POST))
		{
			$this->load->view('admin/add_project_photo', array('project_id' => $project_id));
		}
		else
		{
			$data["project_id"] = $_POST['hdd_project_id'];
				
			if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
			{
	
				$path = $_FILES['image']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
	
				$timestamp = strtotime('now');
				$name_file = $timestamp . "." . $ext;
	
				if(move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$name_file))
					$data['image'] = $name_file;
			}
			$data['order'] = $_POST['order'];
				
			$this->load->model('admin_model');
			$this->admin_model->addProjectPhoto($data);
			$this->session->set_flashdata('success', 'Project Add.');
			redirect(base_url().'admin/projects_photos/'.$project_id);
		}
	}
	
	public function edit_project_photo($project_id = null, $id = null)
	{
		if(empty($_POST))
		{
			$this->load->model('admin_model');
			$info = $this->admin_model->getProjectPhoto($project_id, $id);
			$info = $info[0];
	
			$this->load->view('admin/edit_project_photo', array('info' => $info, 'project_id' => $project_id, 'the_id' => $id));
		}
		else
		{
		
			if (array_key_exists("active", $_POST)) {
				$data['active'] =  ($_POST['active'] == "on") ? 1 : 0;
			}
			else
			{
				$data['active'] = 0;
			}
			
			$project_id = $_POST['hdd_project_id'];
			$data['id'] = $_POST['hdd_id'];
			
			if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
			{
			
				$path = $_FILES['image']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
			
				$timestamp = strtotime('now');
				$name_file = $timestamp . "." . $ext;
			
				if(move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$name_file))
					$data['image'] = $name_file;
			}
			else
			{
				$data['image'] = $_POST['hdd_image'];
			}
			$data['order'] = $_POST['order'];
			
				
			/*
				echo "<pre>";
				print_r($data);
				echo "</pre>";
				die();
				*/
				
			$this->load->model('admin_model');
			$this->admin_model->editProjectPhoto($data);
			$this->session->set_flashdata('success', 'Project Edited.');
			redirect(base_url().'admin/projects_photos/'.$project_id);
		}
	}
	
	public function delete_project_photo($project_id = null, $id = null)
	{
		$this->load->model('admin_model');
		$this->admin_model->deleteProjectPhoto($id);
		$this->session->set_flashdata('success', 'Project deleted.');
		redirect(base_url().'admin/projects_photos/'.$project_id);
	}
	
	
	///////////////////////////
	public function projects()
	{
		$this->load->library( 'nativesession' );
		if(isset($_SESSION['user_id'])) //check whether user already logged in with twitter
		{
			
			$this->load->model('admin_model');
			
			$rows = $this->admin_model->getAllProjects();
			
			$this->load->view('admin/projects.php', array('rows' => $rows));
		}
		else
		{
			$this->session->set_flashdata('error', 'No hay sesión activa.');
			redirect(base_url()."admin/login");
		}
	}
	
	public function add_project()
	{
		if(empty($_POST))
		{
			$this->load->view('admin/add_project');
		}
		else
		{
			$data['name'] = $_POST['name'];
			$data['description'] = $_POST['description'];
			
			if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
			{
				
				$path = $_FILES['image']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				
				$timestamp = strtotime('now');
				$name_file = $timestamp . "." . $ext;
				
				if(move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$name_file))
					$data['image'] = $name_file;
			}
			$data['order'] = $_POST['order'];
			$data['link'] = $_POST['link'];
			
			$this->load->model('admin_model');
			$this->admin_model->addProject($data);
			$this->session->set_flashdata('success', 'Project Add.');
			redirect(base_url().'admin/projects');
		}
	}
	
	public function edit_project($id = null)
	{
		if(empty($_POST))
		{
			$this->load->model('admin_model');
			$info = $this->admin_model->getProject($id);
			$info = $info[0];
	
			$this->load->view('admin/edit_project', array('info' => $info, 'the_id' => $id));
		}
		else
		{
			
			$data['name'] = $_POST['name'];
			$data['description'] = $_POST['description'];
			if (array_key_exists("active", $_POST)) {
				$data['active'] =  ($_POST['active'] == "on") ? 1 : 0;
			}
			else 
			{
				$data['active'] = 0;
			}
			
			$data['id'] = $_POST['project_id'];
			
			if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
			{
				
				$path = $_FILES['image']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				
				$timestamp = strtotime('now');
				$name_file = $timestamp . "." . $ext;
				
				if(move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$name_file))
					$data['image'] = $name_file;
			}
			else
			{
				$data['image'] = $_POST['hdd_image'];
			}
			$data['order'] = $_POST['order'];
			$data['link'] = $_POST['link'];
			/*
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			die();
			*/
			
			$this->load->model('admin_model');
			$this->admin_model->editProject($data);
			$this->session->set_flashdata('success', 'Project Edited.');
			redirect(base_url().'admin/projects');
		}
	}
	
	public function delete_project($id = null)
	{
		$this->load->model('admin_model');
		$this->admin_model->deleteProject($id);
		$this->session->set_flashdata('success', 'Project deleted.');
		redirect(base_url().'admin/projects');
	}
	

	public function auth()
	{
		$this->load->library( 'nativesession' );
		$this->load->model('admin_model');
		
		$username = $_POST["username"];
		$pwd = $_POST["pwd"];
		
		$info_user = $this->admin_model->getInfoAdmin($username, $pwd);
		$info_user = $info_user[0];
		
		if(count($info_user)>0) //check whether user already logged in with twitter
		{
			$_SESSION["user_id"] = $info_user["id"];
			redirect(base_url()."admin/projects");
		}
		else
		{
			$this->session->set_flashdata('error', 'Credenciales inválidas');
			unset($_SESSION["user_id"]);
			redirect(base_url()."admin/login");
		}
		
	}
	
	public function logout()
	{
		$this->load->library( 'nativesession' );
		
		unset($_SESSION["user_id"]);
		$this->session->set_flashdata('error', 'Ud. se ha desloggeado.');
		redirect(base_url()."admin/login");
	}
	
	public function tester()
	{
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */