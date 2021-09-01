<?php

namespace classes;

class Ipstack
{

    private $ip;

    function __construct($ip)
    {
        $this->ip = $ip;
    }

    function getContinent()
    {
        $access_key = '8f32a01998e7ae1d174e952801ef0d08';

        $ch = curl_init('http://api.ipstack.com/' . $this->ip . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $api_result = json_decode($json, true);
        $continent = $api_result['continent_code'];
        if($continent){
            return $continent;
        }else{
            return '';
        }
       
    }
}
