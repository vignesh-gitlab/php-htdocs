<?php
class Users_model extends CI_Model{
    function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function insert($user_data){
		$this->db->insert("users", $user_data);		
	}
	public function getdata(){
		$data=$this->db->get("users");
		if(($data->num_rows())>0){
		return $data->result();
		}else{
			return false;
		}
	}
	public function deldata($id){
		$this->db->where("id",$id);
		$this->db->delete("users");
	}

	public function fetch_data($id){
		$this->db->where("id",$id);
		$data=$this->db->get("users");
		if(($data->num_rows())>0){
			return $data->result();
		}else{
			return false;
		}
	}

	public function updatedata($id,$user_data){
		$this->db->where("id",$id);
		$this->db->update("users",$user_data);
	}
}

?>