<section class="account container">
    <p class="eyebrow">NORTHSTAR ID · PRIVATE AREA</p>
    <div class="account__card">
        <div class="account__mark">✦</div>
        <div>
            <p class="eyebrow">ВХОД ВЫПОЛНЕН</p>
            <h1>Привет, <?= e($user['name']) ?>!</h1>
            <p class="account__text">Ты находишься в личном кабинете. Эта страница доступна только авторизованным пользователям.</p>
        </div>
        <div class="account__info"><span>ЭЛЕКТРОННАЯ ПОЧТА</span><strong><?= e($user['email']) ?></strong></div>
        <div class="account__info"><span>ID ПОЛЬЗОВАТЕЛЯ</span><strong><?= (int) $user['id'] ?></strong></div>
        <form action="/logout" method="post">
            <?= csrf_field() ?>
            <button class="button button--secondary" type="submit">Выйти из аккаунта</button>
        </form>
    </div>
</section>
