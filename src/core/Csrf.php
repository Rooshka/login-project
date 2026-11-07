<?php

class Csrf
{
    public static function token(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function field(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . self::token() . '">';
    }

    public static function check(): void
    {
        $sent = $_POST['csrf_token'] ?? '';
        $saved = $_SESSION['csrf_token'] ?? '';

        if (!is_string($sent) || !is_string($saved) || $saved === '' || !hash_equals($saved, $sent)) {
            http_response_code(403);
            exit('403 - Invalid CSRF token');
        }
    }
}
