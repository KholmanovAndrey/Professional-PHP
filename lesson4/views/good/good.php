<?php
/**
 * @var \App\models\Good $good
 */
?>
<div class="container">
    <div class="good-single">
        <h1 class="good-single__title"><?= $good->name ?></h1>
        <p class="good-single__p">Цена: <?= $good->price ?></p>
        <p class="good-single__p"><?= $good->info ?></p>
    </div>
</div>
