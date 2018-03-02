<?php
class Router extends Singleton {

    public function route() {
        if( isset($_GET['module']) && isset($_GET['action']) ) {
            
            // Get parameters
            $params = $_GET;
            array_shift($params);
            array_shift($params);

            // Check module exists
            $moduleUrl = "../app/modules/".$_GET['module'];
            if( !file_exists($moduleUrl) ) {
                throw new RouterException("Module '".$_GET['module']."' not found");
            }

            // Check routes file exists
            $routesUrl = $moduleUrl."/routes.json";
            if( !file_exists($routesUrl) ) {
                throw new RouterException("Routes file is missing in module '".$_GET['module']."'");
            }

            // Load routes file
            $routes = json_decode(file_get_contents($routesUrl));

            // Check action
            if( !isset($routes->{$_GET['action']}) ) {
                throw new RouterException("Action not found '".$_GET['action']."' in module '".$_GET['module']."'");
            }
            $action = $routes->{$_GET['action']};
            $this->validateAction($action);

            // Check session if auth protected
            if(isset($action->authprotected) && $action->authprotected === TRUE) {
                if(!isset($_SESSION['user'])) {
                    throw new AccessException("Access denied");
                }
            }

            // Check views folder exists
            $viewsUrl = $moduleUrl."/views";
            if( !file_exists($viewsUrl) ) {
                throw new RouterException("Views folder is missing in module '".$_GET['module']."'");
            }

            // Instantiate plates engine
            $plates = new League\Plates\Engine();
            $plates->addFolder('layouts', '../app/layout/views');
            $plates->addFolder('views', $viewsUrl);

            // Instantiate layout controller
            require '../app/layout/LayoutController.php';
            $layoutController = new LayoutController($plates);
            $layoutController->init();
			
			// Check model exists, if set
			$model = null;
			if( isset($action->model) ) {
				$modelUrl = $moduleUrl."/".$action->model.".php";
				if( !file_exists($modelUrl) ) {
					throw new RouterException("Model file '".$action->model."' is missing in module '".$_GET['module']."'");
				}
				require $modelUrl;
				if( !class_exists($action->model) ) {
					throw new RouterException("Model '".$action->model."' seems to be wrongly named in model file in module '".$_GET['module']."'");
				}
				$db = new PDO("mysql:host=".$GLOBALS['mysql']['host'].";port=".$GLOBALS['mysql']['port'].";dbname=".$GLOBALS['mysql']['db'].";charset=utf8", $GLOBALS['mysql']['user'], $GLOBALS['mysql']['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				
				$model = new $action->model($db);
			}

            // Check controller exists
            $controllerUrl = $moduleUrl."/".$action->controller.".php";
            if( !file_exists($controllerUrl) ) {
                throw new RouterException("Controller file '".$action->controller."' is missing in module '".$_GET['module']."'");
            }
            require $controllerUrl;
            if( !class_exists($action->controller) ) {
                throw new RouterException("Controller '".$action->controller."' seems to be wrongly named in controller file in module '".$_GET['module']."'");
            }
			
			// Instantiate controller
            $controller = new $action->controller($plates, $model);
			

            // Check method exists
            if( !method_exists($controller, $action->method) ) {
                throw new RouterException("Method '".$action->method."' was not found in controller '".$action->controller."' in module '".$_GET['module']."'");
            }

            // Call action
            if( call_user_func_array( array($controller, $action->method), $params ) === FALSE ) {
                throw new RouterException("Method '".$action->method."' could not be called in controller '".$action->controller."' in module '".$_GET['module']."'");
            }

        } else {
            // Go to default route
            header("location: ".$GLOBALS['base_url']."?module=".$GLOBALS['defaultRoute'][0]."&action=".$GLOBALS['defaultRoute'][1]);
            die();
        }
    }

    private function validateAction($action) {
        if( !isset($action->controller) || empty(trim($action->controller)) ) {
            throw new RouterException("Controller attribute is missing or empty for action '".$_GET['action']."' in module '".$_GET['module']."'");
        } else if( !isset($action->method) || empty(trim($action->method)) ) {
            throw new RouterException("Method attribute is missing or empty for action '".$_GET['action']."' in module '".$_GET['module']."'");
        }
    }

}