<?php
class Setting extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function update($params){
        $sql = "update settings set currentyear= '".$params["currentyear"]."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }    
    function getcurrentyear(){
        $sql = "select currentyear from settings  ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
        return $que->result()[0]->currentyear;
        }
        return false;
    }
    function getinitmonth(){
        $sql = "select initmonth from settings  ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
        return $que->result()[0]->initmonth;
        }
        return false;
    }    
}