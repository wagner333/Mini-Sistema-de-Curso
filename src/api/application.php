<?php

require_once __DIR__ . '/../core/Router.php';


class Application
{
    public function start(): void
    {
        $router = new Router();
        $router->create("GET", "/", function () {
            echo json_encode(["message" => "API rodando!"]);
        });
        $router->init();
    }
}

