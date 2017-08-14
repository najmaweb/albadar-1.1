<?php
function add_trailing_zero($num,$limit=5){
    for($c = strlen($num);$c<$limit;$c++){
        $num = "0".$num;
    }
    return $num;
}
function terbilang($params){
    $str = "";
    $no_se = array(2,5,8);
    $with_satu = array(1,4,7);
    $belas = false;
    $has_zero = false;
    for($c = 0;$c < strlen($params); $c++){
        $urutdigit = strlen($params) - $c;
        switch($params[$c]){
            case '1':
                if(in_array($urutdigit,$no_se)){
                }elseif($belas){
                    $str.= " se";
                    $str.="";
                }elseif(in_array($urutdigit,$with_satu)){
                    $str.= " satu";
                }else{
                    $str.= " se";
                }
            break;
            case '2':$str.= " dua";break;
            case '3':$str.= " tiga";break;
            case '4':$str.= " empat";break;
            case '5':$str.= " lima";break;
            case '6':$str.= " enam";break;
            case '7':$str.= " tujuh";break;
            case '8':$str.= " delapan";break;
            case '9':$str.= " sembilan";break;
            case '0':$has_zero=true;break;
        }
        if($belas){
            if($params[$c]==='0'){
                $str.= " sepuluh";
            }else{
                $str.= " belas";
            }
            $belas = false;
        }
        if(($params[$c]==='1')&&(in_array($urutdigit,$no_se))){
            $belas = true;
        }
            switch($urutdigit){
                case 2:
                if(!$belas){
                    if(!$has_zero){
                        $str.= " puluh";
                    }
                }
                break;
                case 3:
                if(!$has_zero){
                    $str.= " ratus";
                }
                break;
                case 4:
                $str.= " ribu";
                break;
                case 5:
                if(!$belas){
                    if(!$has_zero){
                        $str.= " puluh";
                    }
                }
                break;
                case 6:
                if(!$has_zero){
                    $str.= " ratus";
                }
                break;
                case 7:
                $str.= " juta";
                break;
                case 8:
                if(!$belas){
                    if(!$has_zero){
                        $str.= " puluh";
                    }
                }
                break;
            }
            $has_zero = false;
    }
    //echo number_format($params) . "<br />";
    return $str;
}
function removedot($str){
    return str_replace(",","",$str);
}
