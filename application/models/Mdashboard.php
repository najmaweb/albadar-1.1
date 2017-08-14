<?php
class Mdashboard extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getsppstatistic(){
        $ci = & get_instance();
        $sql = "select count(a.id)tot,count(b.id)byr from studentshistory a ";
        $sql.= "left outer join spp b on b.nis=a.nis; ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        return array("tot"=>$res->tot,"byr"=>$res->byr);
    }
    function getspppercentage(){
        $spp = $this->getsppstatistic();
        return floor(($spp["byr"]/$spp["tot"])*100);
    }
    function getbimbelstatistic(){
        $ci = & get_instance();
        $sql = "select count(a.id)tot,count(b.id)byr from studentshistory a ";
        $sql.= "left outer join bimbel b on b.nis=a.nis; ";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        return array("tot"=>$res->tot,"byr"=>$res->byr);
    }
    function getbimbelpercentage(){
        $bimbel = $this->getbimbelstatistic();
        return floor(($bimbel["byr"]/$bimbel["tot"])*100);
    }
    function getdupsbstatistic(){
        $ci = & get_instance();
        $curyear = $ci->Setting->getcurrentyear();
        $sql = "select count(a.id)tot,count(b.id)byr from studentshistory a ";
        $sql.= "left outer join dupsb b on b.nis=a.nis ";
        $sql.= "where a.year='".$curyear."' and b.year='".$curyear."'";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        return array("tot"=>$res->tot,"byr"=>$res->byr);
    }
    function getdupsbpercentage(){
        $dupsb = $this->getdupsbstatistic();
        return floor(($dupsb["byr"]/$dupsb["tot"])*100);
    }
    function getbookstatistic(){
        $ci = & get_instance();
        $curyear = $ci->Setting->getcurrentyear();
        $sql = "select count(a.id)tot,count(b.id)byr from studentshistory a ";
        $sql.= "left outer join bookpayment b on b.nis=a.nis ";
        $sql.= "where a.year='".$curyear."' and b.year='".$curyear."'";
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        return array("tot"=>$res->tot,"byr"=>$res->byr);
    }
    function getbookpercentage(){
        $book = $this->getbookstatistic();
        return floor(($book["byr"]/$book["tot"])*100);
    }
}