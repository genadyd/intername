<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 1/31/21
 * Time: 6:45 PM
 */
$config = [
    /*
     * DB connection settings
     * */
    'Db'=>array(
        'host'=>'localhost',
        'db_name'=>'intername',
        'db_user'=>'root',
        'db_pass'=>'1234'
    ),
    /*
     * Api urls
     * */
    'Api'=>array(
        'users' => 'https://jsonplaceholder.typicode.com/users',
        'posts' => 'https://jsonplaceholder.typicode.com/posts'
    )

];
 $getConfig = function (string|int $key) use ($config):array|bool{
   return $config[$key]?? false;
};


