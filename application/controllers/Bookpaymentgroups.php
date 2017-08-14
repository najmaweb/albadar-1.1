<?php
class Bookpaymentgroups extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Bookpaymentgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Buku",2=>"Daftar"),
            "formtitle"=>"Daftar Grup Buku",
            "feedData"=>"Bookpaymentgroup",
            "objs" => $this->Bookpaymentgroup->getBookpaymentgroups(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("bookpaymentgroups/bookpaymentgroup",$data);
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Buku",2=>"Penambahan"),
            "formtitle"=>"Penambahan Grup Buku",
            "feedData"=>"Bookpaymentgroup",
            "Bookpaymentgroups"=>$this->Bookpaymentgroup->getBookpaymentgroups(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("bookpaymentgroups/add",$data);        
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Grup Buku",2=>"Edit"),
            "formtitle"=>"Edit Grup Buku",
            "feedData"=>"Bookpaymentgroup",
            "obj"=>$this->Bookpaymentgroup->getBookpaymentgroup($this->uri->segment(3)),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("bookpaymentgroups/edit",$data);        
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->Bookpaymentgroup->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Bookpaymentgroup->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        echo $this->Bookpaymentgroup->update($params);
        redirect("../index");
    }
}