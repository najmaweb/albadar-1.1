<?php
class Students extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Student");
        $this->load->model("Grade");
        $this->load->model("User");
        $this->load->model("Sppgroup");
        $this->load->model("Bimbelgroup");
        $this->load->model("Dupsbgroup");
        $this->load->model("Bookpaymentgroup");
        $this->load->library("Dates");
        $this->load->helper("datetime");
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Daftar"),
            "formtitle"=>"Daftar Siswa",
            "feedData"=>"siswa",
            "objs"=>$this->Student->getStudents(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("students/students",$data);
    }
    function import(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Import CSV"),
            "formtitle"=>"Import Siswa",
            "feedData"=>"siswa",
            "objs"=>$this->Student->getStudents(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("students/import",$data);
    }
    function importcsv(){
        session_start();
        $params = $this->input->post();
        if(isset($_POST["submit"]))
        {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $c = 0;
            $objarr = array();
            while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
            {
                $year = $filesop[0];
    			$nis = $filesop[1];
                $name = $filesop[2];
    			$grade_id = $filesop[3];
    			$sppgroup_id = $filesop[4];
    			$bimbelgroup_id = $filesop[5];
    			$dupsbgroup_id = $filesop[6];
    			$bookpaymentgroup_id = $filesop[7];
                array_push($objarr,array(
                    "year"=>$year,"nis"=>$nis,
                    "name"=>$name,"grade_id"=>$grade_id,
                    "sppgroup_id"=>$sppgroup_id,"bimbelgroup_id"=>$bimbelgroup_id,
                    "dupsbgroup_id"=>$dupsbgroup_id,"bookpaymentgroup_id"=>$bookpaymentgroup_id,
                )
                );
                $c = $c + 1;
            }
            $filesop = fgetcsv($handle, 1000, ",");
            $data = array(
                "results" =>$objarr,
                "role"=>"1",
                "feedData"=>"siswa"
            );
            $this->load->view("students/importresult",$data);
        }        
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Penambahan"),
            "formtitle"=>"Penambahan Siswa",
            "feedData"=>"siswa",
            "students"=>$this->Student->getStudents(),
            "grades"=>$this->Grade->getclassarray(),
            "sppgroups"=>$this->Sppgroup->getsppgrouparray(),
            "bookpaymentgroups"=>$this->Bookpaymentgroup->getbookpaymentgrouparray(),
            "dupsbgroups"=>$this->Dupsbgroup->getdupsbgrouparray(),
            "bimbelgroups"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "years"=>$this->dates->getyearsarray(),
            "months"=>$this->dates->getmonthsarray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("students/add",$data);        
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Siswa",2=>"Edit"),
            "formtitle"=>"Edit siswa",
            "feedData"=>"siswa",
            "obj"=>$this->Student->getStudent($this->uri->segment(3)),
            "grades"=>$this->Grade->getclassarray(),
            "sppgroups"=>$this->Sppgroup->getsppgrouparray(),
            "dupsbgroups"=>$this->Dupsbgroup->getDupsbgrouparray(),
            "bookpaymentgroups"=>$this->Bookpaymentgroup->getBookpaymentgrouparray(),
            "bimbelgroups"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "years"=>$this->dates->getyearsarray(),
            "months"=>$this->dates->getmonthsarray(),
            "role"=>$this->User->getrole($_SESSION["userid"])
        );
        $this->load->view("students/edit",$data);        
    }
    function getjson(){
        session_start();
        checklogin();
        $year = $this->dates->getcurrentyear();
        $sql = "select a.id,a.name,a.nis,b.name grade,c.amount spp from students a ";
        $sql.= "left outer join grades b on b.id=a.grade_id ";
        $sql.= "left outer join sppgroups c on c.id=a.sppgroup_id ";
        $que = $this->db->query($sql);
        $res = $que->result();
        $arr = array();
		foreach($res as $obj){
            $str = '{';
            $str.= '"value":"'.$obj->nis.' '.$obj->name.'('.$obj->grade.')",';
            $str.= '"data":"'.$obj->id.'",';
            $str.= '"nis":"'.$obj->nis.'",';
            $str.= '"spp":"'.$obj->spp.'",';
            $str.= '"name":"'.$obj->name.'",';
            $str.= '"grade":"'.$obj->grade.'"';
            $str.= '}';
			array_push($arr,$str);
		}
		echo '{"out":['.implode(",",$arr).']}';
    }
    function getsppstatus(){
        session_start();
        checklogin();
        $des = "MENGEMBALIKAN STATUS BELUM PERNAH MEMBAYAR JIKA JUMLAH 0";
        $des.= "MENGEMBALIKAN STATUS TAHUNBULAN TERAKHIR JIKA JUMLAH > 0";
        $nis = $this->uri->segment(3);
        $sql = "select * from spp ";
        $sql.= "where nis='".$nis."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()===0){
            echo "BELUM_BAYAR";
        }else{
            $sql = "select max(yearmonth) lastpay from students ";
            $sql.= "where nis='".$nis."'";
            $qym = $ci->db->query($sql);
            $rym = $qym->result();
            echo $ym->lastpay;
        }
    }
    function getproperties(){
        session_start();
        checklogin();
        $nis = $this->uri->segment(3);
        $year = $this->dates->getcurrentyear();
        $initmonth = $this->Setting->getinitmonth();
        $lastmaxmonth = $initmonth - 1;
        if($initmonth>1){
            $lastmaxmonth = $initmonth - 1;
        }else{
            $lastmaxmonth = 12;
        }
        $sql = "select a.id,a.name,b.amount spp,c.amount bimbel,d.amount dupsb, ";
        $sql.= "e.dupsbpaid,j.bookpaymentpaid, ";
        $sql.= "case when e.amount is null then d.amount else (d.amount-e.amount) end  dupsbremain, ";
        $sql.= "case when j.amount is null then i.amount else (i.amount-j.amount) end  bookremain, ";
        $sql.= "case when f.pyear is null then a.inityear else f.pyear end sppmaxyear,";
        $sql.= "case when f.pmonth is null then '".$lastmaxmonth."' else f.pmonth end sppmaxmonth, ";
        $sql.= "case when g.pyear is null then a.inityear else g.pyear end bimbelmaxyear,";
        $sql.= "case when g.pmonth is null then '".$lastmaxmonth."' else g.pmonth end bimbelmaxmonth ";
        $sql.= "from students a ";
        $sql.= "left outer join (select id,name,nis,year,bookpaymentgroup_id,sppgroup_id,bimbelgroup_id,dupsbgroup_id from studentshistory where year='$year') h on h.nis=a.nis ";
        $sql.= "left outer join sppgroups b on b.id=h.sppgroup_id ";
        $sql.= "left outer join bimbelgroups c on c.id=h.bimbelgroup_id ";
        $sql.= "left outer join dupsbgroups d on d.id=h.dupsbgroup_id ";
        $sql.= "left outer join (select nis,count(amount) dupsbpaid,sum(amount) amount from dupsb where nis='".$nis."' and year='".$year."' group by nis) e on e.nis=a.nis ";
        $sql.= "left outer join (select a.nis,b.pyear,mmonth pmonth from  (select nis,max(pyear)myear from spp where nis='".$nis."' and cyear='".$year."') a left outer join (select nis,pyear,max(pmonth)mmonth from spp where nis='".$nis."' group by nis,pyear) b on b.nis=a.nis and b.pyear=a.myear) f on f.nis=a.nis ";
        $sql.= "left outer join (";
        $sql.= " select a.nis,b.pyear,mmonth pmonth from  (";
        $sql.= "  select nis,max(pyear)myear from bimbel where nis='".$nis."') a ";
        $sql.= "  left outer join (select nis,pyear,max(pmonth)mmonth from bimbel where nis='".$nis."' group by nis,pyear) b ";
        $sql.= "   on b.nis=a.nis and b.pyear=a.myear) g on g.nis=a.nis ";
        $sql.= "left outer join bookpaymentgroups i on i.id=h.bookpaymentgroup_id ";
        $sql.= "left outer join (select nis,count(amount) bookpaymentpaid,sum(amount) amount from bookpayment ";
        $sql.= " where nis='".$nis."' and year='".$year."' group by nis) j on j.nis=a.nis ";
        $sql.= "where a.nis = '".$nis."' ";
        $sql.= "and h.year='" . $year . "' ";
        $sql.= "group by a.id,a.name,b.amount,c.amount,d.amount,f.pyear,f.pmonth,g.pyear,g.pmonth,dupsbpaid,j.bookpaymentpaid,i.amount,j.amount ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()===0){
            $spp = $this->Student->getspp($nis);
            $bimbel = $this->Student->getbimbel($nis);
            $dupsb = $this->Mcashier->getdupsbremain($nis,$year);
            $book = $this->Student->getbook($nis);
            $out = '{';
            $out.= '"name":"-",';
            $out.= '"spp":"'.$spp.'",';
            $out.= '"bimbel":"'.$bimbel.'",';
            $out.= '"dupsbremain":"'.$dupsb.'",';
            $out.= '"bookremain":"'.$book.'",';
            $out.= '"sppmaxyear":"'.$this->Setting->getcurrentyear().'",';
            $out.= '"sppmaxmonth":"07",';
            $out.= '"bimbelmaxyear":"'.$this->Setting->getcurrentyear().'",';
            $out.= '"bimbelmaxmonth":"07"';
            $out.= '}';
            echo $out;
        }else{
            $res = $que->result()[0];
            if($res->sppmaxmonth==12){
                $sppmaxmonth = 1;
                $sppmaxyear = $res->sppmaxyear + 1;
            }else{
                $sppmaxmonth = addzero($res->sppmaxmonth+1);
                $sppmaxyear = addzero($res->sppmaxyear);
            }
            if($res->bimbelmaxmonth==12){
                $bimbelmaxmonth = 1;
                $bimbelmaxyear = $res->bimbelmaxyear + 1;
            }else{
                $bimbelmaxmonth = addzero($res->bimbelmaxmonth+1);
                $bimbelmaxyear = addzero($res->bimbelmaxyear);
            }
            $out = '{"spp":"'.$res->spp.'",';
            $out.= '"name":"'.$res->name.'",';
            $out.= '"bimbel":"'.$res->bimbel.'",';
            $out.= '"dupsbremain":"'.$res->dupsbremain.'",';
            $out.= '"bookremain":"'.$res->bookremain.'",';
            $out.= '"sppmaxyear":"'.$sppmaxyear.'",';
            $out.= '"sppmaxmonth":"'.$sppmaxmonth.'",';
            $out.= '"bimbelmaxyear":"'.$bimbelmaxyear.'",';
            $out.= '"bimbelmaxmonth":"'.$bimbelmaxmonth.'"}';
            echo $out;
        }
    }
    function importfinished(){
        $data = array(
            "info1"=>"Anda telah mengimport",
            "info2"=>"File csv siswa",
            "redirect"=>"../../students"
        );
        $this->load->view("students/info",$data);
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->Student->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Student->save($params);
        redirect("../index");
    }
    function cleanstudenthistory($year,$grade_id){
        $sql = "delete from studentshistory where year='".$year."' and grade_id='".$grade_id."'";
        $this->db->query($sql);
        return $sql;
    }
    function checkexist($nis){
        $sql = "select id from students where nis='".$nis."'";
        $que = $this->db->query($sql);
        if($que->num_rows()>0){
            return true;
        }
        return false;
    }
    function savefromcsv(){
        $params = $this->input->post();
        $this->load->helper("terbilang");
        if(isset($_POST["btnsavedata"])){
            $year = $params["year"][0];
            $grade_id = $params["grade_id"][0];
            $this->cleanstudenthistory($year,$grade_id);
            for($c=0;$c<count($params["name"]);$c++){
                $sql = "insert into studentshistory "; 
                $sql.= "(year,nis,name,grade_id,sppgroup_id,bimbelgroup_id,dupsbgroup_id,bookpaymentgroup_id) ";
                $sql.= "values ";
                $sql.= "(";
                $sql.= "'".$params["year"][$c]."',";
                $sql.= "'".add_trailing_zero($params["nis"][$c],6)."',";
                $sql.= "'".str_replace("'","''",$params["name"][$c])."',";
                $sql.= "'".$params["grade_id"][$c]."',";
                $sql.= "'".$params["sppgroup_id"][$c]."',";
                $sql.= "'".$params["bimbelgroup_id"][$c]."',";
                $sql.= "'".$params["dupsbgroup_id"][$c]."',";
                $sql.= "'".$params["bookpaymentgroup_id"][$c]."'";
                $sql.= ")";
                $this->db->query($sql);
                if($this->checkexist(add_trailing_zero($params["nis"][$c],6))){
                    $sql = "update students ";
                    $sql.= "set name='".str_replace("'","''",$params["name"][$c])."', ";
                    $sql.= " grade_id='".$params["grade_id"][$c]."', ";
                    $sql.= " sppgroup_id='".$params["sppgroup_id"][$c]."', ";
                    $sql.= " bimbelgroup_id='".$params["bimbelgroup_id"][$c]."', ";
                    $sql.= " dupsbgroup_id='".$params["dupsbgroup_id"][$c]."' ";
                    $sql.= "where nis='".add_trailing_zero($params["nis"][$c],6)."'";
                    $this->db->query($sql);
                }else{
                    $sql = "insert into students ";
                    $sql.= "(name,nis,initmonth,inityear,year,grade_id,sppgroup_id,bimbelgroup_id,dupsbgroup_id) ";
                    $sql.= "values ";
                    $sql.= "(";
                    $sql.= "'".str_replace("'","''",$params["name"][$c])."',";
                    $sql.= "'".add_trailing_zero($params["nis"][$c],6)."',";
                    $sql.= "'".add_trailing_zero(date("m"),2)."',";
                    $sql.= "'".date("Y")."',";
                    $sql.= "'".date("Y")."',";
                    $sql.= "'".$params["grade_id"][$c]."',";
                    $sql.= "'".$params["sppgroup_id"][$c]."',";
                    $sql.= "'".$params["bimbelgroup_id"][$c]."',";
                    $sql.= "'".$params["dupsbgroup_id"][$c]."' ";
                    $sql.= ")";
                    $this->db->query($sql);
                }
            }
        }
        redirect("../../students/importfinished");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        echo $this->Student->update($params);
        redirect("../index");
    }    
}