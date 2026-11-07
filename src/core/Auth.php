<?php

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function hasRole(string ...$roles): bool
    {
        return self::check() && in_array($_SESSION['user']['role'], $roles, true);
    }
}
