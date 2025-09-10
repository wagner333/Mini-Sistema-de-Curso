<?php

require_once __DIR__ . '/../core/Template.php';

class PageController {
    private Template $template;
    public function __construct() {
        $this->template = new Template();
    }
    public function about(): void {
        $this->template->render('home', [
            'tituloPagina' => 'Sobre nos',
            'title' => 'about',
            'Mainpage' => 'nosso objetivo e vender produtos de baixa qualidade'
        ]);
    }
}
