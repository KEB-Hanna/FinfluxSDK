<?php
namespace KEBHanna\FinfluxSDK\Lib\Api;

use KEBHanna\FinfluxSDK\Lib\Common;
use Illuminate\Support\Facades\Log;
class Loan 
{
    public static function submitLoanApplication($token,$request_data){ 
        $finflux_url    = env('FINFLEX_BASE_URL').'/loans';
        $result         = Common::post($finflux_url,$token,$request_data);   
        return $result;
    }

    public static function listLoans($token){ 
        $finflux_url    = env('FINFLEX_BASE_URL').'/loans';
        $result         = Common::get($finflux_url,$token);   
        return $result;
    }

    public static function retreiveLoan($token){ 
        $finflux_url    = env('FINFLEX_BASE_URL').'/loans/'.$id;
        $result         = Common::get($finflux_url,$token);   
        return $result;
    }

    public static function updateLoan($token,$id,$request_data){ 
        $finflux_url    = env('FINFLEX_BASE_URL').'/loans/'.$id;
        $result         = Common::put($finflux_url,$token,$request_data);   
        return $result;
    }

    public static function deleteLoan($token,$id){
        $finflux_url    = env('FINFLEX_BASE_URL').'/loans/'.$id;
        $result         = Common::delete($finflux_url,$token);
        return $result;
        
    }

}
