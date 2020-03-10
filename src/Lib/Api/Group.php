<?php
namespace KEBHanna\FinfluxSDK\Lib\Api;

use KEBHanna\FinfluxSDK\Lib\Common;
use Illuminate\Support\Facades\Log;
use KEBHanna\FinfluxSDK\Error\FinfluxException;

class Group 
{
    public static function createGroup($token,$request_data){ 
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups';
            $result         = Common::post($finflux_url,$token,$request_data); 
            return $result;

        } catch(FinfluxException $e){
            throw $e;
        }
        
    }

    public static function listGroups($token){
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups';
            $result         = Common::get($finflux_url,$token); 
            return $result;
        }catch(FinfluxException $e){
            throw $e;
        }
        
    }

    public static function retrieveGroupTemplate($token,$id){
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups/template';
            $result         = Common::get($finflux_url,$token);
            return $result;
        } catch(FinfluxException $e){
            throw $e;
        }
        
        
    }

    public static function retrieveGroup($token,$id){
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups/'.$id;
            $result         = Common::get($finflux_url,$token);
            return $result;
        } catch(FinfluxException $e){
            throw $e;
        }
        
    }

    public static function updateGroup($token,$id,$request_data){
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups/'.$id;
            $result         = Common::put($finflux_url,$token,$request_data);
            return $result;
        } catch(FinfluxException $e){
            throw $e;
        }
        
    }

    public static function deleteGroup($token,$id){
        try{
            $finflux_url    = env('FINFLEX_BASE_URL').'/groups/'.$id;
            $result         = Common::delete($finflux_url,$token);
            return $result;
        } catch(FinfluxException $e){
            throw $e;
        }
        
    }
}
