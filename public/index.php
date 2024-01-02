<?php

require_once __DIR__ . '/../app/Controllers/CoreController.php';
require_once __DIR__ . '/../app/Controllers/MainController.php';
require_once __DIR__ . '/../app/Controllers/ChatController.php';
require_once __DIR__ . '/../app/Controllers/ErrorController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';

require_once __DIR__ . '/../app/Models/CoreModel.php';
require_once __DIR__ . '/../app/Models/MessageModel.php';
require_once __DIR__ . '/../app/Models/UserModel.php';

require_once __DIR__ . '/../app/Utils/Database.php';

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

if (!isset($_SERVER['BASE_URI'])) {
    $_SERVER['BASE_URI'] = '/';
}

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', [
    'controller' => 'MainController',
    'method' => 'home'
], 'home');

$router->map('GET', '/chat/[i:id]', [
    'controller' => 'ChatController',
    'method' => 'chat'
], 'chat');

$router->map('POST', '/chat/[i:id]', [
    'controller' => 'ChatController',
    'method' => 'insert'
], 'chat-insert');

$router->map('GET', '/login', [
    'controller' => 'UserController',
    'method' => 'login'
], 'login');

$router->map('POST', '/login', [
    'controller' => 'UserController',
    'method' => 'connect'
], 'login-connect');

$router->map('GET', '/register', [
    'controller' => 'UserController',
    'method' => 'register'
], 'register');

$router->map('POST', '/register', [
    'controller' => 'UserController',
    'method' => 'insert'
], 'register-insert');

$router->map('GET', '/logout', [
    'controller' => 'UserController',
    'method' => 'logout'
], 'logout');

$router->map('GET', '/test', [
    'controller' => 'MainController',
    'method' => 'test'
]);

$match = $router->match();

if($match) {

    $controllerName = $match["target"]["controller"];
    $methodName = $match["target"]["method"];

    $controller = new $controllerName();
    $controller->$methodName($match["params"]);

} else {

    $controller = new ErrorController();
    $controller->error404();
}
