<?php
class User extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function changepassword($userid,$password){
        $pass = $this->createpassword($password);
        $sql = "update users set salt='".$pass['salt']."',password='".$pass['password']."' where id='".$userid."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return true;
    }
    function createpassword($upassword){
        $salt = random_string("alnum");
        $salted = $upassword.$salt;
        return array("salt"=>$salt,"password"=>hash("sha256",$salted));
    }
    function getarray(){
        $out = array();
        $sql = "select id,nname from users ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $out["all"] = "Semua";
        foreach($que->result() as $res){
            $out[$res->nname] = $res->nname;
        }
        return $out;
    }
    function getUser($id){
        $sql = "select a.id,a.nname,a.fname,a.mname,a.lname,a.password,a.email from users a ";
        $sql.= "where a.id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0];
    }
    function getUsers(){
        $sql = "select a.id,a.nname,a.fname,a.mname,a.lname,a.password,a.email from users a " ;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function login($email,$password){
        $sql = "select id,nname,email,salt,password from users where email='".$email."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
        $salted = $password.$res[0]->salt;
            if($res[0]->password===hash("sha256",$salted)){
                return array("message"=>"password benar","username"=>$res[0]->nname,"userid"=>$res[0]->id);
            }
            else{
                return array("message"=>"password tidak cocok");
            }
        }else{
            return array("message"=>"email tidak dikenali");
        }
    }
    function remove($id){
        $sql = "delete from users where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $sql = "insert into users (nname,fname,mname,lname,email) ";
        $sql.= "values ";
        $sql.= "('".$params['nname']."',";
        $sql.= "'".$params['fname']."',";
        $sql.= "'".$params['mname']."',";
        $sql.= "'".$params['lname']."',";
        $sql.= "'".$params['email']."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = "update users set nname= '".$params["nname"]."',email='".$params["email"]."', ";
        $sql.= "fname='".$params["fname"]."',mname='".$params["mname"]."',lname='".$params["lname"]."' ";
        $sql.= "where ";
        $sql.= "id='".$params['id']."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getrole($user_id=0){
        $sql = "select role from users where id=".$user_id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            return $que->result()[0]->role;
        }else{
            return "0";
        }
    }
}