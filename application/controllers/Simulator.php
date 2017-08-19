<?php
class Simulator extends CI_Controller{
    public $crlf;
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Spppayment");
        $this->load->model("Bimbelpayment");
        $this->load->model("Dupsbpayment");
        $this->load->model("Bukupayment");
        $this->crlf = "<br />";
    }
    function index(){
        checklogin();
        $nis = $this->uri->segment(3);
        $payment = new Spppayment($nis);
        $sppmaxyearmonth = $this->Spppayment->getsppmaxyearmonth();
        $sppremain = $payment->getsppremain();
        $cursppbill = $payment->getcurrmonthsppbill();
        echo "Bulan Tahun sekarang " . date("m-Y") . $this->crlf;
        echo "NAMA " . $payment->getname() . $this->crlf;
        echo "PEMBAYARAN SPP TERAKHIR " 
            . $sppmaxyearmonth["maxmonth"] 
            . "-" 
            . $sppmaxyearmonth["maxyear"] 
            . "(".$sppmaxyearmonth["status"].")" . $this->crlf;
        echo "SISA SPP SEBELUMNYA " . $sppremain["sppremain"] . $this->crlf;
        echo "SPP BULAN INI " . $cursppbill . $this->crlf;
        echo "TOTAL TAGIHAN SPP " .( $cursppbill + $sppremain["sppremain"]) . $this->crlf;
        echo "BANYAKNYA BULAN SPP TERTANGGUNG " . $sppremain["monthcount"] . " BULAN" . $this->crlf;
        echo "STATUS SPP " . $sppremain["status"] . $this->crlf;

        echo $this->crlf . $this->crlf;
        
        $bimbel = new Bimbelpayment($nis);
        $bimbelmaxyearmonth = $this->Bimbelpayment->getbimbelmaxyearmonth();
        $bimbelremain=$bimbel->getbimbelremain();
        $curbimbelbill = $bimbel->getcurrmonthbimbelbill();
        echo "Bulan Tahun sekarang " . date("m-Y") . $this->crlf;
        echo "NAMA " . $bimbel->getname() . $this->crlf;
        echo "PEMBAYARAN bimbel TERAKHIR " 
            . $bimbelmaxyearmonth["maxmonth"] 
            . "-" 
            . $bimbelmaxyearmonth["maxyear"] 
            . "(".$bimbelmaxyearmonth["status"].")" . $this->crlf;
        echo "SISA bimbel SEBELUMNYA " . $bimbelremain["bimbelremain"] . $this->crlf;
        echo "bimbel BULAN INI " . $curbimbelbill . $this->crlf;
        echo "TOTAL TAGIHAN bimbel " .( $curbimbelbill + $bimbelremain["bimbelremain"]) . $this->crlf;
        echo "BANYAKNYA BULAN bimbel TERTANGGUNG " . $bimbelremain["monthcount"] . " BULAN" . $this->crlf;
        echo "STATUS bimbel " . $bimbelremain["status"] . $this->crlf;
        echo $this->crlf . $this->crlf;
        $dupsb = new Dupsbpayment($nis);
        echo "TOTAL DUPSB YANG HARUS DIBAYAR " . $dupsb->getdupsb() . $this->crlf;
        echo "DUPSB YANG SUDAH DIBAYAR " . $dupsb->getdupsbpaid() . $this->crlf;
        echo "KEKURANGAN DUPSB ".$dupsb->getdupsbremain() . $this->crlf;

        echo $this->crlf . $this->crlf;
        $buku = new Bukupayment($nis);
        echo "TOTAL BUKU YANG HARUS DIBAYAR " . $buku->getbuku() . $this->crlf;
        echo "BUKU YANG SUDAH DIBAYAR " . $buku->getbukupaid() . $this->crlf;
        echo "KEKURANGAN BUKU ".$buku->getbukuremain() . $this->crlf;

    }
    function previewkwitansi(){
        checklogin();
        session_start();
        $this->load->view("simulator/previewkwitansi");
    }
    function processsppstring(){
        $out = "Pembayaran SPP bulan " . $_SESSION["sppfrstmonth"];
        $out.= "-" . $_SESSION["sppfrstyear"];
        $out.= " s/d " . $_SESSION["sppnextmonth"];
        $out.= " - " . $_SESSION["sppnextyear"];
        return $out;
    }
    function savesession(){
        checklogin();
        $params = $this->input->post();
        foreach($params as $key=>$val){
            echo $key . " -> " . $val . $this->crlf;
        }

        $nis = $params["nis"];
        $payment = new Spppayment($nis);
        $sppmaxyearmonth = $this->Spppayment->getsppmaxyearmonth();
        $sppremain = $payment->getsppremain();
        $cursppbill = $payment->getcurrmonthsppbill();

        $bimbel = new Bimbelpayment($nis);
        $bimbelmaxyearmonth = $this->Bimbelpayment->getbimbelmaxyearmonth();
        $bimbelremain=$bimbel->getbimbelremain();
        $curbimbelbill = $bimbel->getcurrmonthbimbelbill();

        $dupsb = new Dupsbpayment($nis);
        $buku = new Bukupayment($nis);
        session_start();
        $_SESSION["sppfrstmonth"] = $params["sppfrstmonth"];
        $_SESSION["studentname"] = $params["studentname"];
        $_SESSION["sppfrstyear"] = $params["sppfrstyear"];
        $_SESSION["sppnextmonth"] = $params["sppnextmonth"];
        $_SESSION["sppnextyear"] = $params["sppnextyear"];
        $_SESSION["nis"]=$params["nis"];
        $_SESSION["spp"] = $params["spp"];
        $_SESSION["bimbel"]="";
        $_SESSION["bimbelfrstyear"]="";
        $_SESSION["bimbelfrstmonth"]="";
        $_SESSION["bimbelnextyear"]="";
        $_SESSION["bimbelnextmonth"]="";
        $_SESSION["psb"] = removedot($params["psb"]);
        $_SESSION["book"] = removedot($params["book"]);
        $_SESSION["orispp"]="";
        $_SESSION["oribimbel"]="";
        $_SESSION["grade"]="";
        $_SESSION["total"] = $_SESSION["psb"]+$_SESSION["spp"]+$_SESSION["book"]+$_SESSION["bimbel"];
        $_SESSION["topaid"] = $_SESSION["total"];
        if($params["sppcheckbox"]){
            $_SESSION["withspp"] = true;
            $_SESSION["spp"] = removedot($params["spp"]);
        }else{
            $_SESSION["withspp"] = false;
            $_SESSION["spp"] = 0;
        }
        if($params["bimbelcheckbox"]){
            $_SESSION["withbimbel"] = true;
            $_SESSION["bimbel"] = removedot($params["bimbel"]);
        }else{
            $_SESSION["withbimbel"] = false;
            $_SESSION["bimbel"] = 0;
        }
        $_SESSION["withbimbel"] = "";
        $_SESSION["totaltagihan"] = "0";
        $_SESSION["sppremain"] = $sppremain["sppremain"];
        $_SESSION["bimbelremain"] = "0";
        $_SESSION["dupsbremain"] = "0";
        $_SESSION["bookpaymentremain"] = "0";
        $_SESSION["periodmonths"] = getperiodmonths();
        $_SESSION["spptext"] = $this->processsppstring();
        $_SESSION["username"] = $_SESSION["username"];
        echo "SPP Text" . $_SESSION["spptext"] . $this->crlf;
    }
    function spp(){
        session_start();
        checklogin();
        $this->load->helper("form");
        $data = array(
            "breadcrumb" => array(1=>"Pembayaran",2=>"SPP"),
            "formtitle"=>"Pembayaran SPP",
            "feedData"=>"cashier",
            "months"=>$this->dates->getmonthsarray(),
            "years"=>$this->dates->getyearsarray(),
            "curmonth"=>date('m'),
            "curyear"=>date("Y"),
            "err_message"=>"",
            "role"=>$this->User->getrole($_SESSION["userid"]),
        );
        $this->load->view("simulator/spp",$data);    }
}