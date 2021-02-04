<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/2/21
 * Time: 6:30 PM
 */


namespace App\Controllers;
/*
 * app/home controller
 * */
final class HomeController implements ControllersInterface
{
  public function index(): void
  {
   ob_start();
   require_once 'public/templates/form.php';
   echo ob_get_clean();
  }
}
