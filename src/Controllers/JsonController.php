<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/4/21
 * Time: 6:33 PM
 */


namespace App\Controllers;


use App\Models\Posts;

class JsonController
{
    private Posts $post_model;
    public function __construct()
    {
        $this->post_model = new Posts();
    }

    public function getByid(int $post_id){
        $res = $this->post_model->searchById($post_id);
        if(is_array($res)){
            $res =  $this->decode($res);
        }
        $json = json_encode($res, JSON_PRETTY_PRINT);
        ob_start();
        require_once 'public/templates/json_show.php';
        echo ob_get_clean();
    }
    public function getByUserId(int $user_id){
        $res = $this->post_model->searchByUserId($user_id);
        if(is_array($res)){
            $res =  $this->decode($res);
        }
        $json = json_encode($res, JSON_PRETTY_PRINT);
        ob_start();
        require_once 'public/templates/json_show.php';
        echo ob_get_clean();
    }
    private function decode(array $res_arr):array{
        foreach ($res_arr as $key => $post){
            $res_arr[$key]['body'] = str_replace("\n","",$post['body']);
        }
        return $res_arr;
    }

}
