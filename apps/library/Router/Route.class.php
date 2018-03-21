<?php
/**
 * @author tguillouet
 */
class Route {
    private $route;
    private $view;
    private $controller;

    /**
     * @param String $route : the route who will be written just after http://domainName/
     * @param String $view : the name of the view ( it must be placed into the app/views folder )
     * @param String $controller : the name of the controller ( it must be placed into the app/controllers folder )
     */
    public function __construct ($route, $view, $controller = "") {
        $this->route = $route;

        // Define controllers path
        if ($controller != "") $this->controller = _CONTROLLERS."/".$controller;  
        else $this->controller = "";

        // Define view path
        if ($view != "") $this->view = _VIEWS."/".$view;  
        else $this->view = "";
    }

    // Get the current route
    public function getRoute() {
        return $this->route;
    }

    public function runRoute() {
        if ($this->checkFileExists()) {
            $sqlQuery = $GLOBALS['sqlQuery'];
            $debugLib = $GLOBALS['debugLib'];
            $encrypt = $GLOBALS['encrypt'];
            $common = $GLOBALS['common'];
            if ($this->controller != ""){ require $this->controller; }
            if ($this->view != "") { include $this->view; }     
        }
    }

    private function checkFileExists() {
        $errors = false;
        if ($this->controller != "" && !file_exists($this->controller)) {
            echo "Controller not found ! <br />";
            $errors = true;
        }
        if (!file_exists($this->view) && $GLOBALS['ini']->needViews == true) {
            echo "View not found ! <br />";
            $errors = true;
        }
        if ($errors) {
            return false;
        }
        return true;
    }
}