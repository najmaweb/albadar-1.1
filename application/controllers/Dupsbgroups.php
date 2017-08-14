<?php
class Dupsbgroups extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Dupsbgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Dupsb",2=>"Daftar"),
            "formtitle"=>"Daftar Grup Dupsb",
            "feedData"=>"Dupsbgroup",
            "objs" => $this->Dupsbgroup->getDupsbgroups(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("dupsbgroups/dupsbgroup",$data);
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Dupsb",2=>"Penambahan"),
            "formtitle"=>"Penambahan Grup Dupsb",
            "feedData"=>"Dupsbgroup",
            "Dupsbgroups"=>$this->Dupsbgroup->getDupsbgroups(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("dupsbgroups/add",$data);        
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Dupsb",2=>"Edit"),
            "formtitle"=>"Edit Grup Dupsb",
            "feedData"=>"Dupsbgroup",
            "obj"=>$this->Dupsbgroup->getDupsbgroup($this->uri->segment(3)),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("dupsbgroups/edit",$data);        
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->Dupsbgroup->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Dupsbgroup->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        echo $this->Dupsbgroup->update($params);
        redirect("../index");
    }
}