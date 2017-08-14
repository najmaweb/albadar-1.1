<?php
class Mcashier extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->model("Setting");
    }
    function getdupsbremain($nis,$year){
        $ci = & get_instance();
        $sql = "select A.nis,case when A.amnt is null then B.amount else (B.amount - A.amnt) end remain from ";
        $sql.= "(select a.nis,sum(amount)amnt from students a ";
        $sql.= "left outer join (select nis,amount from dupsb where year='".$year."') b on b.nis=a.nis where a.nis='".$nis."') A ";
        $sql.= "left outer join ";
        $sql.= "(select a.nis,amount from students a ";
        $sql.= "left outer join dupsbgroups b on b.id=a.dupsbgroup_id where a.nis='".$nis."') B on B.nis=A.nis ";
        $que = $ci->db->query($sql);
        return $que->result()[0]->remain;
    }
    function getdupsbpaid($nis,$year){
        $sql = "select sum(amount)amnt from dupsb a where nis='".$nis."' and year='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            return 0;
        }
        return $que->result()[0]->amnt;
    }
    function getbookpaymentremain($nis,$year){
        $ci = & get_instance();
        $sql = "select A.nis,case when A.amnt is null then B.amount else (B.amount - A.amnt) end remain from ";
        $sql.= "(select a.nis,sum(amount)amnt from students a ";
        $sql.= "left outer join (select nis,amount from bookpayment where year='".$year."') b on b.nis=a.nis where a.nis='".$nis."') A ";
        $sql.= "left outer join ";
        $sql.= "(select a.nis,amount from studentshistory a ";
        $sql.= "left outer join bookpaymentgroups b on b.id=a.bookpaymentgroup_id where a.nis='".$nis."' and a.year='".$year."') B on B.nis=A.nis ";
        $que = $ci->db->query($sql);
        return $que->result()[0]->remain;
    }
    function getbookpaymentpaid($nis,$year){
        $sql = "select sum(amount)amnt from bookpayment a where nis='".$nis."' and year='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            return 0;
        }
        return $que->result()[0]->amnt;
    }
    function getspppaid($nis,$year){
        $sql = "select sum(amount)amnt from spp a where nis='".$nis."' and cyear='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            return 0;
        }
        return $que->result()[0]->amnt;
    }
    function getbimbelpaid($nis,$year){
        $sql = "select sum(amount)amnt from bimbel a where nis='".$nis."' and cyear='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            return 0;
        }
        return $que->result()[0]->amnt;
    }
    function getallpaid($nis,$year){
        $ci = & get_instance();
        $cyear = $ci->dates->getcurrentyear();
        return $_SESSION["spp"] + $_SESSION["psb"] + $_SESSION["bimbel"] + $this->getdupsbpaid($nis,$year) + $this->getspppaid($nis,$cyear) + $this->getbimbelpaid($nis,$cyear);
    }
    function gettagihanremain($nis,$year){
        $ci = & get_instance();
        $cyear = $ci->dates->getcurrentyear();
        return $this->gettotaltagihan($nis,$year) - $this->getallpaid($nis,$year) - $this->getdupsbpaid($nis,$year) - $this->getspppaid($nis,$cyear) - $this->getbimbelpaid($nis,$cyear);
    }
    function gettotaltagihan($nis,$year){
        $sql = "select sum(b.amount)amnt from students a ";
        $sql.= "left outer join dupsbgroups b on b.id=a.dupsbgroup_id ";
        $sql.= "where nis='".$nis."' and a.year='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            return 0;
        }
        return $this->getdupsbremain($nis,$this->dates->getcurrentyear());
        return $que->result()[0]->amnt;
    }
    function getsppmaxyearmonth($nis){
        $thisyear = $this->Setting->getcurrentyear();
        $initmonth = $this->Setting->getinitmonth();
        $sql = "select ";
        $sql.= "case when mpyear is null then '".$thisyear."' else mpyear end mpyear, ";
        $sql.= "case when mpmonth is null then '".$initmonth."' else mpmonth end mpmonth ";
        $sql.= "from ";
        $sql.= "(select max(pyear)mpyear,max(pmonth)mpmonth from spp where nis='".$nis."' ) X ";
        
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        $out = $res->result();
        return array("maxyear"=>$out[0]->mpyear,"maxmonth"=>$out[0]->mpmonth);
    }
    function getsppremain($nis){
        $maxym = $this->getsppmaxyearmonth($nis);
        $spp = $this->getspp($nis);
        if($maxym["maxyear"]===date("Y")){
            if($maxym["maxmonth"]<date("m")){
                $tagihan = $spp*(removezero(date("m"))-removezero($maxym["maxmonth"]));
            }
            else{
                $tagihan = 0;
            }
        }else if($maxym["maxyear"]<date("Y")){
            $count = ((date("Y")-$maxym["maxyear"])*12)-$maxym["maxmonth"] + date("m");
            $COMMENT = "BANYAKNYA BULAN = SELISIH TAHUN x 12, DITAMBAH BULAN SAAT INI DIKURANGI BULAN TERAKHIR PEMBARAYARAN";
            $tagihan = $spp*$count;
        }else{
            $tagihan = 0;
        }
        return array("tagihan"=>$tagihan);
    }
    function getcurrsppbill($nis){
        $maxym = $this->getsppmaxyearmonth($nis);
        $spp = $this->getspp($nis);
        if($maxym["maxyear"]>date("Y")){
            $tagihan = 0;
        }elseif($maxym["maxyear"]===date("Y")){
            if($maxym["maxmonth"]>date("m")){
                $tagihan = 0;
            }else{
                $tagihan = $spp;
            }
        }else{
            $tagihan = $spp;
        }
        return $tagihan;
    }
    function getcurrbimbelbill($nis){
        $maxym = $this->getbimbelmaxyearmonth($nis);
        $bimbel = $this->getbimbel($nis);
        if($maxym["maxyear"]>date("Y")){
            $tagihan = 0;
        }elseif($maxym["maxyear"]===date("Y")){
            if($maxym["maxmonth"]>date("m")){
                $tagihan = 0;
            }else{
                $tagihan = $bimbel;
            }
        }else{
            $tagihan = $bimbel;
        }
        return $tagihan;
    }    
    function getspp($nis){
        $sql = "select nis,amount from students a left outer join sppgroups b on b.id=a.sppgroup_id where nis='".$nis."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0]->amount;
    }
    function getbimbelmaxyearmonth($nis){
        $sql = "select max(pyear)mpyear,max(pmonth)mpmonth from bimbel where nis='".$nis."'";
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        $out = $res->result();
        //return array("maxyear"=>$out[0]->mpyear,"maxmonth"=>$out[0]->mpmonth);


        $thisyear = $this->Setting->getcurrentyear();
        $initmonth = $this->Setting->getinitmonth();
        $sql = "select ";
        $sql.= "case when mpyear is null then '".$thisyear."' else mpyear end mpyear, ";
        $sql.= "case when mpmonth is null then '".$initmonth."' else mpmonth end mpmonth ";
        $sql.= "from ";
        $sql.= "(select max(pyear)mpyear,max(pmonth)mpmonth from bimbel where nis='".$nis."' ) X ";
        
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        $out = $res->result();
        return array("maxyear"=>$out[0]->mpyear,"maxmonth"=>$out[0]->mpmonth);
        
    }
    function getbimbel($nis){
        $sql = "select nis,amount from students a left outer join bimbelgroups b on b.id=a.bimbelgroup_id where nis='".$nis."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0]->amount;
    }
    function getbimbelremain($nis){
        $maxym = $this->getbimbelmaxyearmonth($nis);
        $bimbel = $this->getbimbel($nis);
        if($maxym["maxyear"]===date("Y")){
            if($maxym["maxmonth"]<date("m")){
                $tagihan = $bimbel*(removezero(date("m"))-removezero($maxym["maxmonth"]));
            }
            else{
                $tagihan = 0;
            }
        }else if($maxym["maxyear"]<date("Y")){
            $count = ((date("Y")-$maxym["maxyear"])*12)-$maxym["maxmonth"] + date("m");
            $COMMENT = "BANYAKNYA BULAN = SELISIH TAHUN x 12, DITAMBAH BULAN SAAT INI DIKURANGI BULAN TERAKHIR PEMBARAYARAN";
            $tagihan = $bimbel*$count;
        }else{
            $tagihan = 0;
        }
        return array("tagihan"=>$tagihan);
    }
}