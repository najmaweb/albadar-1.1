<?php
class Report extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library("Dates");
    }
    function dailyrekapperuser($username="all"){
        $ci = & get_instance();
        $sql = "select nname,sum(b.amount)spp,sum(c.amount)bimbel,sum(d.amount)dupsb,sum(e.amount)bookpayment from users a ";
        $sql.= "left outer join (select createuser,amount from spp where cyear=".$ci->setting->getcurrentyear().") b on b.createuser=a.nname ";
        $sql.= "left outer join (select createuser,amount from bimbel where cyear=".$ci->setting->getcurrentyear().") c on c.createuser=a.nname ";
        $sql.= "left outer join (select createuser,amount from dupsb where year=".$ci->setting->getcurrentyear().") d on d.createuser=a.nname ";
        $sql.= "left outer join (select createuser,amount from bookpayment where year=".$ci->setting->getcurrentyear().") e on e.createuser=a.nname ";
        if($username!=="all"){
            $sql.= "where a.nname='".$username."'";
        }
        $sql.= "group by nname ";
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getdailytransaction(){
        $montharray = $this->dates->getmonthsarray();
        $sql = "select jam,uraian,amount,createuser from ( ";
        $sql.= "select date_format(a.createdate,'%H:%i:%s')jam,concat('Pembayaran SPP ',a.pmonth,'-',a.pyear,' ',b.name,' ',c.name) uraian,sum(a.amount)amount,a.createuser ";
        $sql.= "from spp a ";
        $sql.= "left outer join students b on b.nis=a.nis ";
        $sql.= "left outer join grades c on c.id=b.grade_id ";
        $sql.= "where date_format(a.createdate,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') ";
        $sql.= "group by date_format(a.createdate,'%H:%i:%s'),a.pmonth,a.pyear,a.createuser,b.name,c.name ";
        $sql.= "union ";
        $sql.= "select date_format(a.createdate,'%H:%i:%s')jam,concat('Pembayaran Bimbel ',a.pmonth,'-',a.pyear,' ',b.name,' ',c.name) uraian,sum(a.amount)amount,a.createuser ";
        $sql.= "from bimbel a ";
        $sql.= "left outer join students b on b.nis=a.nis ";
        $sql.= "left outer join grades c on c.id=b.grade_id ";
        $sql.= "where date_format(a.createdate,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') ";
        $sql.= "group by date_format(a.createdate,'%H:%i:%s'),a.createuser,a.pmonth,a.pyear,b.name,c.name ";
        $sql.= "union ";
        $sql.= "select date_format(a.createdate,'%H:%i:%s')jam,concat('Pembayaran Daftar Ulang / PSB ',a.year,' ',b.name,' ',c.name) uraian,sum(a.amount)amount,a.createuser ";
        $sql.= "from dupsb a ";
        $sql.= "left outer join students b on b.nis=a.nis ";
        $sql.= "left outer join grades c on c.id=b.grade_id ";
        $sql.= "where date_format(a.createdate,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') ";
        $sql.= "group by date_format(a.createdate,'%H:%i:%s'),a.createuser,a.year,' ',b.name,c.name ";
        $sql.= "union ";
        $sql.= "select date_format(a.createdate,'%H:%i:%s')jam,concat('Pembayaran Buku ',b.name,' ',c.name) uraian,sum(a.amount)amount,a.createuser ";
        $sql.= "from bookpayment a ";
        $sql.= "left outer join students b on b.nis=a.nis ";
        $sql.= "left outer join grades c on c.id=b.grade_id ";
        $sql.= "where date_format(a.createdate,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') ";
        $sql.= "group by date_format(a.createdate,'%H:%i:%s'),a.createuser,b.name,c.name ";
        $sql.= ")q order by jam ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function gettransactionperuser($month,$year,$user=null){
        if(is_null($user)){
            $userfilter = " ";
        }else{
            if($user==='all'){
                $userfilter = " ";
            }else{
                $userfilter = "and createuser='".$user."' ";
            }        
        }
        $sql = 'select ord,dt,createuser,sum(amount)amount from (';
        $sql.= 'select date_format(createdate,"%d-%m-%Y") dt,date_format(createdate,"%Y-%m-%d") ord,createuser,sum(amount) amount ';
        $sql.= 'from spp ';
        $sql.= 'where date_format(createdate,"%m-%Y")="'.$month.'-'.$year.'" ';
        $sql.= $userfilter;
        $sql.= 'group by createuser,date_format(createdate,"%d-%m-%Y"),date_format(createdate,"%Y-%m-%d") ';
        $sql.= "union ";
        $sql.= 'select date_format(createdate,"%d-%m-%Y") dt,date_format(createdate,"%Y-%m-%d") ord,createuser,sum(amount) amount ';
        $sql.= 'from bimbel  ';
        $sql.= 'where date_format(createdate,"%m-%Y")="'.$month.'-'.$year.'" ';
        $sql.= $userfilter;

        $sql.= 'group by createuser,date_format(createdate,"%d-%m-%Y"),date_format(createdate,"%Y-%m-%d") ';
        $sql.= "union ";
        $sql.= 'select date_format(createdate,"%d-%m-%Y") dt,date_format(createdate,"%Y-%m-%d") ord,createuser,sum(amount) amount ';
        $sql.= 'from dupsb  ';
        $sql.= 'where date_format(createdate,"%m-%Y")="'.$month.'-'.$year.'" ';
        $sql.= $userfilter;

        $sql.= 'group by createuser,date_format(createdate,"%d-%m-%Y"),date_format(createdate,"%Y-%m-%d") ';
        $sql.= "union ";
        $sql.= 'select date_format(createdate,"%d-%m-%Y") dt,date_format(createdate,"%Y-%m-%d") ord,createuser,sum(amount) amount ';
        $sql.= 'from bookpayment  ';
        $sql.= 'where date_format(createdate,"%m-%Y")="'.$month.'-'.$year.'" ';
        $sql.= $userfilter;

        $sql.= 'group by createuser,date_format(createdate,"%d-%m-%Y"),date_format(createdate,"%Y-%m-%d") ';
        $sql.= ')q group by ord,dt,createuser';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getspp($year){
        $sql = "select date_format(createdate,'%d %M %Y') createdate,sum(amount) spp,'Pemb. SPP' subj,createuser from spp ";
        $sql.= "where pyear='".$year."' ";
        $sql.= "group by date_format(createdate,'%d %M %Y'),createuser ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getspptotal($year){
        $sql = "select sum(amount) spp from spp ";
        $sql.= "where pyear='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getbimbel($year){
        $sql= "select date_format(createdate,'%d %M %Y') createdate,sum(amount) spp,'Pemb. Bimbel' subj,createuser from bimbel ";
        $sql.= "where pyear='".$year."' ";
        $sql.= "group by date_format(createdate,'%d %M %Y'),createuser ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getbimbeltotal($year){
        $sql = "select sum(amount) bimbel from bimbel ";
        $sql.= "where pyear='".$year."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getrekapsppperkelas(){
        $ci = & get_instance();
        $year = $ci->Setting->getcurrentyear();
        $sql = "select nis,name,sum(jun)jun,sum(jul)jul,sum(ags)ags,sum(sep)sep,";
        $sql.= "sum(okt)okt,sum(nop)nop,sum(des)des,sum(jan)jan,";
        $sql.= "sum(feb)feb,sum(mar)mar,sum(apr)apr,sum(mei)mei ";
        $sql.= "from (select a.id,b.nis,b.name,amount,pmonth,pyear,year ";
        $sql.= ", case a.pmonth when '06' then amount else '0' end jun ";
        $sql.= ", case a.pmonth when '07' then amount else '0' end jul ";
        $sql.= ", case a.pmonth when '08' then amount else '0' end ags ";
        $sql.= ", case a.pmonth when '09' then amount else '0' end sep ";
        $sql.= ", case a.pmonth when '10' then amount else '0' end okt ";
        $sql.= ", case a.pmonth when '11' then amount else '0' end nop ";
        $sql.= ", case a.pmonth when '12' then amount else '0' end des ";
        $sql.= ", case a.pmonth when '01' then amount else '0' end jan ";
        $sql.= ", case a.pmonth when '02' then amount else '0' end feb ";
        $sql.= ", case a.pmonth when '03' then amount else '0' end mar ";
        $sql.= ", case a.pmonth when '04' then amount else '0' end apr ";
        $sql.= ", case a.pmonth when '05' then amount else '0' end mei ";
        $sql.= " from (select * from spp where cyear='".$year."') a right outer join students b on b.nis=a.nis order by a.nis,a.pmonth)x ";
        $sql.= "";
        $sql.= "group by nis,name";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getrekapbimbelperkelas(){
        $sql = "select nis,name,sum(jun)jun,sum(jul)jul,sum(ags)ags,sum(sep)sep,sum(okt)okt,sum(nop)nop,sum(des)des,sum(jan)jan,sum(feb)feb,sum(mar)mar,sum(apr)apr,sum(mei)mei ";
        $sql.= "from (select a.id,b.nis,b.name,amount,pmonth,pyear,year ";
        $sql.= ", case a.pmonth when '06' then amount else '0' end jun ";
        $sql.= ", case a.pmonth when '07' then amount else '0' end jul ";
        $sql.= ", case a.pmonth when '08' then amount else '0' end ags ";
        $sql.= ", case a.pmonth when '09' then amount else '0' end sep ";
        $sql.= ", case a.pmonth when '10' then amount else '0' end okt ";
        $sql.= ", case a.pmonth when '11' then amount else '0' end nop ";
        $sql.= ", case a.pmonth when '12' then amount else '0' end des ";
        $sql.= ", case a.pmonth when '01' then amount else '0' end jan ";
        $sql.= ", case a.pmonth when '02' then amount else '0' end feb ";
        $sql.= ", case a.pmonth when '03' then amount else '0' end mar ";
        $sql.= ", case a.pmonth when '04' then amount else '0' end apr ";
        $sql.= ", case a.pmonth when '05' then amount else '0' end mei ";
        $sql.= " from bimbel a right outer join students b on b.nis=a.nis order by a.nis,a.pmonth)x ";
        $sql.= "group by nis,name";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getsumrekapbimbelperkelas(){
        $pyear = '2016';
        $sql = "select nis,case pmonth when '06' then amount else 0 end jul,0 agu,0 sep,0 okt,0 nop,0 des,0 jan,0 feb,0 mar,0 apr,0 mei,0 jun from bimbel where pmonth='06' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,case pmonth when '07' then amount else 0 end  jul,0 agu,0 sep,0 okt,0 nop,0 des,0 jan,0 feb,0 mar,0 apr,0 mei,0 jun from bimbel where pmonth='07' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,0 jul,case pmonth when '08' then amount else 0 end agu,0 sep,0 okt,0 nop,0 des,0 jan,0 feb,0 mar,0 apr,0 mei,0 jun from bimbel where pmonth='08' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,0 jul,case pmonth when '09' then amount else 0 end apr,0,0,0,0,0,0,0,0,0,0,0 from bimbel where pmonth='09' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,0,case pmonth when '10' then amount else 0 end apr,0 mei,0 jun,0 jul,0 agu,0 sep,0 okt,0 nop,0 des,0 jan,0 peb,0 mar from bimbel where pmonth='10' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='11' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='12' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='01' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='02' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='03' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='04' and pyear='".$pyear."' group by nis ";
        $sql.= "union ";
        $sql.= "select nis,sum(amount) from bimbel where pmonth='05' and pyear='".$pyear."' group by nis ";
        echo $sql;
    }
    function gettertanggung(){
        $ci = & get_instance();
        $enddate = date("Y-m-d");
        $year = $ci->Setting->getcurrentyear();
        $sql = "select name,nis,grade,spp,bimbel,dupsb,book from ";
        $sql.= "(";
        $sql.= "select a.name,a.nis,j.name grade,";
        $sql.= "case when b.mdate is null then c.amount when timestampdiff(month,b.mdate,'".$enddate."')<0 then '0' ";
        $sql.= "else timestampdiff(month,b.mdate,'".$enddate."')*c.amount end spp, ";
        $sql.= "case when d.mdate is null then e.amount when timestampdiff(month,d.mdate,'".$enddate."')<0 then '0' ";
        $sql.= "else timestampdiff(month,d.mdate,'".$enddate."')*e.amount end bimbel, ";
        $sql.= "case when f.amnt is null then g.amount else g.amount-f.amnt end dupsb, ";
        $sql.= "case when h.amnt is null then i.amount else i.amount-h.amnt end book ";
        $sql.= "from ";
        $sql.= "(";
        $sql.= " select nis,name,sppgroup_id,bimbelgroup_id,dupsbgroup_id,bookpaymentgroup_id,grade_id from studentshistory ";
        $sql.= " where year='".$year."'";
        $sql.= ") a ";
        $sql.= "left outer join (select nis,max(concat(pyear,'-',pmonth,'-01'))mdate from spp group by nis) b on b.nis=a.nis ";
        $sql.= "left outer join sppgroups c on c.id=a.sppgroup_id ";
        $sql.= "left outer join (select nis,max(concat(pyear,'-',pmonth,'-01'))mdate from bimbel group by nis) d on d.nis=a.nis ";
        $sql.= "left outer join bimbelgroups e on e.id=a.bimbelgroup_id ";
        $sql.= "left outer join (select nis,sum(amount)amnt from dupsb group by nis) f on f.nis=a.nis ";
        $sql.= "left outer join dupsbgroups g on g.id=a.dupsbgroup_id ";
        $sql.= "left outer join (select nis,sum(amount)amnt from bookpayment group by nis) h on h.nis=a.nis ";
        $sql.= "left outer join bookpaymentgroups i on i.id=a.bookpaymentgroup_id ";
        $sql.= "left outer join grades j on j.id=a.grade_id ";
        $sql.= ") X order by grade,nis ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function rekapdu(){
        $ci = & get_instance();
        $year = $this->Setting->getcurrentyear();
        $sql = "select id,nis,name,amount, grade, ";
        $sql.= "case when tot is null then '0' else tot end tot,";
        $sql.= "case when tot is null then amount else amount-tot end sisa ";
        $sql.= "from (select a.id,a.nis,a.name,b.amount,d.name grade,sum(c.amount)tot from students a ";
        $sql.= "left outer join dupsbgroups b on b.id=a.dupsbgroup_id ";
        $sql.= "left outer join (select id,amount,nis from dupsb where year='".$year."') c on c.nis=a.nis ";
        $sql.= "left outer join grades d on d.id=a.grade_id ";
        $sql.= "group by a.id,a.nis,a.name,b.amount,d.name ";
        $sql.= ") x ";
        $sql.= "order by grade,nis ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function rekapbuku(){
        $ci = & get_instance();
        $year = $this->Setting->getcurrentyear();
        $sql = "select id,nis,name,amount,grade, ";
        $sql.= "case when tot is null then '0' else tot end tot,";
        $sql.= "case when tot is null then amount else amount-tot end sisa ";
        $sql.= "from (select a.id,a.nis,a.name,b.amount,d.name grade,sum(c.amount)tot from studentshistory a ";
        $sql.= "left outer join bookpaymentgroups b on b.id=a.bookpaymentgroup_id ";
        $sql.= "left outer join (select id,amount,nis from bookpayment where year='".$year."') c on c.nis=a.nis ";
        $sql.= "left outer join grades d on d.id=a.grade_id ";
        $sql.= "group by a.id,a.nis,a.name,b.amount,d.name) x ";
        $sql.= "order by grade,nis ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
}