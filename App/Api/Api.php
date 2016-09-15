<?php

namespace App\Api;

use App\Config as Config;

class Api{
    
    /**
     * fetch data from external data source
     * @param  string parmas $str Get request params
     * @param  string api    to gather from [$api = 'taxon']
     * @return array array with objects from api
     */
    public static function fetchData($str, $api = 'taxon'){
        $data = file_get_contents(Config::$api_url[$api].$str);
        return json_decode($data);
    }
    
}