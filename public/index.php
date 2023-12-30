<?php

// fichier index.php : FrontController, point d'entrée UNIQUE de notre application !
require_once __DIR__ . '/../app/Controllers/CoreController.php';
require_once __DIR__ . '/../app/Controllers/MainController.php';
require_once __DIR__ . '/../app/Controllers/ChatController.php';
require_once __DIR__ . '/../app/Controllers/ErrorController.php';

require_once __DIR__ . '/../app/Models/CoreModel.php';
require_once __DIR__ . '/../app/Models/MessageModel.php';
require_once __DIR__ . '/../app/Models/UserModel.php';

require_once __DIR__ . '/../app/Utils/Database.php';
// on inclut le fichier autoload.php de Composer pour charger toutes nos dépendances
require_once __DIR__ . '/../vendor/autoload.php';

// on instancie AltoRouter
$router = new AltoRouter();

// on doit définir le dossier dans lequel se trouve notre projet
$router->setBasePath($_SERVER['BASE_URI']);

// exemple route page d'accueil
$router->map('GET', '/', [
    'controller' => 'MainController',
    'method' => 'home'
], 'home');

$router->map('GET', '/chat/[i:id]', [
    'controller' => 'ChatController',
    'method' => 'chat'
], 'chat');

$router->map('GET', '/login', [
    'controller' => 'MainController',
    'method' => 'login'
], 'login');

$router->map('GET', '/register', [
    'controller' => 'MainController',
    'method' => 'register'
], 'register');

$router->map('GET', '/test', [
    'controller' => 'MainController',
    'method' => 'test'
]);

// on demande à AltoRouter de "matcher" la requête de l'utilisateur avec les routes mappées précédemment
$match = $router->match();

// on vérifie s'il y a eu un "match" entre l'URL demandée par l'utilisateur et les routes mappées
if($match) {
    // il y a eu "match", l'URL demandée correspond à une de nos routes

    // on récupère le nom du contrôleur & le nom de la méthode
    $controllerName = $match["target"]["controller"];
    $methodName = $match["target"]["method"];

    // DISPATCH
    // on instancie "dynamiquement" le bon contrôleur
    $controller = new $controllerName();
    // on appelle "dynamiquement" cette méthode
    $controller->$methodName($match["params"]);

} else {
    // $match contient false, ça veut dire que l'URL demandée ne correspond à aucune de nos routes !

    // donc ... on envoie une erreur 404 !
    $controller = new ErrorController();
    $controller->error404();
}
