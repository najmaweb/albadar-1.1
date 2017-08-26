<?php
class Receipt extends CI_Model{
    var $ci;
    function __construct(){
        parent::__construct();
        $this->ci = & get_instance();
    }
    function getmax($month){
        $sql = "select lpad(max(rorder)+1,4,'0') maxnum from receipts where month(createdate)='".$month."'";
        $que = $this->ci->db->query($sql);
        $res = $que->result();
        if(is_null($res[0]->maxnum)){
            return '0001';
        }
        return $res[0]->maxnum;
    }
    function create(){
        return "EL/".date("y")."/".date("m")."/".$this->getmax(date("m"));
    }
    function save($nis,$amount,$sppremain,$dupsbremain,$bimbelremain,$bookremain,$year){
        $receiptno = $this->create();
        $sql = "insert into receipts (receiptno,rorder,nis,amount,sppremain,dupsbremain,bimbelremain,bookremain,year,createuser) ";
        $sql.= "values ";
        $sql.= "('".$receiptno."','".$this->getmax(date("m"))."','".$nis."','".$amount."','".$sppremain."','".$dupsbremain."','".$bimbelremain."','".$bookremain."','".$year."','puji') ";
        $que = $this->ci->db->query($sql);
        return $receiptno;
    }
    function getreceipt($id){
        $sql = "select a.id,a.receiptno,a.sppremain,a.dupsbremain,a.bookremain,a.bimbelremain,a.amount total,b.name,a.nis,a.year,";
        $sql.= "a.createuser,c.amount spp,d.amount bimbel,";
        $sql.= "e.amount psb,f.amount book,g.name grade ";
        $sql.= "from receipts a ";
        $sql.= "left outer join studentshistory b on a.nis=b.nis and b.year=a.year ";
        $sql.= "left outer join spp c on c.nis=a.nis and c.cyear=a.year ";
        $sql.= "left outer join bimbel d on d.nis=a.nis and d.cyear=a.year ";
        $sql.= "left outer join dupsb e on e.nis=a.nis and e.year=a.year ";
        $sql.= "left outer join bookpayment f on f.nis=a.nis and f.year=a.year ";
        $sql.= "left outer join grades g on g.id=b.grade_id ";
        $sql.= "where a.id = '" . $id . "'";
        $que = $this->ci->db->query($sql);
        return $que->result()[0];
    }
    function getreceiptdetails($receiptno){
        $sql = "select id,receiptno,description,amount from receiptdetails ";
        $sql.= "where receiptno='".$receiptno."'";
        $que = $this->ci->db->query($sql);
        return $que->result();
    }
    function getreceipts(){
        $sql = "select a.id,receiptno,b.name,a.nis,a.year,a.createuser from receipts a ";
        $sql.= "left outer join studentshistory b on a.nis=b.nis and b.year=a.year ";
        $que = $this->ci->db->query($sql);
        return $que->result();
    }
}