<?php
class Users extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("User");
        $this->load->model("Grade");
        $this->load->helper("Login");
        $this->load->model("Sppgroup");
        $this->load->model("Dupsbgroup");
        $this->load->library("Dates");
    }
    function changeuserpassword(){
        session_start();
        checklogin();
        $userid = $this->uri->segment(3);
        $password = $this->uri->segment(4);
        $this->User->changepassword($userid,$password);
    }
    function login(){
        session_start();
        checklogin();
        $email = $this->uri->segment(3);
        $password = $this->uri->segment(4);
        echo $this->User->login("risma@gmail.com",$password);
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Daftar"),
            "formtitle"=>"Daftar Siswa",
            "feedData"=>"user",
            "objs"=>$this->User->getUsers(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("users/users",$data);
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Penambahan"),
            "formtitle"=>"Penambahan Siswa",
            "feedData"=>"user",
            "Users"=>$this->User->getUsers(),
            "grades"=>$this->Grade->getclassarray(),
            "sppgroups"=>$this->Sppgroup->getsppgrouparray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("users/add",$data);        
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Edit"),
            "formtitle"=>"Edit siswa",
            "feedData"=>"user",
            "obj"=>$this->User->getUser($this->uri->segment(3)),
            "grades"=>$this->Grade->getclassarray(),
            "sppgroups"=>$this->Sppgroup->getsppgrouparray(),
            "dupsbgroups"=>$this->Dupsbgroup->getDupsbgrouparray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("users/edit",$data);        
    }
    function getjson(){
        session_start();
        checklogin();
        $year = $this->dates->getcurrentyear();
        $sql = "select a.id,a.name,email from users a ";
        $que = $this->db->query($sql);
        $res = $que->result();
        $arr = array();
		foreach($res as $obj){
			array_push($arr,'{"id":"'.$obj->id.'","name":"'.$obj->name.'","email":"'.$obj->email.'"}');
		}
		echo '{"out":['.implode(",",$arr).']}';
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->User->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->User->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        echo $this->User->update($params);
        redirect("../index");
    }    
}