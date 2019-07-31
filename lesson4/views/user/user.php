<?php
/**
 * @var \App\models\User $user
 */
?>
<div class="container">
    <div class="user-single">
        <h1 class="user-single__title"><?= $user->name ?></h1>
        <p class="user-single__p">Логин: <?= $user->login ?></p>
        <p class="user-single__p">Пароль: <?= $user->password ?></p>
        <div class="user-single__action">
            <a href="?a=save&id=<?= $user->id ?>" class="user-single__link btn btn-dark">Редактировать данные</a>
        </div>
    </div>
</div>
