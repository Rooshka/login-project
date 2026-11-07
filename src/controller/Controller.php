<?php

class Controller
{
    protected function view(string $name, array $data = []): void
    {
        $viewPath = __DIR__ . '/../../views/' . $name . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            exit('View not found');
        }

        extract($data);

        include __DIR__ . '/../../views/templates/header.php';
        include $viewPath;
        include __DIR__ . '/../../views/templates/footer.php';
    }
}
