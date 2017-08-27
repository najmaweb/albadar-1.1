<?php
class Mdashboard extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getsppstatistic($grade_id,$month){
        $ci = & get_instance();
        $sql = "select count(A.nis)tot,count(B.nis)byr ";
        $sql.= "from (";
        $sql.= " select nis from studentshistory ";
        $sql.= " where grade_id='" . $grade_id . "' and year='".$this->Setting->getcurrentyear()."'";
        $sql.= ") A ";
        $sql.= "left outer join ";
        $sql.= "(select nis from spp where cyear='".$this->Setting->getcurrentyear()."' and pmonth='".$month."') B on B.nis=A.nis ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $percentage = floor(($res->byr / $res->tot)*100);
        return array("tot"=>$res->tot,"byr"=>$res->byr,"percentage"=>$percentage);
    }
    function getspppercentage(){
        $spp = $this->getsppstatistic();
        return floor(($spp["byr"]/$spp["tot"])*100);
    }
    function getbimbelstatistic($grade_id,$month){
        $ci = & get_instance();
        $sql = "select count(A.nis)tot,count(B.nis)byr ";
        $sql.= "from (";
        $sql.= " select nis from studentshistory ";
        $sql.= " where grade_id='" . $grade_id . "' and year='".$this->Setting->getcurrentyear()."'";
        $sql.= ") A ";
        $sql.= "left outer join ";
        $sql.= "(select nis from bimbel where cyear='".$this->Setting->getcurrentyear()."' and pmonth='".$month."') B on B.nis=A.nis ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $percentage = floor(($res->byr / $res->tot)*100);
        return array("tot"=>$res->tot,"byr"=>$res->byr,"percentage"=>$percentage);
    }
    function getbimbelpercentage(){
        $bimbel = $this->getbimbelstatistic();
        return floor(($bimbel["byr"]/$bimbel["tot"])*100);
    }
    function getdupsbstatistic($grade_id,$month){
        $ci = & get_instance();
        $curyear = $ci->Setting->getcurrentyear();
        $sql = "select sum(c.amount)tot,sum(b.amount)byr from studentshistory a ";
        $sql.= "left outer join dupsb b on b.nis=a.nis ";
        $sql.= "left outer join dupsbgroups c on c.id=a.dupsbgroup_id ";
        $sql.= "where a.year='".$curyear."' and b.year='".$curyear."'";
        $sql = "select sum(C.amount)tot,sum(B.amount)byr ";
        $sql.= "from (";
        $sql.= " select nis,dupsbgroup_id from studentshistory ";
        $sql.= " where grade_id='" . $grade_id . "' and year='".$this->Setting->getcurrentyear()."'";
        $sql.= ") A ";
        $sql.= "left outer join ";
        $sql.= "(select nis,amount from dupsb where year='".$this->Setting->getcurrentyear()."') B on B.nis=A.nis ";
        $sql.= "left outer join dupsbgroups C on C.id=A.dupsbgroup_id ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $percentage = floor(($res->byr / $res->tot)*100);
        return array("tot"=>$res->tot,"byr"=>$res->byr,"percentage"=>$percentage);
    }
    function getdupsbpercentage(){
        $dupsb = $this->getdupsbstatistic();
        return floor(($dupsb["byr"]/$dupsb["tot"])*100);
    }
    function getbookstatistic($grade_id,$month){
        $ci = & get_instance();
        $curyear = $ci->Setting->getcurrentyear();
        $sql = "select sum(c.amount)tot,sum(b.amount)byr from studentshistory a ";
        $sql.= "left outer join bookpayment b on b.nis=a.nis ";
        $sql.= "left outer join bookpaymentgroups c on c.id=a.bookpaymentgroup_id ";
        $sql.= "where a.year='".$curyear."' and b.year='".$curyear."'";
        $sql = "select sum(C.amount)tot,sum(B.amount)byr ";
        $sql.= "from (";
        $sql.= " select nis,bookpaymentgroup_id from studentshistory ";
        $sql.= " where grade_id='" . $grade_id . "' and year='".$this->Setting->getcurrentyear()."'";
        $sql.= ") A ";
        $sql.= "left outer join ";
        $sql.= "(select nis,amount from bookpayment where year='".$this->Setting->getcurrentyear()."') B on B.nis=A.nis ";
        $sql.= "left outer join bookpaymentgroups C on C.id=A.bookpaymentgroup_id ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        if($res->tot>0){
            $percentage = floor(($res->byr / $res->tot)*100);
        }else{
            $percentage = 100;
        }
        return array("tot"=>$res->tot,"byr"=>$res->byr,"percentage"=>$percentage);
    }
    function getbookpercentage(){
        $book = $this->getbookstatistic();
        return floor(($book["byr"]/$book["tot"])*100);
    }
}