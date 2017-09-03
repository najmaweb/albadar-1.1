<?php
class Cashier extends CI_Controller{
    public $crlf;
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Spppayment");
        $this->load->model("Bimbelpayment");
        $this->load->model("Dupsbpayment");
        $this->load->model("Bukupayment");
        $this->load->model("Receipt");
        $this->load->model("Student");
        $this->crlf = "<br />";
    }
    function attr(){
        $nis = $this->uri->segment(3);
        $payment = new Spppayment($nis);
        $sppmaxyearmonth = $this->Spppayment->getsppmaxyearmonth();
        $sppremain = $payment->getsppremain(date("m",date("Y")));
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
    function kwitansi(){
        session_start();
        checklogin();
        $params = array(
            //"allpaid"=>$_SESSION["allpaid"],
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
            //"cashpay"=>$_SESSION["cashpay"],
            "dupsbremain"=>$_SESSION["dupsbremain"],
            //"dupsbpaid"=>$_SESSION["dupsbpaid"],
            "bookpaymentremain"=>$_SESSION["bookpaymentremain"],
            //"bookpaymentpaid"=>$_SESSION["bookpaymentpaid"],
            "totaltagihan"=>$_SESSION["totaltagihan"],
            "bimbel"=>$_SESSION["bimbel"],
            "total"=>$_SESSION["total"],
            "sppmonthcount"=>$_SESSION["sppmonthcount"],
            "bimbelmonthcount"=>$_SESSION["bimbelmonthcount"],
            "monthsarray"=>$this->dates->getmonthsarray(),
            "role"=>$this->User->getrole($_SESSION["userid"]),
            "periodmonths"=>getperiodmonths(),
            //"tagihanremain"=>$_SESSION["tagihanremain"],
            "sppremain"=>$_SESSION["sppremain"],
            "bimbelremain"=>$_SESSION["bimbelremain"],
            "kwitansi"=>$_SESSION["receiptno"]
        );
        $params["topaid"] = $_SESSION["total"];
        $this->load->view("cashiers/kwitansi",$params);        
    }
    function previewkwitansi(){
        session_start();
        $this->load->view("cashiers/previewkwitansi");
    }
    function processsppstring(){
        $out = "Pembayaran SPP bulan " . $_SESSION["sppfrstmonth"];
        $out.= "-" . $_SESSION["sppfrstyear"];
        $out.= " s/d " . $_SESSION["sppnextmonth"];
        $out.= " - " . $_SESSION["sppnextyear"];
        return $out;
    }
    function processbimbelstring(){
        $out = "Pembayaran Bimbel bulan " . $_SESSION["bimbelfrstmonth"];
        $out.= "-" . $_SESSION["bimbelfrstyear"];
        $out.= " s/d " . $_SESSION["bimbelnextmonth"];
        $out.= " - " . $_SESSION["bimbelnextyear"];
        return $out;
    }
    function processstring($subject){
        $out = "Pembayaran " . $subject . " ";
        return $out;
    }
    function savesession(){
        session_start();
        $params = $this->input->post();
        if(trim($params["nis"])===""){
            redirect("../../cashier");
        }
        $nis = $params["nis"];
        $payment = new Spppayment($nis);
        $sppmaxyearmonth = $this->Spppayment->getsppmaxyearmonth();
        
        if($_SESSION["withspp"]){
            $sppremain = $payment->getsppremain($_SESSION["sppnextmonth"],$_SESSION["sppnextyear"]);
        }else{
            $sppremain = $payment->getsppremain();
        }
        $cursppbill = $payment->getcurrmonthsppbill();
        $bimbel = new Bimbelpayment($nis);
        $bimbelmaxyearmonth = $this->Bimbelpayment->getbimbelmaxyearmonth();
        if($_SESSION["withbimbel"]){
            $bimbelremain=$bimbel->getbimbelremain($_SESSION["bimbelnextmonth"],$_SESSION["bimbelnextyear"]);
        }else{
            $bimbelremain=$bimbel->getbimbelremain();
        }
        $curbimbelbill = $bimbel->getcurrmonthbimbelbill();
        $dupsb = new Dupsbpayment($nis);
        $dupsbremain = $dupsb->getdupsbremain();
        $buku = new Bukupayment($nis);
        $bookpayment = $buku->getbukuremain();
        $_SESSION["sppfrstmonth"] = $params["sppfrstmonth"];
        $_SESSION["studentname"] = $params["studentname"];
        $_SESSION["sppfrstyear"] = $params["sppfrstyear"];
        $_SESSION["sppnextmonth"] = $params["sppnextmonth"];
        $_SESSION["sppnextyear"] = $params["sppnextyear"];
        $_SESSION["nis"]=$params["nis"];
        $_SESSION["spp"] = $params["spp"];
        $_SESSION["bimbel"]="";
        $_SESSION["bimbelfrstyear"]=$params["bimbelfrstyear"];;
        $_SESSION["bimbelfrstmonth"]=$params["bimbelfrstmonth"];
        $_SESSION["bimbelnextyear"]=$params["bimbelnextyear"];
        $_SESSION["bimbelnextmonth"]=$params["bimbelnextmonth"];
        $_SESSION["psb"] = removedot($params["psb"]);
        $_SESSION["book"] = removedot($params["book"]);
        $_SESSION["orispp"]="";
        $_SESSION["oribimbel"]="";
        $_SESSION["grade"]="";
        if(isset($params["sppcheckbox"])){
            if(removedot($params["spp"])>0){
                $_SESSION["withspp"] = true;
                $_SESSION["spp"] = removedot($params["spp"]);
            }else{
                $_SESSION["withspp"] = false;
                $_SESSION["spp"] = 0;
            }
        }else{
            $_SESSION["withspp"] = false;
            $_SESSION["spp"] = 0;
        }
        if(isset($params["bimbelcheckbox"])){
            if(removedot($params["bimbel"])>0){
                $_SESSION["withbimbel"] = true;
                $_SESSION["bimbel"] = removedot($params["bimbel"]);
            }else{
                $_SESSION["withbimbel"] = false;
                $_SESSION["bimbel"] = 0;
            }
        }else{
            $_SESSION["withbimbel"] = false;
            $_SESSION["bimbel"] = 0;
        }
        if(isset($params["dupsbcheckbox"])){
            if(removedot($params["psb"])>0){
                $_SESSION["withdupsb"] = true;
                $_SESSION["psb"] = removedot($params["psb"]);
            }else{
                $_SESSION["withdupsb"] = false;
                $_SESSION["psb"] = 0;                
            }
        }else{
            $_SESSION["withdupsb"] = false;
            $_SESSION["psb"] = 0;
        }
        if(isset($params["bukucheckbox"])){
            if(removedot($params["book"])>0){
                $_SESSION["withbuku"] = true;
                $_SESSION["buku"] = removedot($params["book"]);
            }else{
                $_SESSION["withbuku"] = false;
                $_SESSION["buku"] = 0;                
            }
        }else{
            $_SESSION["withbuku"] = false;
            $_SESSION["book"] = 0;
        }
        $_SESSION["total"] = $_SESSION["psb"]+$_SESSION["spp"]+$_SESSION["book"]+$_SESSION["bimbel"];
        $_SESSION["topaid"] = $_SESSION["total"];
        $_SESSION["totaltagihan"] = "0";
        $_SESSION["sppremain"] = $sppremain["sppremain"];
        $_SESSION["bimbelremain"] = $bimbelremain["bimbelremain"];
        $_SESSION["dupsbremain"] = $dupsbremain;
        $_SESSION["bookpaymentremain"] = $bookpayment;
        $_SESSION["periodmonths"] = getperiodmonths();
        $_SESSION["spptext"] = $this->processsppstring();
        $_SESSION["bimbeltext"] = $this->processbimbelstring();
        $_SESSION["booktext"] = $this->processstring("buku");
        $_SESSION["dupsbtext"] = $this->processstring("DU / PSB");
        $_SESSION["username"] = $_SESSION["username"];
        $_SESSION["sppmonthcount"] = $this->getsppmonthcount();
        $_SESSION["bimbelmonthcount"] = $this->getbimbelmonthcount();
        redirect("../../cashier/previewkwitansi");
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
            "role"=>1,
        );
        $this->load->view("cashiers/spp",$data);
    }
    function getsppmonthcount(){
        $sppmonthcount = 1;
        if($_SESSION["sppfrstyear"] === $_SESSION["sppnextyear"]){
            $sppmonthcount += $_SESSION["sppnextmonth"] - $_SESSION["sppfrstmonth"];
        }
        if($_SESSION["sppnextyear"] < $_SESSION["sppfrstyear"]){
            $firstyearmonthcount = 12 - $_SESSION["sppfrstmonth"];
            $yearcount = $_SESSION["sppnextyear"] - $_SESSION["sppfrstyear"];
            $lastyearmonthcount = $_SESSION["sppnextmonth"]; 
            $sppmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        return $sppmonthcount;
    }
    function getbimbelmonthcount(){
        $bimbelmonthcount = 1;
        if($_SESSION["bimbelfrstyear"] === $_SESSION["bimbelnextyear"]){
            $bimbelmonthcount += $_SESSION["bimbelnextmonth"] - $_SESSION["bimbelfrstmonth"];
        }
        if($_SESSION["bimbelnextyear"] < $_SESSION["bimbelfrstyear"]){
            $firstyearmonthcount = 12 - $_SESSION["bimbelfrstmonth"];
            $yearcount =$_SESSION["bimbelnextyear"] - $_SESSION["bimbelfrstyear"];
            $lastyearmonthcount = $_SESSION["bimbelnextmonth"]; 
            $bimbelmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        return $bimbelmonthcount;
    }
    function saveall(){
        session_start();
        $receiptno = $this->Receipt->save($_SESSION["nis"],$_SESSION["total"],$_SESSION["sppremain"],$_SESSION["dupsbremain"],$_SESSION["bimbelremain"],$_SESSION["bookpaymentremain"],date("Y"));
        $_SESSION["receiptno"] = $receiptno;
        $montharray = getmontharray($_SESSION["sppfrstmonth"],$_SESSION["sppfrstyear"],$_SESSION["sppnextmonth"],$_SESSION["sppnextyear"]);
        $bimbelmontharray = getmontharray($_SESSION["bimbelfrstmonth"],$_SESSION["bimbelfrstyear"],$_SESSION["bimbelnextmonth"],$_SESSION["bimbelnextyear"]);
        $student = new Student();
        $payment = new Spppayment($_SESSION["nis"]);
        if($_SESSION["withspp"]){
            foreach($montharray as $monthyear){
                $month = substr($monthyear,0,2);
                $year = substr($monthyear,2,4);
                $purpose = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $description = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $this->Spppayment->save($_SESSION["nis"],$receiptno,$student->getspp($_SESSION["nis"]),$year,$month,$this->Setting->getcurrentyear(),$purpose,$description,$_SESSION["username"]);
            }
            $spp = $payment->getsppamount();
            $sppamount = $spp*count($montharray);
            $payment->savedetail($receiptno,$this->processsppstring(),$sppamount);
        }
        if($_SESSION["withbimbel"]){
            foreach($bimbelmontharray as $monthyear){
                $month = substr($monthyear,0,2);
                $year = substr($monthyear,2,4);
                $purpose = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
                $description = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
                $this->Bimbelpayment->save($_SESSION["nis"],$receiptno,$student->getbimbel($_SESSION["nis"]),$year,$month,$this->Setting->getcurrentyear(),$purpose,$description,$_SESSION["username"]);
            }
            $bimbelpayment = new Bimbelpayment($_SESSION["nis"]);
            $bimbel = $bimbelpayment->getbimbelamount();
            $bimbelamount = $bimbel*count($montharray);
            $payment->savedetail($receiptno,$this->processbimbelstring(),$bimbelamount);
        }
        if($_SESSION["withdupsb"]){
            $this->Dupsbpayment->save($_SESSION["nis"],$receiptno,$_SESSION["psb"],$this->Setting->getcurrentyear(),"1",$purpose,$description,$_SESSION["username"]);
            $dupsbamount = $_SESSION["psb"];
            $payment->savedetail($receiptno,"Pembbayaran DU/PSB",$dupsbamount);
        }
        if($_SESSION["withbuku"]){
            $this->Bukupayment->save($_SESSION["nis"],$receiptno,$_SESSION["book"],$this->Setting->getcurrentyear(),"1",$purpose,$description,$_SESSION["username"]);
            $bukuamount = $_SESSION["book"];
            $payment->savedetail($receiptno,"Pembayaran Buku",$bukuamount);
        }
    }
}