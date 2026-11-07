<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Учебный проект') ?> | Northstar</title>
    <link rel="stylesheet" href="/public/css/global.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <script src="/public/js/validation.js" defer></script>
</head>
<body>
<header class="header">
    <div class="container header__inner">
        <a class="logo" href="/">NORTHSTAR<span>.</span></a>
        <nav class="nav" aria-label="Основная навигация">
            <a href="/">Главная</a>
            <?php if (Auth::check()): ?>
                <a href="/account">Личный кабинет</a>
                <form action="/logout" method="post" class="nav__form">
                    <?= csrf_field() ?>
                    <button type="submit" class="nav__logout">Выйти</button>
                </form>
            <?php else: ?>
                <a href="/login">Вход</a>
                <a class="nav__register" href="/register">Регистрация</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="main">
