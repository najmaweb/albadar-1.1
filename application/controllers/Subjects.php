<?php
class Subjects extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("User");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Mapel",2=>"Daftar"),
            "formtitle"=>"Daftar Mata Pelajaran",
            "feedData"=>"subject",
            "role"=>$this->User->getrole()
        );
        $this->load->view("students/students",$data);
    }
}