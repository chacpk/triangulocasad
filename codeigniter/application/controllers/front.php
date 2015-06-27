<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', true);


require_once(APPPATH.'third_party/twitteroauth/twitteroauth.php');
require_once(APPPATH.'third_party/API/TwitterAPIExchange.php');

class Front extends CI_Controller {
	
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
    
	public function index()
	{
		$this->load->view('front/index.php');
	}
	
	public function contacto()
	{
	    if (isset($_POST))
	    {
	        //load email helper
	        $this->load->helper('email');
	        //load email library
	        $this->load->library('email');
	        
	        //read parameters from $_POST using input class
	        $email = $this->input->post('email',true);
	        $name = $this->input->post('name',true);
	        $message = $this->input->post('message',true);
	        
	        // check is email addrress valid or no
	        if (valid_email($email)){
	        	// compose email
	        	$this->email->from($email , $name);
	        	$this->email->to("jocapequ@gmail.com");
	        	$this->email->subject('Contacto página web');
	        	$this->email->message($message);
	        	
	        	// try send mail ant if not able print debug
	        	if ( ! $this->email->send())
	        	{
	        		$data['message'] ="Email not sent \n".$this->email->print_debugger();
	        		$this->load->view('header');
	        		$this->load->view('message',$data);
	        		$this->load->view('footer');
	        	
	        		// load session library if not auto-loaded
	        		$this->session->set_flashdata('msg', 'Error en el envío');
	        		
	        	}
	        	else
	        	{
	        	    // load session library if not auto-loaded
	        	    $this->session->set_flashdata('msg', 'Correo Enviado');
	        	}
	        }
	        
	    }
	    
		$this->load->view('front/contacto.php');
	}
	
	public function detalle($project_id = null)
	{
	    $this->load->model('front_model');
	    $rows = $this->front_model->getAllProjectsPhotos($project_id);
	    
	    $info = $this->front_model->getProject($project_id);
	    $info = $info[0];
	    
		$this->load->view('front/detalle.php', array('rows' => $rows, 'info' => $info));
	}
	
	public function perfil()
	{
		$this->load->view('front/perfil.php');
	}
	
	public function proyectos()
	{
	    $this->load->model('front_model');
	    $rows = $this->front_model->getAllProjects();

	    $this->load->view('front/proyectos.php', array('rows' => $rows));
	}
	
	public function error()
	{
		$this->load->view('front/404.php');
	}
	
	public function likeproject()
	{
	    if (isset($_POST))
	    {
	        $project_id = $_POST['project_id'];
	        
	        $this->load->model('front_model');
	        $rows = $this->front_model->likeProject($project_id);
	        
	        die("DONE");
	    }
	    
	    die("");
	    
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */