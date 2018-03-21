<?php
/**
 * @author tguillouet
 */
class Router {
    private $routes; 
    private $url;

    /**
     * @param String $url : the array who contain the exploded url
     */
    public function __construct ($url) {
        $this->routes = array();
        $this->url = $url;
    }

    /**
     * @param String $route : the route who will be written just after http://domainName/
     * @param String $view : the name of the view ( it must be placed into the app/views folder )
     * @param String $controller : the name of the controller ( it must be placed into the app/controllers folder )
     */
    public function addRoute ($route, $view, $controller) {
        array_push($this->routes, new Route($route, $view, $controller));
    }

    /**
     * Get the route list
     */
    public function getRoutesList () {
        return $this->routes;   
    }

    /**
     * Get the current route
     */
    private function getRoute() {
        $matches = 0;
        foreach ($this->routes as $route) {
            if ('/'.$route->getRoute() == implode('/', $this->url)) {
                $matches++;
                $route->runRoute();
            }
        }
        if ($matches == 0 && file_exists(_MODELS."/404.php")) {
            $route404 = new Route("404", "404.php");
            $route404->runRoute();
        }
        return false;
    }

    /**
     * Run the router redirection
     */
    public function run () {
        $this->getRoute();
    }
}