<section class="hero container">
    <div class="hero__content">
        <p class="eyebrow">УЧЕБНЫЙ ПРОЕКТ · PHP + MYSQL</p>
        <h1>Твой аккаунт.<br><span>Твои данные.</span></h1>
        <p class="hero__text">Небольшой сайт с регистрацией, входом и личным кабинетом. Форма проверяет данные в браузере, а PHP повторно проверяет их на сервере.</p>
        <div class="hero__actions">
            <?php if (Auth::check()): ?>
                <a class="button button--primary" href="/account">Открыть кабинет</a>
            <?php else: ?>
                <a class="button button--primary" href="/register">Создать аккаунт</a>
                <a class="button button--secondary" href="/login">Войти</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero__panel">
        <div class="panel__top"><span class="panel__dot"></span><span class="panel__dot"></span><span class="panel__dot"></span><span class="panel__label">ACCOUNT SYSTEM</span></div>
        <div class="panel__icon">✦</div>
        <p class="panel__title">NORTHSTAR ID</p>
        <p class="panel__subtitle">Личный доступ к аккаунту</p>
        <div class="panel__line"></div>
        <div class="panel__details"><span>SECURITY</span><strong>PHP + PDO</strong></div>
        <div class="panel__details"><span>VALIDATION</span><strong>JS + PHP</strong></div>
        <div class="panel__details"><span>STORAGE</span><strong>MySQL</strong></div>
    </div>
</section>
<section class="features container">
    <article class="feature"><span class="feature__number">01</span><h2>Регистрация</h2><p>Создание аккаунта с проверкой имени, электронной почты и пароля.</p></article>
    <article class="feature"><span class="feature__number">02</span><h2>Авторизация</h2><p>Вход по электронной почте и паролю, сохранённому в базе в виде хеша.</p></article>
    <article class="feature"><span class="feature__number">03</span><h2>Личный кабинет</h2><p>Закрытая страница, доступная только после успешного входа.</p></article>
</section>
