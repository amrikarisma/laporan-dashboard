<?php
namespace App\Lib;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;

class MyHelper{

    public static function hasAccess($granted, $features){
        foreach($granted as $g){
            if(!is_array($features)) $features = session('granted_features');
            if(in_array($g, $features)) return true;
        }

        return false;
    }

    public static function postLogin($request){
        $api = env('API_URL');
        $client = new Client;
        try {
            $response = $client->request('POST',$api.'/api/login', [
                'headers' => [
                    'Accept'        => 'application/json',
                ],
                'form_params' => [
                    'email'      => $request->email,
                    'password'      => $request->password,
                    'device_name'   => 'dashboard'
                ],
                'connect_timeout' => 30
            ]);
            return json_decode($response->getBody(), true);
        }catch (\GuzzleHttp\Exception\RequestException $e) {
            try{
                if($e->getResponse()){
                    $response = $e->getResponse()->getBody()->getContents();
                    return json_decode($response, true);
                }
                else{
                    return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
                }

            }
            catch(Exception $e){
                return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function apiGet($url, $data = []){
        $api = env('API_URL');
        $client = new Client;

        $ses = session('token');

        $content = array(
            'headers' => [
                'Authorization'   => $ses,
                'Accept'          => 'application/json',
                'Content-Type'    => 'application/json',
                'ip-address-view' => Request::ip(),
                'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
            ],
            'connect_timeout' => 30

        );
        if ($data) {
            $query_params = http_build_query($data); // xxx=yyy&zzz=aaa
            if (strpos($url, '?')) {
                $url .= '&'.$query_params;
            } else {
                $url .= '?'.$query_params;
            }
        }

        try {
            $response =  $client->request('GET',$api.'/api/'.$url, $content);
            return json_decode($response->getBody(), true);
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            try{

                if($e->getResponse()){
                    $response = $e->getResponse()->getBody()->getContents();
                    $error = json_decode($response, true);

                    if(!$error) {
                        return $e->getResponse()->getBody();
                    }
                    else {
                        return $error;
                    }
                }
                else return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];

            }
            catch(Exception $e){
                return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function apiPost($url,$post){
        $api = env('API_URL');
        $client = new Client;
        $ses = session('token');
        
        $content = array(
            'headers' => [
                'Authorization'     => $ses,
                'Accept'            => 'application/json',
                'ip-address-view'   => Request::ip(),
                'user-agent-view'   => $_SERVER['HTTP_USER_AGENT'],
            ],
            'json' => (array) $post,
            'connect_timeout' => 30

        );

        try {
            $response = $client->post($api.'/api/'.$url,$content);
            if(!is_array(json_decode($response->getBody(), true)));
            return json_decode($response->getBody(), true);
        }catch (\GuzzleHttp\Exception\RequestException $e) {
            try{
                if($e->getResponse()){
                    $response = $e->getResponse()->getBody()->getContents();
                    if(!is_array($response));
                    return json_decode($response, true);
                }
                else  return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];

            }
            catch(Exception $e){
                return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function apiPostWithFile($url,$post, $request){
        $api = env('API_URL');
        $ses = session('token');
        $client = new \GuzzleHttp\Client();

        $data = [];
        foreach ($post as $key => $value) {
            $data[] = [
                'name'      => $key,
                'contents'  => $request->hasFile($key) ? fopen( $value->getPathname(), 'r' ) : $value
            ];
        }
        $content = array(
            'headers' => [
                'Authorization'     => $ses,
                'ip-address-view'   => Request::ip(),
                'user-agent-view'   => $_SERVER['HTTP_USER_AGENT'],
            ],
        );
        $content['multipart'] = $data;

        try {
            $response = $client->post($api.'/api/'.$url,$content);

            if(!is_array(json_decode($response->getBody(), true)));
            return json_decode($response->getBody(), true);
        }catch (\GuzzleHttp\Exception\RequestException $e) {
            try{
                if($e->getResponse()){
                    $response = $e->getResponse()->getBody()->getContents();
                    if(!is_array($response));
                    return json_decode($response, true);
                }
                else  return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];

            }
            catch(Exception $e){
                return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function apiRequest($method, $url, $post = []){
        $method = strtolower($method);
        $api = env('API_URL');
        $client = new Client;

        $ses = session('token');

        $content = array(
            'headers' => [
                'Authorization' => $ses,
                'Accept'        => 'application/json',
                'ip-address-view' => Request::ip(),
                'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
            ],
            'connect_timeout' => 30
        );

        if ($method == 'get') {
            if ($post) {
                $query_params = http_build_query($post); // xxx=yyy&zzz=aaa
                if (strpos($url, '?')) {
                    $url .= '&'.$query_params;
                } else {
                    $url .= '?'.$query_params;
                }
            }            
        } else {
            $content['json'] = (array) $post;
        }

        try {
            $response = $client->$method($api.'/api/'.$url,$content);
            if(!is_array(json_decode($response->getBody(), true)));
            return json_decode($response->getBody(), true);
        }catch (\GuzzleHttp\Exception\RequestException $e) {
            try{
                if($e->getResponse()){
                    $response = $e->getResponse()->getBody()->getContents();
                    if(!is_array($response));
                    return json_decode($response, true);
                }
                else  return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];

            }
            catch(Exception $e){
                return ['status' => 'fail', 'message' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function encodeImage($image){
        $size   = $image->getSize();
        $encoded = NULL;

        if( $size < 90000000 ) {
            $encoded = base64_encode(fread(fopen($image, "r"), filesize($image)));
        }
        else {
            return false;
        }

        return $encoded;
    }


    /**
     * Return int/float based on requested type
     * @param  numeric      $number Number to convert, can be numeric string, integer or anything
     * @param  string       $type   'int' , 'float' , 'double' or 'custom' for custom number format
     * @param  $custom      parameter suplied for customize number
     * @return float/int    converted number
     */
    public static function requestNumber($number,$type='int',$custom=[]) {
        if($type === '_CURRENCY'){$type = env('CURRENCY_FORMAT','rupiah');}
        switch ($type) {
            case 'int':
                return (int) $number;
                break;

            case 'float':
                return (float) $number;
                break;

            case 'double':
                return (double) $number;
                break;

            case 'rupiah':
                return 'Rp'.number_format($number,0,',','.');
                break;

            case 'dollar':
                return '$'.number_format($number,2,'.',',');
                break;

            case 'thousand_id':
                return number_format($number,0,',','.');
                break;

            case 'thousand_sg':
                return number_format($number,2,'.',',');
                break;

            case 'custom':
                return number_format($number,...$custom);
                break;

            case 'point':
                $decimals = strtoupper(env('COUNTRY_CODE','ID')) != 'SG'?0:2;
                return floor($number*(10**$decimals))/(10**$decimals);
                break;

            case 'short':
                // rounded down
                if ($number < 1000) {
                    // Anything less than a million
                    $n_format = number_format($number,0);
                } elseif ($number < 1000000) {
                    // Anything less than a billion
                    $n_format = (floor(($number/1000)*10)/10) . 'K';
                } elseif ($number < 1000000000) {
                    // Anything less than a billion
                    $n_format = (floor(($number/1000000)*10)/10) . 'M';
                } else {
                    // At least a billion
                    $n_format = (floor(($number/1000000000)*10)/10) . 'B';
                }
                return $n_format;
                break;

            default:
                return $number;
                break;
        }
    }

    /**
     * get Excel column name from number
     * @param Integer number of column (ex. 1)
     * @return String Excel column name (ex. A)
     */
    public static function getNameFromNumber($num)
    {
        $alphabet = range('A', 'Z');
        $numeric  = ($num - 1) % 26;
        $letter   = $alphabet[$numeric];
        $num2     = (float) $num / 26;
        if ($num2 > 1 ) {
            return MyHelper::getNameFromNumber(intval($num2)) . $letter;
        } else {
            return $letter;
        }
    }
}
