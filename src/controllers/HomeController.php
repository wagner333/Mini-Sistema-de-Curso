<?php

require_once __DIR__ . '/../core/Template.php';

class HomeController {
    private Template $template;
    public function __construct() {
        $this->template = new Template();
    }
    public function index(): void {
        $this->template->render('home', [
            'tituloPagina' => 'Bem-vindo à Página Inicial!',
            'title' => 'Home',
            'Mainpage' => 'seja bem vindo ao meu site'
        ]);
    }
}

