<?php
class Simulator extends CI_Controller{
    public $crlf;
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Payment");
        $this->crlf = "<br />";
    }
    function index(){
        $nis = $this->uri->segment(3);
        $payment = new Payment($nis);
        $sppmaxyearmonth = $this->Mcashier->getsppmaxyearmonth($nis);
        echo "Bulan Tahun sekarang " . date("m-Y") . $this->crlf;
        echo "Name " . $payment->getname() . $this->crlf;
        echo "Pembayaran SPP Terakhir " 
            . $sppmaxyearmonth["maxmonth"] 
            . "-" 
            . $sppmaxyearmonth["maxyear"] 
            . $this->crlf;
        $lastspppayment = $payment->getlastspppayment();
        echo "Last Month " . $lastspppayment["maxmonth"] . $this->crlf;
        echo "Last Year " . $lastspppayment["maxyear"] . $this->crlf;
        echo "Curr spp bill " . $payment->getcurrmonthsppbill();
    }
}