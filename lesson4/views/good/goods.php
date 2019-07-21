<?php
/**
 * @var array $goods
 * @var \App\models\Good $good
 */
?>
<div class="container">
    <div class="goods">
        <h1 class="goods__title">Товары</h1>
        <div class="goods__box">
            <? foreach ($goods as $good) : ?>
                <div class="good">
                    <div class="good__name"><?= $good->name ?></div>
                    <div class="good__price"><?= $good->price ?></div>
                    <div class="good__info"><?= $good->info ?></div>
                    <div class="good__action">
                        <a href="?c=good&a=good&id=<?= $good->id ?>" class="good__link btn btn-dark">Подробнее</a>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>