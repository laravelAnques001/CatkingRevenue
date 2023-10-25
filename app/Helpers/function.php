<?php 
    function perFindValue( $a=0 , $b=0 ){
        if($a > 0 || $b > 0){
            return round((($a * 100) / ($a + $b)), 2); 
        }
        return 0;
    }

    function perFindAvg($a=0 , $b=0){
        if($b > 0){
            return round(((($a - $b) / $b) * 100), 2);
        }elseif($a > 0){
            return 100;
        }else{
            return 0;
        }       
    }

    function numberFormat($a){
        if($a != 0 ){
            return number_format($a,2);
        }
        return 0;
    }

    function arrNumberFormat($a){
        if(!is_null($a))
        {
            return array_map(function($number) {
                return number_format($number,1);
            }, $a);
        }
        return [];
    }
?>
