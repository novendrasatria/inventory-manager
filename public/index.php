<?php
require('../vendor/autoload.php');

use \App\System\App;
use \App\System\Router\Router;
use \App\System\Settings;
use \App\Models\UsersModel;

session_start();

$router = new Router($_GET);

$router->get('/', function() {
    $controller = new \App\Controllers\ProductsController();
    $controller->blank();
});

$router->get('/admin/dashboard/', function() {
    App::secured();
    $controller = new \App\Controllers\ProductsController();
    $controller->index();
});

$router->get('/admin/products/', function() {
    App::secured();
    $controller = new \App\Controllers\ProductsController();
    $controller->all();
});

$router->get('/admin/categories/', function() {
    App::secured();
    $controller = new \App\Controllers\CategoriesController();
    $controller->all();
});

$router->get('/posts/:id-:slug/', function($id, $slug) {
    $controller = new \App\Controllers\ProductsController();
    $controller->single($id, $slug);
})->with('id', '[0-9]+');

$router->get('/signin/', function() {
    $controller = new \App\Controllers\UsersController();
    $controller->login();
});

$router->post('/signin/', function() {
    $controller = new \App\Controllers\UsersController();
    $controller->login();
});

$router->get('/signout/', function() {
    $controller = new \App\Controllers\UsersController();
    $controller->logout();
});

$router->error(function() {
    App::error();
});

$router->run();