<?php
class Dates {
    function getmonthsarray(){
        return array(
            "01"=>"Januari",
            "02"=>"Februari",
            "03"=>"Maret",
            "04"=>"April",
            "05"=>"Mei",
            "06"=>"Juni",
            "07"=>"Juli",
            "08"=>"Agustus",
            "09"=>"September",
            "10"=>"Oktober",
            "11"=>"Nopember",
            "12"=>"Desember",
        );
    }
    function getyearsarray(){
        return array(
            "2017"=>"2017",
            "2018"=>"2018",
            "2019"=>"2019",
        );
    }
    function getcurrentyear(){
        $sql = "select currentyear from settings ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        return $res->currentyear;
    }
}