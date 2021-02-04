<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/2/21
 * Time: 9:47 PM
 */


namespace App\Models;


class Api
{
    private string $url;
    public function __construct(string $url)
    {
        $this->url = $url;
    }
    public function getData($string = 1):string{
        $resource = \curl_init();
        curl_setopt($resource, CURLOPT_URL, $this->url);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, $string);
        $res =curl_exec( $resource );
        curl_close($resource);
        return $res;
    }

}
