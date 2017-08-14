<?php
class Tester extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function getterbilang(){
        $str = $this->uri->segment(3);
        $this->load->helper("currency");
        terbilang($str);
    }
    function get_terbilang(){
        $this->load->helper("terbilang");
        $str = $this->uri->segment(3);
        echo terbilang($str);
    }
    function getmonths(){
        $this->load->helper("datetime");
        echo "TEST Get Months <br />";
        $arr = getmontharray(1,2016,3,2017);
        foreach($arr as $key=>$val){
            echo $key . " and " . $val . "<br />";
        }
    }
    function addzero(){
        $str = $this->uri->segment(3);
        $this->load->helper("datetime");
        echo "TEST Add Zero <br />";
        echo addzero($str);
    }
    function phpinfo(){
        phpinfo();
    }
    function removezero(){
        $this->load->helper("datetime");
        $number = $this->uri->segment(3);
        echo removezero($number);
    }
    function getmax(){
        $nis = $this->uri->segment(3);
        $this->load->model("Mcashier");
        $remain = $this->Mcashier->getsppmaxyearmonth($nis);
        echo $remain["maxyear"] . "<br />";
        echo $remain["maxmonth"] . "<br />";
    }
    function getsppremain(){
        $this->load->model("Mcashier");
        $nis = $this->uri->segment(3);
        echo $this->Mcashier->getsppremain($nis)["tagihan"];
    }
    function changepassword(){
        $COMMENT = "INTERFACE FOR CHANGE PASSWORD ";
        $COMMENT.= "http://albadar/tester/changepassword/2/puji";
        $id= $this->uri->segment(3);
        $pass = $this->uri->segment(4);
        if ($this->User->changepassword($id,$pass)){
            echo "sukses";
        }else{
            echo "tidak sukses";
        };
    }
    function dupsbremain(){
        $this->load->model("Mcashier");
        echo "060477 -> " . $this->Mcashier->getdupsbremain("060477","2016").PHP_EOL;
        echo "060412 -> " . $this->Mcashier->getdupsbremain("060412","2016").PHP_EOL;
    }
    function bookpaymentremain(){
        $this->load->model("Mcashier");
        echo $this->Mcashier->getbookpaymentremain("060477","2016").PHP_EOL;
    }
    function getcurrsppbill(){
        $this->load->model("Mcashier");
        $nis = $this->uri->segment(3);//"060606";
        $currentsppbill = $this->Mcashier->getcurrsppbill($nis);
        echo $currentsppbill;
    }
    function showsessions(){
        session_start();
        foreach($_SESSION as $key=>$val){
            echo $key . " and " . $val . "<br />";
        }
    }
    function getbimbelremain(){
        $nis = $this->uri->segment(3);
        $this->load->model("Mcashier");
        echo $this->Mcashier->getbimbelremain($nis);
    }
    function getbimbelmaxyearmonth(){
        $this->load->model("Mcashier");
        echo $this->Mcashier->getbimbelmaxyearmonth($this->uri->segment(3))["maxyear"] . "<br />";
        echo $this->Mcashier->getbimbelmaxyearmonth($this->uri->segment(3))["maxmonth"];
    }
}