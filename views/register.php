<section class="auth container">
    <div class="auth__intro">
        <p class="eyebrow">NORTHSTAR ID · NEW MEMBER</p>
        <h1>Создать<br><span>аккаунт</span></h1>
        <p>Заполни поля, чтобы зарегистрироваться. Все данные будут проверены ещё раз на сервере.</p>
        <div class="auth__note"><span>✦</span> Пароль не сохраняется в открытом виде.</div>
    </div>
    <div class="auth-card">
        <div class="auth-card__heading"><span class="eyebrow">РЕГИСТРАЦИЯ</span><span class="auth-card__step">01 / 02</span></div>
        <h2>Новый профиль</h2>
        <?php if ($errors !== []): ?>
            <div class="alert" role="alert">Проверь поля с ошибками и попробуй ещё раз.</div>
        <?php endif; ?>
        <form action="/register" method="post" data-validate="register" novalidate>
            <?= csrf_field() ?>
            <div class="field">
                <label for="name">Имя</label>
                <input id="name" name="name" type="text" class="<?= e(inputClass($errors, 'name')) ?>" autocomplete="name" maxlength="100" required value="<?= e($old['name'] ?? '') ?>" <?= ariaError($errors, 'name') ?> data-field="name" placeholder="Например, Алекс">
                <p class="field__error" id="name-error" data-error-for="name"><?= fieldError($errors, 'name') ?></p>
            </div>
            <div class="field">
                <label for="email">Электронная почта</label>
                <input id="email" name="email" type="email" class="<?= e(inputClass($errors, 'email')) ?>" autocomplete="email" maxlength="190" required value="<?= e($old['email'] ?? '') ?>" <?= ariaError($errors, 'email') ?> data-field="email" placeholder="name@example.com">
                <p class="field__error" id="email-error" data-error-for="email"><?= fieldError($errors, 'email') ?></p>
            </div>
            <div class="field">
                <label for="password">Пароль <span>не менее 8 символов</span></label>
                <input id="password" name="password" type="password" class="<?= e(inputClass($errors, 'password')) ?>" autocomplete="new-password" minlength="8" required <?= ariaError($errors, 'password') ?> data-field="password" placeholder="Создай пароль">
                <p class="field__error" id="password-error" data-error-for="password"><?= fieldError($errors, 'password') ?></p>
            </div>
            <div class="field">
                <label for="password_confirmation">Повтори пароль</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="<?= e(inputClass($errors, 'password_confirmation')) ?>" autocomplete="new-password" required <?= ariaError($errors, 'password_confirmation') ?> data-field="password_confirmation" placeholder="Повтори пароль">
                <p class="field__error" id="password_confirmation-error" data-error-for="password_confirmation"><?= fieldError($errors, 'password_confirmation') ?></p>
            </div>
            <button class="button button--primary button--wide" type="submit">Создать аккаунт <span>→</span></button>
        </form>
        <p class="auth-card__bottom">Уже есть аккаунт? <a href="/login">Войти</a></p>
    </div>
</section>
