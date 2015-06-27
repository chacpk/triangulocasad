<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'third_party/twitteroauth/twitteroauth.php');
require_once(APPPATH.'third_party/API/TwitterAPIExchange.php');

class Mini extends CI_Controller {
	
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
		$this->load->view('mini/index.php');
	}
	
	public function tester()
	{
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
	}
	
	public function send()
	{
		// Report all PHP errors
		//error_reporting(-1);
		
		
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        // An alternate way to specify the same item:
		$this->config->load('twitterapp');
		
        $tweet = $_POST['text-tweet'];
		$lat = $_POST['hdd_lat'];
		$long = $_POST['hdd_long'];
		
		$hashtag = $_POST['hashtag'];
		$email = $_POST['email'];
		$postal_code = $_POST['postal_code'];
		$purchase_intent = $_POST['purchase_intent'];
		
		
		//antes lo guardamos en la base de datos
		$arr_data["username"] = $_SESSION["name"];
		$arr_data["twitter_id"] = $_SESSION["twitter_id"];
		$arr_data["picture"] = $_SESSION["image"];
		$arr_data["tweet"] = $tweet;
		$arr_data["hashtag"] = $hashtag;
		$arr_data["email"] = $email;
		$arr_data["postal_code"] = $postal_code;
		$arr_data["purchase_intent"] = $purchase_intent;
		$arr_data["lat"] = $lat;
		$arr_data["long"] = $long;
		
		
		$this->load->model('dispatcher_model');
		
		$result = $this->dispatcher_model->addTweet($arr_data);
	
		$settings = array(
		    'oauth_access_token' => $_SESSION["user_oauth_token"],
		    'oauth_access_token_secret' => $_SESSION["user_oauth_token_secret"],
		    'consumer_key' => $this->config->item('CONSUMER_KEY'),
		    'consumer_secret' => $this->config->item('CONSUMER_SECRET')
		);
		
		
		$url = 'https://api.twitter.com/1.1/statuses/update.json';
		$requestMethod = 'POST';
		//$postfields = array('status' => $tweet);
		$postfields = array( 'status' => $tweet,
						  'display_coordinates' => true,
						  'lat' => $lat,
						  'long' => $long); 
		$twitter = new TwitterAPIExchange($settings);
		$response =  $twitter->buildOauth($url, $requestMethod)
	                 ->setPostfields($postfields)
	                 ->performRequest();
	
		/*
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
		*/
	    die('<script>clearform();</script>');
	}
	
	public function no_geo_permissions()
	{
		$this->load->view('mini/header.php');
		$this->load->view('mini/no_geo_permissions.php');
		$this->load->view('mini/footer.php');
	}
	
	public function tweet()
	{
		//load our Nativesession library
        $this->load->library( 'nativesession' );
		if(isset($_SESSION['name']) && isset($_SESSION['twitter_id'])) //check whether user already logged in with twitter
		{
		
			$the_name = $_SESSION['name'];
			$the_twitter_id = $_SESSION['twitter_id'];
			$the_image = "<img src='".$_SESSION['image']."'/>";
			//echo "<br/><a href='logout.php'>Logout</a>";
		
			$this->load->view('mini/header.php');
			$this->load->view('mini/tweet.php', array('the_name' => $the_name,
														'the_twitter_id' => $the_twitter_id,
														'the_image' => $the_image));
			$this->load->view('mini/footer.php');
		}
	}
	
	public function logout()
	{
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        
        session_destroy();
        
        redirect(base_url().'mini/index');
	}
	
	public function oauth()
	{
		
		
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        // An alternate way to specify the same item:
		$this->config->load('twitterapp');
		
		if(isset($_GET['oauth_token']))
		{
			$connection = new TwitterOAuth($this->config->item('CONSUMER_KEY'), $this->config->item('CONSUMER_SECRET'), $_SESSION['request_token'], $_SESSION['request_token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			
			
			if($access_token)
			{
					$_SESSION["user_oauth_token"] = $access_token['oauth_token'];
					$_SESSION["user_oauth_token_secret"] = $access_token['oauth_token_secret'];
				
					$connection = new TwitterOAuth($this->config->item('CONSUMER_KEY'), $this->config->item('CONSUMER_SECRET'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
					$params =array();
					$params['include_entities']='false';
					$content = $connection->get('account/verify_credentials',$params);
					
		
					if($content && isset($content->screen_name) && isset($content->name))
					{
						$_SESSION['name']=$content->name;
						$_SESSION['image']=$content->profile_image_url;
						$_SESSION['twitter_id']=$content->screen_name;
						
						//redirect to main page.
						//header('Location: tweet.php'); 
						redirect(base_url().'mini/tweet');
					}
					else
					{
						echo "<h4> Login Error </h4>";
					}
			}
		
		else
		{
			echo "<h4> Login Error </h4>";
		}
		
		}
		else //Error. redirect to Login Page.
		{
			//header('Location: http://hayageek.com/examples/oauth/twitter/login.html'); 
			redirect(base_url().'mini/index');
		}
	}
	
	public function login()
	{
		//load our Nativesession library
        $this->load->library( 'nativesession' );
        // An alternate way to specify the same item:
		$this->config->load('twitterapp');
        
        if(isset($_SESSION['name']) && isset($_SESSION['twitter_id'])) //check whether user already logged in with twitter
		{
        	$this->load->view('mini/login.php');
		}
		else // Not logged in
		{
			$connection = new TwitterOAuth($this->config->item('CONSUMER_KEY'), $this->config->item('CONSUMER_SECRET'));
			$request_token = $connection->getRequestToken($this->config->item('OAUTH_CALLBACK')); //get Request Token
			
		
			if(	$request_token)
			{
				$token = $request_token['oauth_token'];
				$_SESSION['request_token'] = $token ;
				$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
				
				
				switch ($connection->http_code) 
				{
					case 200:
						$url = $connection->getAuthorizeURL($token);
						//redirect to Twitter .
				    	//header('Location: ' . $url); 
				    	
						redirect($url);
					    break;
					default:
					    echo "Coonection with twitter Failed";
				    	break;
				}
		
			}
			else //error receiving request token
			{
				echo "Error Receiving Request Token";
			}
			
		
		}
        
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */