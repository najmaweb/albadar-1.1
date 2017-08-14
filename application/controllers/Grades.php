<?php
class Grades extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Grade");
        $this->load->model("Sppgroup");
        $this->load->model("Bimbelgroup");
        $this->load->model("Dupsbgroup");
        $this->load->model("Bookpaymentgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Daftar"),
            "formtitle"=>"Daftar Kelas",
            "feedData"=>"kelas",
            "objs" => $this->Grade->getgrades(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("grades/grades",$data);
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Penambahan"),
            "formtitle"=>"Penambahan Kelas",
            "feedData"=>"kelas",
            "grades"=>$this->Grade->getgrades(),
            "sppdefault"=>$this->Sppgroup->getsppgrouparray(),
            "dupsbdefault"=>$this->Dupsbgroup->getDupsbgrouparray(),
            "bimbeldefault"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("grades/add",$data);        
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Edit"),
            "formtitle"=>"Edit Kelas",
            "feedData"=>"kelas",
            "obj"=>$this->Grade->getgrade($this->uri->segment(3)),
            "sppdefault"=>$this->Sppgroup->getsppgrouparray(),
            "bimbeldefault"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "dupsbdefault"=>$this->Dupsbgroup->getDupsbgrouparray(),
            "bookpaymentdefault"=>$this->Bookpaymentgroup->getBookpaymentgrouparray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("grades/edit",$data);        
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->Grade->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Grade->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Grade->update($params);
        $this->Grade->updatesppall($params);
        redirect("../index");
    }
}