<?php
if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $filePath = __DIR__ . $requestPath;

    if ($requestPath !== '/' && is_file($filePath)) {
        return false;
    }
}

session_start();

require_once __DIR__ . '/src/core/Database.php';
require_once __DIR__ . '/src/core/Routes.php';
require_once __DIR__ . '/src/core/Csrf.php';
require_once __DIR__ . '/src/core/helpers.php';
require_once __DIR__ . '/src/core/Auth.php';

$router = new Routes();

$router->get('/', ['HomeController', 'index']);
$router->get('/register', ['AuthController', 'registerForm']);
$router->post('/register', ['AuthController', 'register']);
$router->get('/login', ['AuthController', 'loginForm']);
$router->post('/login', ['AuthController', 'login']);
$router->get('/account', ['AccountController', 'index'], ['user']);
$router->post('/logout', ['AuthController', 'logout'], ['user']);

$router->run();
