<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/2/21
 * Time: 6:41 PM
 */

use App\Controllers\FillDbController;
use App\Controllers\FormHandlerController;
use App\Controllers\JsonController;
use Bramus\Router\Router;
use App\Controllers\HomeController;

$router = new Router();

$router->get("/", function() {
    $home = new HomeController();
    $home->index();
    }
);
$router->get("/json/by_post/(\d+)", function($post_id) {
    $controller = new JsonController();
    $controller->getByid($post_id);
}
);
$router->get("/json/by_user/(\d+)", function($user_id) {
    $controller = new JsonController();
    $controller->getByUserId($user_id);
}
);

$router->get("/fill_db", function (){
    $home = new FillDbController();
    $home->index();
    }
);
$router->post("/form", function (){
    $home = new FormHandlerController();
    $home->index();
}
);
$router->set404(function() {
    $home = new HomeController();
    $home->index();
});
$router->run();
