<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	/*function __construct(){
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('geolocation');
	}*/

		/*$this->load->helper('url');
		$this->load->model('users_model');
		//include modal.php in views
		$this->inc['modal'] = $this->load->view('modal', '', true);
	}*/
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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		//load library
$this->load->library('user_agent');
//get browser detail
$data['browser'] = $this->agent->browser();
//Get detail browser version
$data['browser_version'] = $this->agent->version();
//get detail opreting system
$data['os'] = $this->agent->platform();
//get ip address detail
$data['ip_address'] = $this->input->ip_address();
$this->load->view('welcome', $data);
		//$this->load->view('home');
	}
    /*function validate(){        
		$user['user_name'] = $_POST['user_name'];
		$user['password'] = $_POST['password'];		
 
		//$query = $this->users_model->validate($user);
    }*/
}
