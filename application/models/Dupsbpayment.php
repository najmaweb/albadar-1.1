<?php
class Dupsbpayment extends CI_Model{
    public $nis;
    public $ci;
    public $year;
    function __construct($nis = null){
        parent::__construct();
        $this->nis = $nis;
        $this->ci = & get_instance();
        $this->year = $this->Setting->getcurrentyear();
    }
    function getdupsb(){
        $sql = "select b.amount from studentshistory a ";
        $sql.= "left outer join dupsbgroups b on b.id=a.dupsbgroup_id ";
        $sql.= "where a.nis='".$this->nis."' ";
        $sql.= "and a.year='".$this->year."' ";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0]->amount;
        }
        return 0;
    }
    function getdupsbpaid(){
        $sql = "select sum(amount) amount from dupsb ";
        $sql.= "where nis='".$this->nis."' ";
        $sql.= "and year='".$this->Setting->getcurrentyear()."' ";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if(is_null($res[0]->amount)){
            return 0;
        }
        return $res[0]->amount;;
    }
    function getdupsbremain(){
        return $this->getdupsb() - $this->getdupsbpaid();
    }
}