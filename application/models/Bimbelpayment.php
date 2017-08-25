<?php
class Bimbelpayment extends CI_Model{
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
    function getbimbelamount(){
        $sql = "select amount from studentshistory a ";
        $sql.= "left outer join bimbelgroups b on b.id=a.bimbelgroup_id ";
        $sql.= "where a.nis='".$this->nis."' and a.year=date_format(now(),'%Y')";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        return $res[0]->amount;
    }
    function getcurrmonthbimbelbill(){
        $sql = "select amount from bimbel where nis='".$this->nis."'";
        $sql.= "and pyear=date_format(now(),'%Y') and pmonth=date_format(now(),'%m') ";
        $que = $this->ci->db->query($sql);
        if($que->num_rows()>0){
            $res = $que->result();
            return "0";
        }
        return $this->getbimbelamount();
    }
    function getlastbimbelpayment(){
        $sql = "select A.pyear,A.pmonth from ";
        $sql.= "(select pyear,max(pmonth)pmonth from bimbel where nis='".$this->nis."' group by pyear)A ";
        $sql.= "right outer join ";
        $sql.= "(select max(pyear)pyear from bimbel where nis='".$this->nis."' )B on B.pyear=A.pyear ";
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
    function getbimbelmaxyearmonth(){
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
        $sql.= "(select max(pyear)mpyear,max(pmonth)mpmonth from bimbel where nis='".$this->nis."' ) X ";
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        $out = $res->result();
        return array(
            "maxyear"=>$out[0]->mpyear,
            "maxmonth"=>$out[0]->mpmonth,
            "status"=>$out[0]->paymentstatus,
        );
    }
    function getbimbelremain(){
        $comment = "MENAMPILKAN SISA TANGGUNGAN.";
        $comment.= "DIHITUNG DARI BULAN SEBELUM SAAT INI HINGGA TERAKHIR DILAKUKAN PEMBAYARAN";
        $bimbelamount = $this->getbimbelamount();
        $lastbimbelpayment = $this->getbimbelmaxyearmonth();
        if(date("Y")===$lastbimbelpayment["maxyear"]){
            if((date("m") - 1)<=$lastbimbelpayment["maxmonth"]){
                $status = "TIDAK ADA SISA TANGGUNGAN";
                $monthcount = 0;
            }elseif((date("m") - 1)>$lastbimbelpayment["maxmonth"]){
                $status = "ADA KEKURANGAN DI TAHUN YANG SAMA";
                $monthcount = (date("m") - 1) - $lastbimbelpayment["maxmonth"];
            }
        }elseif(date("Y")>$lastbimbelpayment["maxyear"]){
            $yearcount = date("Y") - $lastbimbelpayment["maxyear"];
            $premonths = 12 - $lastbimbelpayment["maxmonth"];
            $postmonths = date("m") - 1;
            $status = "ADA KEKURANGAN DI TAHUN YANG BERBEDA";
            $monthcount = 12*$yearcount+$premonths+$postmonths;
        }
        return array(
            "bimbelremain"=>$bimbelamount*$monthcount,
            "monthcount"=>$monthcount,
            "status"=>$status,"comment"=>$comment
        );
    }
    function save($nis,$receiptno,$amount,$pyear,$pmonth,$cyear,$paymenttype,$purpose,$description,$createuser){
        $sql = "insert into bimbel ";
        $sql.= "(nis,receiptno,amount,pyear,pmonth,cyear,paymenttype,purpose,description,createuser) ";
        $sql.= "values ";
        $sql.= "(";
        $sql.= "'".$nis."',";
        $sql.= "'".$receiptno."',";
        $sql.= "'".$amount."',";
        $sql.= "'".$pyear."',";
        $sql.= "'".$pmonth."',";
        $sql.= "'".$cmonth."',";
        $sql.= "'".$paymenttype."',";
        $sql.= "'".$purpose."',";
        $sql.= "'".$description."',";
        $sql.= "'".$createuser."'";
        $sql.= ")";
        $this->ci->db->query($sql);
    }
}