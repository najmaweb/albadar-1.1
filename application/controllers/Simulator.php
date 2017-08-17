<?php
class Simulator extends CI_Controller{
    public $crlf;
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Spppayment");
        $this->crlf = "<br />";
    }
    function index(){
        $nis = $this->uri->segment(3);
        $payment = new Spppayment($nis);
        $sppmaxyearmonth = $this->Spppayment->getsppmaxyearmonth();
        $sppremain=$payment->getsppremain();
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
    }
}