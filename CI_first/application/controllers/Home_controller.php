<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

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
		$this->load->view('home');
	}
    function registration(){
        
        if($this->input->post('registration_submit')){
            $data['name']=$this->input->post('name');
            $data['email']=$this->input->post('email');
            $data['password']=$this->input->post('password');
            $data['user_type']=$this->input->post('user_type');
            $this->load->model("Home_model");
            $status=$this->Home_model->insert($data);
            if($status==true){
                echo "Record Inserted Successfully";
            }else{
                echo "Failed to Insert Record";
            }
        }else{
            $this->load->view('registration');
        }
    }
    function ajax_view(){
        $this->load->view('view_data_ajax');
    }
    function insert(){
        $this->load->model('Home_model');
        $this->Home_model->insert($data);
    }
}
