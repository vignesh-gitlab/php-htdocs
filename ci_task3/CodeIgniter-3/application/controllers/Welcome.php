<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
	}

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
		$this->load->view('show_data');
	}
	public function register(){
		$this->load->view('register_view');
	}
	public function get_data(){
		$data=$this->user_model->get_data();
		echo json_encode($data);
	}
	public function insert(){
		$data=array(
			'user_name'=>$this->input->post("user_name"),
			'password'=>$this->input->post("password"),
			'latitude'=>$this->input->post("latitude"),
			'longitude'=>$this->input->post("longitude")
		);
		$res=$this->user_model->insert($data);
		echo $res;
		
	}
}
