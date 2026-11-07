<?php
require_once __DIR__ . '/Csrf.php';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function csrf_field(): string
{
    return Csrf::field();
}

function inputClass(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'input input--error' : 'input';
}

function ariaError(array $errors, string $field): string
{
    return isset($errors[$field])
        ? 'aria-invalid="true" aria-describedby="' . e($field) . '-error"'
        : '';
}

function fieldError(array $errors, string $field): string
{
    return isset($errors[$field]) ? e($errors[$field]) : '';
}
