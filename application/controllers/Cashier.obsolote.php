<?php
class Cashier extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Student");
        $this->load->helper("terbilang");
        $this->load->library("Dates");
        $this->load->helper("datetime");
        $this->load->model("Receipt");
    }
    function index(){
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
        $this->load->view("cashiers/spp",$data);
    }
    function checksession(){
        if (session_status() == PHP_SESSION_NONE) {
            if(!isset($_SESSION["username"])){
                redirect("../../main/login");
            }
            echo $_SESSION["username"];
        }
    }
    function savesession(){
        session_start();
        checklogin();
        $CHECKSESSION = false;
        if($CHECKSESSION){
            $this->checksession();
        }
        $params = $this->input->post();
        if(isset($params["sppcheckbox"])){
            $withspp = true;
            $_SESSION["withspp"] = true;
        }else{
            $withspp = false;
            $_SESSION["withspp"] = false;            
        }
        if(isset($params["bimbelcheckbox"])){
            $withbimbel = true;
            $_SESSION["withbimbel"] = true;
        }else{
            $withbimbel = false;
            $_SESSION["withbimbel"] = false;            
        }
        if(!isset($params["sppfrstyear"])){
            redirect("../");
        }
        $currentyear = $this->dates->getcurrentyear();
        $DEBUG = false;
        if($DEBUG){
            foreach($params as $key=>$val){
                echo $key . ' : ' . $val;
            }
        }
        $montharray = array();
        $sppmonthcount = 1;
        if($params["sppfrstyear"]===$params["sppnextyear"]){
            $sppmonthcount += $params["sppnextmonth"] - $params["sppfrstmonth"];
        }
        if($params["sppnextyear"]<$params["sppfrstyear"]){
            $firstyearmonthcount = 12-$params["sppfrstmonth"];
            $yearcount = $params["sppnextyear"] - $params["sppfrstyear"];
            $lastyearmonthcount = $params["sppnextmonth"]; 
            $sppmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        $bimbelmonthcount = 1;
        if($params["bimbelfrstyear"]===$params["bimbelnextyear"]){
            $bimbelmonthcount += $params["bimbelnextmonth"] - $params["bimbelfrstmonth"];
        }
        if($params["bimbelnextyear"]<$params["bimbelfrstyear"]){
            $firstyearmonthcount = 12-$params["bimbelfrstmonth"];
            $yearcount = $params["bimbelnextyear"] - $params["bimbelfrstyear"];
            $lastyearmonthcount = $params["bimbelnextmonth"]; 
            $bimbelmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        $_SESSION["sppfrstmonth"] = $params["sppfrstmonth"];
        $_SESSION["sppfrstyear"] = $params["sppfrstyear"];
        $_SESSION["sppnextmonth"] = $params["sppnextmonth"];
        $_SESSION["sppnextyear"] = $params["sppnextyear"];
        $_SESSION["nis"] = $params["nis"];
        $_SESSION["studentname"] = $params["studentname"];
        if($withspp){
            $_SESSION["spp"] = removedot($params["spp"]);
        }else{
            $_SESSION["spp"] = 0;
        }
        $_SESSION["bimbelfrstyear"] = $params["bimbelfrstyear"];
        $_SESSION["bimbelfrstmonth"] = $params["bimbelfrstmonth"];
        $_SESSION["bimbelnextmonth"] = $params["bimbelnextmonth"];
        $_SESSION["bimbelnextyear"] = $params["bimbelnextyear"];
        $_SESSION["psb"] = removedot($params["psb"]);
        $_SESSION["book"] = removedot($params["book"]);
        $_SESSION["grade"] = $params["grade"];
        $_SESSION["cashpay"] = removedot($params["cashpay"]);
        if($withbimbel){
            $_SESSION["bimbel"] = removedot($params["bimbel"]);
        }else{
            $_SESSION["bimbel"] = 0;
        }
        $_SESSION["dupsbpaid"] = $this->Mcashier->getdupsbpaid($params["nis"],$currentyear);
        $_SESSION["bookpaymentpaid"] = $this->Mcashier->getbookpaymentpaid($params["nis"],$currentyear);
        $_SESSION["allpaid"] = $this->Mcashier->getallpaid($params["nis"],$currentyear);
        
        $_SESSION["total"] = $_SESSION["psb"]+$_SESSION["spp"]+$_SESSION["book"]+$_SESSION["bimbel"];
        $_SESSION["sppmonthcount"] = $sppmonthcount;
        $_SESSION["bimbelmonthcount"] = $bimbelmonthcount;
        $_SESSION["orispp"] = $params["orispp"];
        $_SESSION["oribimbel"] = $params["oribimbel"];
        $total = 0;
        $total+= $this->Mcashier->getdupsbremain($params["nis"],$currentyear);
        $total+= $this->Student->getspp($params["nis"]);
        $total+= $this->Student->getbimbel($params["nis"]);
        $total+= $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        
        $dupsbremain = $this->Mcashier->getdupsbremain($params["nis"],$currentyear);
        $bookpaymentremain = $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        //$currentsppbill = $this->Mcashier->getcurrsppbill($params["nis"]);
        $sppremain = $this->Mcashier->getsppremain($params["nis"])["tagihan"];
        $bimbelremain = $this->Mcashier->getbimbelremain($params["nis"])["tagihan"];
        $currentsppbill = $this->Mcashier->getcurrsppbill($params["nis"]);
        $_SESSION["currentsppbill"] = $currentsppbill;
        $_SESSION["currentbimbelbill"] = $this->Mcashier->getcurrbimbelbill($params["nis"]);
        $_SESSION["totaltagihan"] = $dupsbremain
            +$bookpaymentremain
            +$sppremain
            +$bimbelremain
            +$this->Mcashier->getcurrsppbill($params["nis"])
            +$this->Mcashier->getcurrbimbelbill($params["nis"]);
        
        $remain = 0;
        $remain+= $this->Mcashier->gettotaltagihan($params["nis"],$currentyear);
        $remain+= $this->Student->getspp($params["nis"]);
        $remain+= $this->Student->getbimbel($params["nis"]);
        $remain-=$params["spp"];
        $remain-=$params["bimbel"];
        $remain-=$params["book"];
        $remain-=removedot($params["psb"]);
        $_SESSION["tagihanremain"] = $remain;
        $_SESSION["sppremain"] = $sppremain;
        $_SESSION["bimbelremain"] = $bimbelremain;
        $_SESSION["dupsbremain"] = $this->Mcashier->getdupsbremain($params["nis"],$currentyear) - removedot($params["psb"]);
        $_SESSION["bookpaymentremain"] = $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        if(isset($params["sppcheckbox"])){
            $_SESSION["sppcheckbox"] = "1";
        }else{
            $_SESSION["sppcheckbox"] = "0";
        }
        $this->previewkwitansi();
    }
    function previewkwitansi(){
        $check = true;
        $DEBUG = false;
        if((!isset($_SESSION["studentname"])||trim($_SESSION["studentname"]===""))){
            $check = false;
            $err_msg = "Siswa belum dipilih";
        }
        if((trim($_SESSION["cashpay"]===""))||($_SESSION["cashpay"]==="0")){
            $check = false;
            $err_msg = "Jumlah Pembayaran tidak boleh kosong";
        }
        $monthsarray = $this->dates->getmonthsarray();
        $sppfrstmonth=$_SESSION["sppfrstmonth"];
        $sppfrstyear=$_SESSION["sppfrstyear"];
        $sppnextmonth=$_SESSION["sppnextmonth"];
        $sppnextyear=$_SESSION["sppnextyear"];
        $sppmonthcount=$_SESSION["sppmonthcount"];

        $bimbelfrstyear=$_SESSION["bimbelfrstyear"];
        $bimbelfrstmonth=$_SESSION["bimbelfrstmonth"];
        $bimbelnextmonth=$_SESSION["bimbelnextmonth"];
        $bimbelnextyear=$_SESSION["bimbelnextyear"];
        $bimbelmonthcount=$_SESSION["bimbelmonthcount"];

        $spptext = "SPP ";
        $spptext.= $monthsarray[$sppfrstmonth];
        $spptext.= " " . $sppfrstyear;
        $spptext.= " - ";
        $spptext.= $monthsarray[$sppnextmonth];
        $spptext.= " " . $sppnextyear;
        $spptext.= " (" . $sppmonthcount . " bulan)";
        $bimbeltext ="Bimbel ";
        $bimbeltext.= $monthsarray[$bimbelfrstmonth];
        $bimbeltext.= " " . $bimbelfrstyear;
        $bimbeltext.= " - " . $monthsarray[$bimbelnextmonth];
        $bimbeltext.= " " . $bimbelnextyear;
        $bimbeltext.= " (". $bimbelmonthcount." bulan)";
        $params = array(
            "sppfrstmonth"=>$_SESSION["sppfrstmonth"],
            "sppfrstyear"=>$_SESSION["sppfrstyear"],
            "sppnextmonth"=>$_SESSION["sppnextmonth"],
            "sppnextyear"=>$_SESSION["sppnextyear"],
            "nis"=>$_SESSION["nis"],
            "studentname"=>$_SESSION["studentname"],
            "spp"=>$_SESSION["spp"],
            "bimbelfrstyear"=>$_SESSION["bimbelfrstyear"],
            "bimbelfrstmonth"=>$_SESSION["bimbelfrstmonth"],
            "bimbelnextmonth"=>$_SESSION["bimbelnextmonth"],
            "bimbelnextyear"=>$_SESSION["bimbelnextyear"],
            "psb"=>$_SESSION["psb"],
            "book"=>$_SESSION["book"],
            "grade"=>$_SESSION["grade"],
            "cashpay"=>$_SESSION["cashpay"],
            "bimbel"=>$_SESSION["bimbel"],
            "dupsbremain"=>$_SESSION["dupsbremain"],
            "dupsbpaid"=>$_SESSION["dupsbpaid"],
            "bookpaymentremain"=>$_SESSION["bookpaymentremain"],
            "bookpaymentpaid"=>$_SESSION["bookpaymentpaid"],
            "allpaid"=>$_SESSION["allpaid"],
            "totaltagihan"=>$_SESSION["totaltagihan"],
            "total"=>$_SESSION["total"],
            "sppmonthcount"=>$_SESSION["sppmonthcount"],
            "bimbelmonthcount"=>$_SESSION["bimbelmonthcount"],
            "monthsarray"=>$this->dates->getmonthsarray(),
            "orispp"=>$_SESSION["orispp"],
            "oribimbel"=>$_SESSION["oribimbel"],
            "sppcheckbox"=>$_SESSION["sppcheckbox"],
            "role"=>$this->User->getrole($_SESSION["userid"]),
            "periodmonths"=>getperiodmonths(),
            "tagihanremain"=>$_SESSION["tagihanremain"],
            "sppremain"=>$_SESSION["sppremain"],
            "bimbelremain"=>$_SESSION["bimbelremain"],
            "spptext"=>$spptext,
            "bimbeltext"=>$bimbeltext,
            "withspp"=>$_SESSION["withspp"],
            "withbimbel"=>$_SESSION["withbimbel"],
        );
        if($DEBUG){
            echo "SPP : ". $_SESSION["spp"] . "<br />";
            echo "psb : ". $_SESSION["psb"] . "<br />";
            echo "book : ". $_SESSION["book"] . "<br />";
            echo "Bimbel : ". $_SESSION["bimbel"] . "<br />";
            echo "total : ". $_SESSION["total"] . "<br />";
            echo "dupsbpaid : ". $_SESSION["dupsbpaid"] . "<br />";
        }
        if((!$check)){
            $this->load->library("Dates");
            $this->load->helper("form");
            $data = array(
                "breadcrumb" => array(1=>"Pembayaran",2=>"SPP"),
                "formtitle"=>"Pembayaran SPP",
                "feedData"=>"cashier",
                "months"=>$this->dates->getmonthsarray(),
                "years"=>$this->dates->getyearsarray(),
                "curmonth"=>date('m'),
                "curyear"=>date("Y"),
                "err_message"=>" (".$err_msg.")",
                "role"=>$this->User->getrole($_SESSION["userid"]),
            );
            $this->load->view("cashiers/spp",$data);
        }else{
            $params["topaid"] = $_SESSION["total"];
            $this->load->view("cashiers/previewkwitansi",$params);
        }
    }
    function saveall(){
        $params = $this->input->post();
        session_start();
        checklogin();
        $text = "test";
        if($_SESSION["spp"]){
            $text = "SPP" . $monthsarray[$sppfrstmonth] . " " . $sppfrstyear." - ". $monthsarray[$sppnextmonth] . " " . $sppnextyear." (". $sppmonthcount." bulan)". "Rp. " . number_format($spp);
        }
        $receipt = $this->Receipt->save($_SESSION["nis"],$this->Setting->getcurrentyear());
        $receiptdetail = $this->Receipt->savedetail($receipt,$text);
        $params["receiptno"] = $receipt;
        $_SESSION["receiptno"] = $receipt;
        $this->savebimbel($params);
        $this->savespp($params);
    }
    function savebimbel($params){
        $montharray = getmontharray($params["bimbelfrstmonth"],$params["bimbelfrstyear"],$params["bimbelnextmonth"],$params["bimbelnextyear"]);
        foreach($montharray as $monthyear){
            $month = substr($monthyear,0,2);
            $year = substr($monthyear,2,4);
            $purpose = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
            $description = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
            $sql = "insert into bimbel ";
            $sql.= "(receiptno,nis,amount,pyear,pmonth,cyear,paymenttype,purpose,description,createuser) ";
            $sql.= "values ";
            $sql.= "('";
            $sql.= $params["receiptno"]."','";
            $sql.= $params["nis"]."','";
            $sql.= $params["oribimbel"]."','";
            $sql.= $year."','";
            $sql.= $month."','";
            $sql.= $this->dates->getcurrentyear()."','1','";
            $sql.= $purpose."','".$description."','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function savespp($params){
        //session_start();
        $montharray = getmontharray($params["sppfrstmonth"],$params["sppfrstyear"],$params["sppnextmonth"],$params["sppnextyear"]);
        //if($params["sppcheckbox"]>0){
            foreach($montharray as $monthyear){
                $month = substr($monthyear,0,2);
                $year = substr($monthyear,2,4);
                $purpose = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $description = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $sql = "insert into spp ";
                $sql.= "(receiptno,nis,amount,pyear,pmonth,cyear,paymenttype,purpose,description,createuser) ";
                $sql.= "values ";
                $sql.= "('".$params["receiptno"]."','".$params["nis"]."','";
                $sql.= $params["orispp"]."','";
                $sql.= $year."','";
                $sql.= $month."','";
                $sql.= $this->dates->getcurrentyear()."','1','";
                $sql.= $purpose."','";
                $sql.= $description."','";
                $sql.= $_SESSION["username"]."')";
                $ci = & get_instance();
                $que = $ci->db->query($sql);
            }
        //}
        //echo $montharray[0];
        $this->savedupsb($params);
        $this->savepembayaranbuku($params);
        $this->kwitansi($params);
    }
    function savedupsb($params){
        if($params["psb"]>0){
            $this->load->library("Dates");
            $currentyear = $this->dates->getcurrentyear();
            $sql = "insert into dupsb ";
            $sql.= "(receiptno,nis,amount,year,paymenttype,purpose,description,createuser) ";
            $sql.= "values ";
            $sql.= "('".$params["receiptno"]."','".$params["nis"]."','";
            $sql.= $params["psb"]."','";
            $sql.= $currentyear."','1','Pembayaran DU/PSB','Pembayaran DU/PSB','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function savepembayaranbuku($params){
        if($params["book"]>0){
            $this->load->library("Dates");
            $currentyear = $this->dates->getcurrentyear();
            $sql = "insert into bookpayment ";
            $sql.= "(receiptno,nis,amount,year,paymenttype,createuser) ";
            $sql.= "values ";
            $sql.= "('".$params["receiptno"]."','".$params["nis"]."','".$params["book"]."','".$currentyear."','1','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function kwitansi(){
        session_start();
        checklogin();
        $params = array(
            "allpaid"=>$_SESSION["allpaid"],
            "sppfrstmonth"=>$_SESSION["sppfrstmonth"],
            "sppfrstyear"=>$_SESSION["sppfrstyear"],
            "sppnextmonth"=>$_SESSION["sppnextmonth"],
            "sppnextyear"=>$_SESSION["sppnextyear"],
            "nis"=>$_SESSION["nis"],
            "studentname"=>$_SESSION["studentname"],
            "spp"=>$_SESSION["spp"],
            "bimbelfrstyear"=>$_SESSION["bimbelfrstyear"],
            "bimbelfrstmonth"=>$_SESSION["bimbelfrstmonth"],
            "bimbelnextmonth"=>$_SESSION["bimbelnextmonth"],
            "bimbelnextyear"=>$_SESSION["bimbelnextyear"],
            "psb"=>$_SESSION["psb"],
            "book"=>$_SESSION["book"],
            "grade"=>$_SESSION["grade"],
            "cashpay"=>$_SESSION["cashpay"],
            "dupsbremain"=>$_SESSION["dupsbremain"],
            "dupsbpaid"=>$_SESSION["dupsbpaid"],
            "bookpaymentremain"=>$_SESSION["bookpaymentremain"],
            "bookpaymentpaid"=>$_SESSION["bookpaymentpaid"],
            "totaltagihan"=>$_SESSION["totaltagihan"],
            "bimbel"=>$_SESSION["bimbel"],
            "total"=>$_SESSION["total"],
            "sppmonthcount"=>$_SESSION["sppmonthcount"],
            "bimbelmonthcount"=>$_SESSION["bimbelmonthcount"],
            "monthsarray"=>$this->dates->getmonthsarray(),
            "role"=>$this->User->getrole($_SESSION["userid"]),
            "periodmonths"=>getperiodmonths(),
            "tagihanremain"=>$_SESSION["tagihanremain"],
            "sppremain"=>$_SESSION["sppremain"],
            "bimbelremain"=>$_SESSION["bimbelremain"],
            "kwitansi"=>$_SESSION["receiptno"]
        );
        $params["topaid"] = $_SESSION["total"];
        $this->load->view("cashiers/kwitansi",$params);
    }
}