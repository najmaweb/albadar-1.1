<?php
function terbilang($str){
    for($c=0;$c<strlen($str);$c++){
        switch(strlen($str) - $c){
            case 1:
            echo "puluh ";
            break;
            case 2:
            echo "ratus ";
            break;
            case 3:
            echo "ribu ";
            break;
            case 4:
            echo "puluh ";
            break;
            case 5:
            echo "ratus ";
            break;
            
        }
        switch($str[$c]){
            case '1':
            echo "se";
            break;
            case '2':
            echo "dua ";
            break;
            case '3':
            echo "tiga ";
            break;
            case '4':
            echo "empat ";
            break;
            case '5':
            echo "lima ";
            break;
            case '6':
            echo "enam ";
            break;
            case '7':
            echo "tujuh ";
            break;
            case '8':
            echo "delapan ";
            break;
            case '9':
            echo "sembilan ";
            break;
        }
    }
    echo "<br />";
}