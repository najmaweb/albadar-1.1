<?php
class Payment extends CI_Model{
    public $nis;
    public $ci;
    function __construct($nis = null){
        parent::__construct();
        $this->ci = & get_instance();
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
}