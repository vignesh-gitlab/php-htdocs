<?php 
class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function get_data(){
        $data=$this->db->get("user_copy");
        if(($data->num_rows())>0){
            return $data->result();
        }else{
            return false;
        }
    }
    public function insert($data){
        $res=$this->db->insert("user_copy",$data);
        if($res){
            return true;
        }else{
            return false;
        }

    }
}
?>