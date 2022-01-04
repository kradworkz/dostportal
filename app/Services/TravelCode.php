<?php

namespace App\Services;

use App\Models\Travel;

class TravelCode {

    public static function generate($status) 
    {
        $type = 'ORD';
        $year = date('Y');
        $month = date('m');
        
        switch($status){
            case 0:
                $word = "OUT";
            break;
            case 1:
                $word = "IN";
            break;
        }
        
;       $count = Travel::where('is_incoming',$status)->count();
        
		return $routingslip = $year."-".$word.''.$month."-".$type."-".($count+1);  
    }
    
}