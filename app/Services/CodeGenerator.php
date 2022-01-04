<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Travel;

class CodeGenerator {

    public static function generateDoc($status) 
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
        
;       $count = Document::where('is_incoming',$status)->count();
        
		return $routingslip = $year."-".$word.''.$month."-".$type."-".($count+1);  
    }

    public static function generateTrvl($status) 
    {
        // dd($status);
        $year = date('Y');
        $month = date('m');
        
        switch($status){
            case 0:
                $word = "TRVL";
            break;
            case 1:
                $word = "VHCL";
            break;
        }
        
;       $count = Travel::where('is_vehicle',$status)->count();
        // dd($count);
		return $code = $year."-".$word.''.$month.'-'.($count+1);  
    }
    
}