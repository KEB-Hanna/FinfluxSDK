<?php
namespace KEBHanna\FinfluxSDK\Lib\Api;

use KEBHanna\FinfluxSDK\Lib\Common;
use Illuminate\Support\Facades\Log;
class Client 
{
    public static function createClient($token,$request_data){ 
        $finflux_url    = env('FINFLEX_BASE_URL').'/clients';
        $result         = Common::post($finflux_url,$token,$request_data);   
        return $result;
    }

    public static function listClients($token){
        $finflux_url    = env('FINFLEX_BASE_URL').'/clients';
        $result         = Common::get($finflux_url,$token); 
        return $result;
    }

    public static function retrieveClient($token,$id){
        $finflux_url    = env('FINFLEX_BASE_URL').'/clients/'.$id;
        $result         = Common::get($finflux_url,$token);
        return $result;
        
    }

    public static function updateClient($token,$id,$request_data){
        $finflux_url    = env('FINFLEX_BASE_URL').'/clients/'.$id;
        $result         = Common::put($finflux_url,$token,$request_data);
        return $result;
    }

    public static function deleteClient($token,$id){
        $finflux_url    = env('FINFLEX_BASE_URL').'/clients/'.$id;
        $result         = Common::delete($finflux_url,$token);
        return $result;
        
    }
}
