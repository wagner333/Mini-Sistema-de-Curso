<?php


class Router
{
    protected array $routes = [];

    public function create(string $method, string $path, callable $callback): void
    {
        $this->routes[$method][$path] = $callback;
    }

    public function init(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $httpMethod = $_SERVER["REQUEST_METHOD"];
        $uri = strtok($_SERVER["REQUEST_URI"], "?"); // tira query string

        if (isset($this->routes[$httpMethod][$uri])) {
            $this->routes[$httpMethod][$uri]();
            return;
        }

        http_response_code(404);
        echo json_encode(["error" => "Rota não encontrada"]);
    }
}

