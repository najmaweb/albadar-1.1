<?php
class Receipts extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Receipt");
        $this->load->helper("terbilang");
        $this->load->helper("datetime");
    }
    function create(){
        $this->load->model("Receipt");
        echo $this->Receipt->create();
    }
    function getmax(){
        $this->load->model("Receipt");
        echo $this->Receipt->getmax(date("m"));
    }
    function index(){
        session_start();
        $data = array(
            "title"=>"Daftar Kwitansi",
            "feedData"=>"receipts",
            "role"=>"1",
            "objs"=>$this->Receipt->getreceipts()
        );
        $this->load->view("receipts/index",$data);
    }
    function previewkwitansi(){
        session_start();
        $id = $this->uri->segment(3);
        $receipt = $this->Receipt->getreceipt($id);
        $data = array(
            "nis"=>$receipt->nis,
            "sppfrstmonth"=>"","sppnextmonth"=>"",
            "sppfrstyear"=>"","sppnextyear"=>"",
            "spp"=>$receipt->spp,"bimbel"=>$receipt->bimbel,
            "bimbelfrstyear"=>"","bimbelfrstmonth"=>"",
            "bimbelnextyear"=>"","bimbelnextmonth"=>"",
            "psb"=>$receipt->psb,"book"=>$receipt->book,
            "orispp"=>"","oribimbel"=>"","sppcheckbox"=>"",
            "grade"=>$receipt->grade,"topaid"=>0,"total"=>$receipt->total,
            "receiptno"=>$receipt->receiptno,
            "receiptdetails"=>$this->Receipt->getreceiptdetails($receipt->receiptno),
            "monthsarray"=>getmontharray("01","2017","03","2017"),
            "studentname"=>$receipt->name,
            "totaltagihan"=>0,
            "sppremain"=>$receipt->sppremain,
            "bimbelremain"=>$receipt->bimbelremain,
            "dupsbremain"=>$receipt->dupsbremain,
            "bookpaymentremain"=>$receipt->bookremain,
            "periodmonths" => getperiodmonths(),
            "receiptid"=>$id,
        );
        $this->load->view("receipts/previewkwitansi",$data);
    }
    function kwitansi(){
        session_start();
        $id = $this->uri->segment(3);
        $receipt = $this->Receipt->getreceipt($id);
        $data = array(
            "nis"=>$receipt->nis,
            "sppfrstmonth"=>"","sppnextmonth"=>"",
            "sppfrstyear"=>"","sppnextyear"=>"",
            "spp"=>$receipt->spp,"bimbel"=>$receipt->bimbel,
            "bimbelfrstyear"=>"","bimbelfrstmonth"=>"",
            "bimbelnextyear"=>"","bimbelnextmonth"=>"",
            "psb"=>$receipt->psb,"book"=>$receipt->book,
            "orispp"=>"","oribimbel"=>"","sppcheckbox"=>"",
            "grade"=>$receipt->grade,"topaid"=>0,"total"=>$receipt->total,
            "receiptno"=>$receipt->receiptno,
            "receiptdetails"=>$this->Receipt->getreceiptdetails($receipt->receiptno),
            "monthsarray"=>getmontharray("01","2017","03","2017"),
            "studentname"=>$receipt->name,
            "totaltagihan"=>0,
            "sppremain"=>0,
            "bimbelremain"=>0,
            "dupsbremain"=>0,
            "bookpaymentremain"=>0,
            "periodmonths" => getperiodmonths()
        );
        $this->load->view("receipts/kwitansi",$data);
    }
    function save(){
        $this->load->model("Receipt");
        echo $this->Receipt->save();
    }
}