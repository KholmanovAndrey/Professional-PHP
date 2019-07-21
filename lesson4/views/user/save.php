<?php
/**
 * @var \App\models\User $user
 */
?>
<div class="container">
    <form action="?a=save" method="post" class="form">
        <?php if (!empty($user)) : ?>
            <input type="hidden" name="id" class="form__input" value="<?= $user->id ?>">
        <?php endif ?>
        <input type="text" name="login" placeholder="Введите логин" value="<?= $user->login ?>" class="form__input">
        <input type="text" name="name" placeholder="Введите имя" value="<?= $user->name ?>" class="form__input">
        <input type="password" name="password" placeholder="Введите пароль" value="<?= $user->password ?>" class="form__input">
        <button type="submit" class="form__button btn btn-dark">Сохранить</button>
    </form>
</div>