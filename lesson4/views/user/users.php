<?php
/**
 * @var array $users
 * @var \App\models\User $user
 */
?>
<div class="container">
    <div class="users">
        <a href="?a=save" class="users__link btn btn-dark">Создать пользователя</a>
        <div class="user">
            <div class="user__id">ID</div>
            <div class="user__login">Логин</div>
            <div class="user__name">Имя</div>
            <div class="user__action"></div>
        </div>
        <?php foreach ($users as $user) : ?>
            <div class="user">
                <div class="user__id"><?= $user->id ?></div>
                <div class="user__login"><?= $user->login ?></div>
                <div class="user__name"><?= $user->name ?></div>
                <div class="user__action">
                    <a href="?a=user&id=<?= $user->id ?>" class="user__link btn btn-dark">Просмотр</a>
                    <a href="?a=save&id=<?= $user->id ?>" class="user__link btn btn-dark">Редактировать</a>
                    <a href="?a=delete&id=<?= $user->id ?>" class="user__link btn btn-dark">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>