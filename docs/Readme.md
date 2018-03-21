# My MVC framework

# To add routes

$router->addRoute("a", "aView.php", "aController.php");
$router->addRoute("a/a", "aaView.php", "aaController.php");

$router->run();
