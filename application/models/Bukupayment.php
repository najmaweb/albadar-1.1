<?php
class Bukupayment extends CI_Model{
    public $nis;
    public $ci;
    public $year;
    function __construct($nis = null){
        parent::__construct();
        $this->nis = $nis;
        $this->ci = & get_instance();
        $this->year = $this->Setting->getcurrentyear();
    }
    function getbuku(){
        $sql = "select b.amount from studentshistory a ";
        $sql.= "left outer join bookpaymentgroups b on b.id=a.bookpaymentgroup_id ";
        $sql.= "where a.nis='".$this->nis."' ";
        $sql.= "and a.year='".$this->year."' ";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0]->amount;
        }
        return 0;
    }
    function getbukupaid(){
        $sql = "select sum(amount) amount from bookpayment ";
        $sql.= "where nis='".$this->nis."' ";
        $sql.= "and year='".$this->Setting->getcurrentyear()."' ";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if(is_null($res[0]->amount)){
            return 0;
        }
        return $res[0]->amount;;
    }
    function getbukuremain(){
        return $this->getbuku() - $this->getbukupaid();
    }
}