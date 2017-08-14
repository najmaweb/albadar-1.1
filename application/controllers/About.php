<?php
class About extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"App",2=>"Tentang"),
            "formtitle"=>"Tentang App",
            "feedData"=>"about",
            "role"=>"1"
        );
        $this->load->view("about",$data);
    }
}