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
        if($this->uri->total_segments()>2){
            $month = $this->uri->segment(3);
        }else{
            $month = date("m");
        }
        $data = array(
            "feedData"=>"dashboard",
            "role"=>1,
            "sppkls1a"=>$this->Mdashboard->getsppstatistic(1,$month)["percentage"],
            "sppkls1b"=>$this->Mdashboard->getsppstatistic(2,$month)["percentage"],
            "sppkls1c"=>$this->Mdashboard->getsppstatistic(3,$month)["percentage"],
            "sppkls2a"=>$this->Mdashboard->getsppstatistic(4,$month)["percentage"],
            "sppkls2b"=>$this->Mdashboard->getsppstatistic(5,$month)["percentage"],
            "sppkls2c"=>$this->Mdashboard->getsppstatistic(6,$month)["percentage"],
            "sppkls3a"=>$this->Mdashboard->getsppstatistic(7,$month)["percentage"],
            "sppkls3b"=>$this->Mdashboard->getsppstatistic(8,$month)["percentage"],
            "sppkls3c"=>$this->Mdashboard->getsppstatistic(9,$month)["percentage"],
            "sppkls4a"=>$this->Mdashboard->getsppstatistic(10,$month)["percentage"],
            "sppkls4b"=>$this->Mdashboard->getsppstatistic(11,$month)["percentage"],
            "sppkls4c"=>$this->Mdashboard->getsppstatistic(12,$month)["percentage"],
            "sppkls5a"=>$this->Mdashboard->getsppstatistic(13,$month)["percentage"],
            "sppkls5b"=>$this->Mdashboard->getsppstatistic(14,$month)["percentage"],
            "sppkls6a"=>$this->Mdashboard->getsppstatistic(15,$month)["percentage"],
            "sppkls6b"=>$this->Mdashboard->getsppstatistic(16,$month)["percentage"],
            "spppercentage"=>$this->Mdashboard->getsppstatistic(5,$month)["percentage"],
            "bimbelpercentage"=>$this->Mdashboard->getbimbelstatistic()["percentage"],
            "bookpercentage"=>$this->Mdashboard->getbookstatistic()["percentage"],
            "months"=>$this->dates->getmonthsarray(),
            "month"=>$month
        );
        $this->load->view("dashboard/dashboard",$data);
    }
    function dupsb(){
        session_start();
        checklogin();
        if($this->uri->total_segments()>2){
            $month = $this->uri->segment(3);
        }else{
            $month = date("m");
        }
        $data = array(
            "feedData"=>"dashboard",
            "role"=>1,
            "dupsbkls1a"=>$this->Mdashboard->getdupsbstatistic(1,$month)["percentage"],
            "dupsbkls1b"=>$this->Mdashboard->getdupsbstatistic(2,$month)["percentage"],
            "dupsbkls1c"=>$this->Mdashboard->getdupsbstatistic(3,$month)["percentage"],
            "dupsbkls2a"=>$this->Mdashboard->getdupsbstatistic(4,$month)["percentage"],
            "dupsbkls2b"=>$this->Mdashboard->getdupsbstatistic(5,$month)["percentage"],
            "dupsbkls2c"=>$this->Mdashboard->getdupsbstatistic(6,$month)["percentage"],
            "dupsbkls3a"=>$this->Mdashboard->getdupsbstatistic(7,$month)["percentage"],
            "dupsbkls3b"=>$this->Mdashboard->getdupsbstatistic(8,$month)["percentage"],
            "dupsbkls3c"=>$this->Mdashboard->getdupsbstatistic(9,$month)["percentage"],
            "dupsbkls4a"=>$this->Mdashboard->getdupsbstatistic(10,$month)["percentage"],
            "dupsbkls4b"=>$this->Mdashboard->getdupsbstatistic(11,$month)["percentage"],
            "dupsbkls4c"=>$this->Mdashboard->getdupsbstatistic(12,$month)["percentage"],
            "dupsbkls5a"=>$this->Mdashboard->getdupsbstatistic(13,$month)["percentage"],
            "dupsbkls5b"=>$this->Mdashboard->getdupsbstatistic(14,$month)["percentage"],
            "dupsbkls6a"=>$this->Mdashboard->getdupsbstatistic(15,$month)["percentage"],
            "dupsbkls6b"=>$this->Mdashboard->getdupsbstatistic(16,$month)["percentage"],
            "spppercentage"=>$this->Mdashboard->getdupsbstatistic(5,$month)["percentage"],
            "bimbelpercentage"=>$this->Mdashboard->getbimbelstatistic()["percentage"],
            "bookpercentage"=>$this->Mdashboard->getbookstatistic()["percentage"],
            "months"=>$this->dates->getmonthsarray(),
            "month"=>$month
        );
        $this->load->view("dashboard/dupsb",$data);
    }
    function filter(){
        $params = $this->input->post();
        redirect("../../Dashboard/index/".$params["month"]);
    }
}