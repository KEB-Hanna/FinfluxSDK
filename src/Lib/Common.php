<?php
namespace KEBHanna\FinfluxSDK\Lib;

use Illuminate\Support\Facades\Log;
use KEBHanna\FinfluxSDK\Error\FinfluxException;

class Common
{

    /*
    cache use Throwable for php 7
    <---Note--->
    interface Throwable
    |- Exception implements Throwable
        |- ...
    |- Error implements Throwable
        |- TypeError extends Error
        |- ParseError extends Error
        |- ArithmeticError extends Error
            |- DivisionByZeroError extends ArithmeticError
        |- AssertionError extends Error
        link => https://trowski.com/2015/06/24/throwable-exceptions-and-errors-in-php7/
    */

    public static function auth(){

        $username = env('FINFLEX_USER');
        $password = env('FINFLEX_PASSWORD');
        $url      = env('FINFLEX_AUTH_URL');

        $data = array(
            'username'=>$username,
            'password'=>$password,
            "client_id"=>"community-app",
            "grant_type"=>"password",
            "client_screct"=> "123"
        );
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Fineract-Platform-TenantID:hanadevelop'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        curl_close($ch);
        
        if($info["http_code"] == 200){
            $result = json_decode($result);
            return $result;
        }else{
            $data = array(
                'request' => $info,
                'response' => $result,
                'error' => json_decode($err)
            );
            
            $message = $result .' '.json_encode($data);
            Log::error($message);
            throw new FinfluxException($message,$info["http_code"]);
        }
    }

    public static function get($url, $token) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Fineract-Platform-TenantID:hanadevelop', 'Authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result);
        if($info["http_code"] == 200){
            return $result;
        }else{
            $data = array(
                'request' => $info,
                'response' => $result,
                'error' => json_decode($err)
            );
           
            $message = $result->error .' '.json_encode($data);
            Log::error($message);
            throw new FinfluxException($message,$info["http_code"]);
        }

    }

    public static function post($url, $token, $payload, $fileUpload = false, $dataTable = false) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($fileUpload == true){
            $header_content_type = 'Content-Type:text/plain';
        }else{
            $header_content_type = 'Content-Type:application/json';
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            $header_content_type, 
            'Fineract-Platform-TenantID:hanadevelop', 
            'Authorization:Bearer '.$token
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($fileUpload == true){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        }

        if($fileUpload == true){
            curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
        }else{
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        curl_close($ch);
        
        
        if($info["http_code"] == 200){
            $result = json_decode($result);
            return $result;
        }else{
            $data = array(
                'request' => $info,
                'response' => $result,
                'error' => json_decode($err)
            );
            
            $message = $result .' '.json_encode($data);
            Log::error($message);
            throw new FinfluxException($message,$info["http_code"]);
        }
    }

    public static function put($url, $token, $payload, $fileUpload = false, $dataTable = false) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($fileUpload == true){
            $header_content_type = 'Content-Type:text/plain';
        }else{
            $header_content_type = 'Content-Type:application/json';
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header_content_type, 'Fineract-Platform-TenantID:hanadevelop', 'Authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($fileUpload == true){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        }

        if($fileUpload == true){
            curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
        }else{
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if($info["http_code"] == 200){
            $result = json_decode($result);
            return $result;
        }else{
            $data = array(
                'request' => $info,
                'response' => $result,
                'error' => json_decode($err)
            );
            
            $message = $result .' '.json_encode($data);
            Log::error($message);
            throw new FinfluxException($message,$info["http_code"]);
        }
    }

    public static function delete($url, $token, $dataTable = false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Fineract-Platform-TenantID:hanadevelop', 'Authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if($info["http_code"] == 200){
            $result = json_decode($result);
            return $result;
        }else{
            $data = array(
                'request' => $info,
                'response' => $result,
                'error' => json_decode($err)
            );
            
            $message = $result .' '.json_encode($data);
            Log::error($message);
            throw new FinfluxException($message,$info["http_code"]);
        }

    }

}
