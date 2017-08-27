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
            "months"=>$this->dates->getmonthsarray(),
            "month"=>$month
        );
        $this->load->view("dashboard/spp",$data);
    }
    function bimbel(){
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
            "bimbelkls1a"=>$this->Mdashboard->getbimbelstatistic(1,$month)["percentage"],
            "bimbelkls1b"=>$this->Mdashboard->getbimbelstatistic(2,$month)["percentage"],
            "bimbelkls1c"=>$this->Mdashboard->getbimbelstatistic(3,$month)["percentage"],
            "bimbelkls2a"=>$this->Mdashboard->getbimbelstatistic(4,$month)["percentage"],
            "bimbelkls2b"=>$this->Mdashboard->getbimbelstatistic(5,$month)["percentage"],
            "bimbelkls2c"=>$this->Mdashboard->getbimbelstatistic(6,$month)["percentage"],
            "bimbelkls3a"=>$this->Mdashboard->getbimbelstatistic(7,$month)["percentage"],
            "bimbelkls3b"=>$this->Mdashboard->getbimbelstatistic(8,$month)["percentage"],
            "bimbelkls3c"=>$this->Mdashboard->getbimbelstatistic(9,$month)["percentage"],
            "bimbelkls4a"=>$this->Mdashboard->getbimbelstatistic(10,$month)["percentage"],
            "bimbelkls4b"=>$this->Mdashboard->getbimbelstatistic(11,$month)["percentage"],
            "bimbelkls4c"=>$this->Mdashboard->getbimbelstatistic(12,$month)["percentage"],
            "bimbelkls5a"=>$this->Mdashboard->getbimbelstatistic(13,$month)["percentage"],
            "bimbelkls5b"=>$this->Mdashboard->getbimbelstatistic(14,$month)["percentage"],
            "bimbelkls6a"=>$this->Mdashboard->getbimbelstatistic(15,$month)["percentage"],
            "bimbelkls6b"=>$this->Mdashboard->getbimbelstatistic(16,$month)["percentage"],
            "months"=>$this->dates->getmonthsarray(),
            "month"=>$month
        );
        $this->load->view("dashboard/bimbel",$data);
    }
    function buku(){
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
            "bukukls1a"=>$this->Mdashboard->getbookstatistic(1,$month)["percentage"],
            "bukukls1b"=>$this->Mdashboard->getbookstatistic(2,$month)["percentage"],
            "bukukls1c"=>$this->Mdashboard->getbookstatistic(3,$month)["percentage"],
            "bukukls2a"=>$this->Mdashboard->getbookstatistic(4,$month)["percentage"],
            "bukukls2b"=>$this->Mdashboard->getbookstatistic(5,$month)["percentage"],
            "bukukls2c"=>$this->Mdashboard->getbookstatistic(6,$month)["percentage"],
            "bukukls3a"=>$this->Mdashboard->getbookstatistic(7,$month)["percentage"],
            "bukukls3b"=>$this->Mdashboard->getbookstatistic(8,$month)["percentage"],
            "bukukls3c"=>$this->Mdashboard->getbookstatistic(9,$month)["percentage"],
            "bukukls4a"=>$this->Mdashboard->getbookstatistic(10,$month)["percentage"],
            "bukukls4b"=>$this->Mdashboard->getbookstatistic(11,$month)["percentage"],
            "bukukls4c"=>$this->Mdashboard->getbookstatistic(12,$month)["percentage"],
            "bukukls5a"=>$this->Mdashboard->getbookstatistic(13,$month)["percentage"],
            "bukukls5b"=>$this->Mdashboard->getbookstatistic(14,$month)["percentage"],
            "bukukls6a"=>$this->Mdashboard->getbookstatistic(15,$month)["percentage"],
            "bukukls6b"=>$this->Mdashboard->getbookstatistic(16,$month)["percentage"],
            "months"=>$this->dates->getmonthsarray(),
            "month"=>$month
        );
        $this->load->view("dashboard/buku",$data);        
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