<?php
require _LIB.'/Router/Router.class.php';
require _LIB.'/Router/Route.class.php';
$router = new Router($url_array);

$authRoute = $router->addRoute('json/login', '', 'authenticate.php');
$signinRoute = $router->addRoute('json/signin', '', 'create_user.php');
$presenceRoute = $router->addRoute('json/presence', '', 'presence_list.php');

$router->run();