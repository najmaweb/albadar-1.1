<?php
class Spppayment extends CI_Model{
    public $nis;
    public $ci;
    function __construct($nis = null){
        parent::__construct();
        $this->ci = & get_instance();
        $this->load->helper("datetime");
        $this->nis = $nis;
    }
    function getname(){
        $sql = "select name from students where nis='".$this->nis."'";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        return $res[0]->name;
    }
    function getinitmonthyear(){
        $sql = "select initmonth,inityear from students where nis='".$this->nis."'";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        return array(
            "initmonth"=>$res[0]->initmonth,"inityear"=>$res[0]->inityear
        );
    }
    function getsppamount(){
        $sql = "select amount from studentshistory a ";
        $sql.= "left outer join sppgroups b on b.id=a.sppgroup_id ";
        $sql.= "where a.nis='".$this->nis."' and a.year=date_format(now(),'%Y')";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        return $res[0]->amount;
    }
    function getcurrmonthsppbill(){
        $sql = "select amount from spp where nis='".$this->nis."'";
        $sql.= "and pyear=date_format(now(),'%Y') and pmonth=date_format(now(),'%m') ";
        $que = $this->ci->db->query($sql);
        if($que->num_rows()>0){
            $res = $que->result();
            return "0";
        }
        return $this->getsppamount();
    }
    function getlastspppayment(){
        $sql = "select A.pyear,A.pmonth from ";
        $sql.= "(select pyear,max(pmonth)pmonth from spp where nis='".$this->nis."' group by pyear)A ";
        $sql.= "right outer join ";
        $sql.= "(select max(pyear)pyear from spp where nis='".$this->nis."' )B on B.pyear=A.pyear ";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if(is_null($res[0]->pmonth)){
            $initmonthyear = $this->getinitmonthyear();
            return array("maxmonth"=>$initmonthyear["initmonth"],"maxyear"=>$initmonthyear["inityear"]);
        }
        return array(
            "maxmonth"=>$res[0]->pmonth,"maxyear"=>$res[0]->pyear
        );
    }
    function getsppmaxyearmonth(){
        $thisyear = $this->Setting->getcurrentyear();
        $initmonth = $this->Setting->getinitmonth();
        $COMMENT = "LAST PAYMENT IS MONTH BEFORE INITMONTH";
        if($initmonth==="01"){
            $initmonth="12";
            $inityear = $thisyear - 1;
        }else{
            $initmonth = addzero($initmonth - 1);
            $inityear = $thisyear;
        }
        $sql = "select ";
        $sql.= "case when mpyear is null then '".$inityear."' else mpyear end mpyear, ";
        $sql.= "case when mpmonth is null then '".$initmonth."' else mpmonth end mpmonth, ";
        $sql.= "case when mpmonth is null then 'Belum bayar' else 'Sudah bayar' end paymentstatus ";
        $sql.= "from ";
        $sql.= "(select max(pyear)mpyear,max(pmonth)mpmonth from spp where nis='".$this->nis."' ) X ";
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        $out = $res->result();
        return array(
            "maxyear"=>$out[0]->mpyear,
            "maxmonth"=>$out[0]->mpmonth,
            "status"=>$out[0]->paymentstatus,
        );
    }
    function getsppremain(){
        $comment = "MENAMPILKAN SISA TANGGUNGAN.";
        $comment.= "DIHITUNG DARI BULAN SEBELUM SAAT INI HINGGA TERAKHIR DILAKUKAN PEMBAYARAN";
        $sppamount = $this->getsppamount();
        $lastspppayment = $this->getsppmaxyearmonth();
        $monthcount = 0;
        $status = "TIDAK ADA SISA TANGGUNGAN";
        if(date("Y")===$lastspppayment["maxyear"]){
            if((date("m") - 1)<=$lastspppayment["maxmonth"]){
                $status = "TIDAK ADA SISA TANGGUNGAN";
                $monthcount = 0;
            }elseif((date("m") - 1)>$lastspppayment["maxmonth"]){
                $status = "ADA KEKURANGAN DI TAHUN YANG SAMA";
                $monthcount = (date("m") - 1) - $lastspppayment["maxmonth"];
            }
        }elseif(date("Y")>$lastspppayment["maxyear"]){
            $yearcount = date("Y") - $lastspppayment["maxyear"];
            $premonths = 12 - $lastspppayment["maxmonth"];
            $postmonths = date("m") - 1;
            $status = "ADA KEKURANGAN DI TAHUN YANG BERBEDA";
            $monthcount = 12*$yearcount+$premonths+$postmonths;
        }
        return array(
            "sppremain"=>$sppamount*$monthcount,
            "monthcount"=>$monthcount,
            "status"=>$status,"comment"=>$comment
        );
    }
    function save($nis,$receiptno,$amount,$pyear,$pmonth,$cyear,$purpose,$description,$createuser){
        $sql = "insert into spp ";
        $sql.= "(nis,receiptno,amount,pyear,pmonth,cyear,purpose,description,createuser) ";
        $sql.= "values ";
        $sql.= "(";
        $sql.= "'".$nis."',";
        $sql.= "'".$receiptno."',";
        $sql.= "'".$amount."',";
        $sql.= "'".$pyear."',";
        $sql.= "'".$pmonth."',";
        $sql.= "'".$cyear."',";
        $sql.= "'".$purpose."',";
        $sql.= "'".$description."',";
        $sql.= "'".$createuser."'";
        $sql.= ")";
        $this->ci->db->query($sql);
    }
    function savedetail($receiptno,$description,$amount){
        $sql = "insert into receiptdetails ";
        $sql.= "(receiptno,description,amount,createuser) ";
        $sql.= "values ";
        $sql.= "('".$receiptno."','".$description."','".$amount."','".$_SESSION["username"]."') ";
        $this->ci->db->query($sql);
    }
}