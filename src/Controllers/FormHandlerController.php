<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/2/21
 * Time: 9:44 PM
 */


namespace App\Controllers;


use App\Models\Posts;
use App\Models\Users;

final class FormHandlerController implements ControllersInterface
{
    private Posts $post_model;
    private Users $users_model;

    public function index(): void
 {
     $this->users_model = new Users();
     $this->post_model = new Posts();

     $this->formHandler($_POST);
 }
 private function formHandler(array $form_data):void{
//        $this->formValidator($form_data);
        $user_params = array(
            'name'=>$form_data['user_name'],
            'email'=>$form_data['user_email']
        );
       $user_id = $this->users_model->create($user_params);
       $post_params = array(
           'user_id'=>$user_id,
           'title'=>$form_data['post_title'],
           'body'=>$form_data['post_body']
       );

       $this->post_model->create($post_params);
       header('Location:/');
 }
 private function formValidator(array $post_data){
        /* do something */
     /*if no valid - build errors object and save it in cookies use it in view for show not valid fields*/
//     return $errors_object;

 }


}
