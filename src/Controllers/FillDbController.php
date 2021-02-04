<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/2/21
 * Time: 11:36 AM
 */


namespace App\Controllers;

use App\Models\Api;
use App\Models\Posts;
use App\Models\Users;


final class FillDbController implements ControllersInterface
{
    private array $urls ;
    private Users $users_model;
    private Posts $posts_model;

    public function __construct()
    {
        require_once 'src/config.php';
        /** @var $getConfig */
        $this->urls =  $getConfig('Api');
        $this->users_model = new Users();
        $this->posts_model = new Posts();
    }

    public function index(): void
    {
        $users = $this->getUsers();
        $posts = $this->getPosts();
        $this->dbFill($users, $posts);
    }
    /*
    * getting users data (curl)
    * */
    private function getUsers():array{
        $curl = new Api($this->urls['users']);
        return json_decode($curl->getData(),true);
    }
    /*
     * getting posts data (curl)
     * */
    private function getPosts():array{
        $curl = new Api($this->urls['posts']);
        $posts_array = json_decode($curl->getData(),true);

        return $this->postsArrayReformatting($posts_array);
    }
    /*
     * posts array group by user id
     *
     * */
    private function postsArrayReformatting(array $posts_array):array{
        $arr = array();
        foreach ($posts_array as $val){
            if(!isset($arr[$val['userId']])){
                $arr[$val['userId']] = array();
            }
            array_push($arr[$val['userId']],$val);
        }
        return $arr;
    }
    /*
     * DB fill
     * */
    private function dbFill(array $users, array $posts):void{
        foreach ($users as $user) {
            $current_user_id = $user['id'];
            /*users save*/
            $new_id = $this->users_model->create(['name' => $user['name'], 'email' => $user['email']]);
            if($new_id !== 0) {
                if (isset($posts[$current_user_id])) { /* check if current users posts exists */
                    foreach ($posts[$current_user_id] as $post) {
                        $this->posts_model->create(['user_id' => $new_id, 'title' => $post['title'], 'body' => $post['body']]);
                    }
                }
            }
        }
}
}
