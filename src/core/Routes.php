<?php

class Routes
{
    private array $routes = [];

    public function get(string $path, array $handler, array $roles = []): void
    {
        $this->routes['GET'][$path] = ['handler' => $handler, 'roles' => $roles];
    }

    public function post(string $path, array $handler, array $roles = []): void
    {
        $this->routes['POST'][$path] = ['handler' => $handler, 'roles' => $roles];
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $path = '/' . trim($path, '/');
        $path = $path === '/' ? '/' : rtrim($path, '/');

        if ($method === 'POST') {
            Csrf::check();
        }

        $route = $this->routes[$method][$path] ?? null;

        if ($route === null) {
            http_response_code(404);
            echo '404 - Страница не найдена';
            return;
        }

        if (!$this->checkAccess($route['roles'])) {
            return;
        }

        [$controllerName, $controllerMethod] = $route['handler'];
        require_once __DIR__ . '/../controller/' . $controllerName . '.php';

        $controller = new $controllerName();
        $controller->$controllerMethod();
    }

    private function checkAccess(array $roles): bool
    {
        if ($roles === []) {
            return true;
        }

        if (!Auth::check()) {
            header('Location: /login');
            return false;
        }

        if (!Auth::hasRole(...$roles)) {
            http_response_code(403);
            echo '403 - Доступ запрещён';
            return false;
        }

        return true;
    }
}
