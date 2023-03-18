<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');		
		//include modal.php in views
		//$this->inc['modal'] = $this->load->view('modal', '', true);
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
	public function welcome_view()
	{
		$this->load->view('welcome_view');
	}
	public function insert(){		
		$user_data=array(
			'name'=> $this->input->post("name"),
			'user_name'=> $this->input->post("user_name"),
			'password'=> $this->input->post("password"),
			'latitude'=> $this->input->post("latitude"),
			'longitude'=>$this->input->post("longitude")
		);		
		if($this->input->post("submit")=="submit"){
			$this->users_model->insert($user_data);
		}
		if($this->input->post("submit")=="update"){
			$id=$this->input->post("singleid");
			$this->users_model->updatedata($id,$user_data);
		}
 
		
	}
	public function getdata(){
		$data=$this->users_model->getdata();
		echo json_encode($data);
	}
	public function deldata(){
		$id=$this->input->post("delid");
		$this->users_model->deldata($id);
	}

	public function editdata(){
		$id=$this->input->post("editid");
		$data=$this->users_model->fetch_data($id);
		echo json_encode($data);
	}
}
