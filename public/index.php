<?php
define("APP_MODE", "web"); // ou "web"
define('BASE_PATH', __DIR__ . '/../src/');
require_once BASE_PATH . 'routes/routes.php';
require_once BASE_PATH . 'controllers/HomeController.php';
require_once BASE_PATH . 'controllers/PageController.php';
require_once BASE_PATH . 'api/application.php';
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$method = $_SERVER['REQUEST_METHOD'];
if (APP_MODE === "api") {
    $app = new Application();
    $app->start();
} else {
    if (isset($routes[$method][$uri])) {
        $action = $routes[$method][$uri]; // Ex: 'HomeController@index'
        [$controllerName, $methodName] = explode('@', $action);
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                http_response_code(500);
                echo "Método {$methodName} não encontrado no controller.";
            }
        } else {
            http_response_code(500);
            echo "Controller {$controllerName} não encontrado.";
        }
    } else {
        http_response_code(404);
        echo "Página não encontrada";
    }
}