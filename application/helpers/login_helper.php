<?php
    function checklogin(){
        if(!isset($_SESSION["username"])){
            redirect("../../main/login");
        }
    }
