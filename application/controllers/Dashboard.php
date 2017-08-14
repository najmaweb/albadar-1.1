<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("routines");
        $this->load->model("Mdashboard");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "feedData"=>"dashboard",
            "role"=>1,
            "spppercentage"=>$this->Mdashboard->getspppercentage(),
            "bimbelpercentage"=>$this->Mdashboard->getbimbelpercentage(),
            "dupsbpercentage"=>$this->Mdashboard->getdupsbpercentage(),
            "bookpercentage"=>$this->Mdashboard->getbookpercentage(),
        );
        $this->load->view("dashboard/dashboard",$data);
    }
}