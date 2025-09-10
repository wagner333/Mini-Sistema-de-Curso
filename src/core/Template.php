<?php

class Template {
    private string $basePath;

    public function __construct(string $basePath = __DIR__ . '/../views/') {
        $this->basePath = rtrim($basePath, '/') . '/';
    }
    public function render(string $template, array $dados = []): void {
        extract($dados);
        include $this->basePath . 'components/header.php';
        include $this->basePath . $template . '.php';
        include $this->basePath . 'components/footer.php';
    }
}

