<section class="auth auth--login container">
    <div class="auth__intro">
        <p class="eyebrow">NORTHSTAR ID · WELCOME BACK</p>
        <h1>С возвращением<span>.</span></h1>
        <p>Войди в аккаунт, чтобы открыть личный кабинет.</p>
        <div class="auth__note"><span>✦</span> Защищённая авторизация через PHP и MySQL.</div>
    </div>
    <div class="auth-card">
        <div class="auth-card__heading"><span class="eyebrow">АВТОРИЗАЦИЯ</span><span class="auth-card__step">02 / 02</span></div>
        <h2>Войти в систему</h2>
        <?php if ($error !== ''): ?>
            <div class="alert" role="alert"><?= e($error) ?></div>
        <?php endif; ?>
        <form action="/login" method="post" data-validate="login" novalidate>
            <?= csrf_field() ?>
            <div class="field">
                <label for="email">Электронная почта</label>
                <input id="email" name="email" type="email" class="input" autocomplete="username" maxlength="190" required value="<?= e($email) ?>" data-field="email" placeholder="name@example.com">
                <p class="field__error" id="email-error" data-error-for="email"></p>
            </div>
            <div class="field">
                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" class="input" autocomplete="current-password" required data-field="password" placeholder="Введи пароль">
                <p class="field__error" id="password-error" data-error-for="password"></p>
            </div>
            <button class="button button--primary button--wide" type="submit">Войти <span>→</span></button>
        </form>
        <p class="auth-card__bottom">Ещё нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
    </div>
</section>
