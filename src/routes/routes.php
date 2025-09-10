<?php

// routes.php

$routes = [
    'GET' => [
        '/' => 'HomeController@index', // Rota para a página inicial
        '/sobre' => 'PageController@about'
    ],
    'POST' => [
        '/contact' => 'ContactController@send' // Rota para enviar um formulário
    ]
];

return $routes; // Retorna o array de rotas

