<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\helpers\Url; ?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>JS Part</h2>

                <p>Задание можно прочитать в README.md</p>

                <p>Не знаю по какой причине, но "npm run dev" запускает мне сервер с "Cannot GET /" ошибкой.<br>
                    Наверное это как-то связано с Yii, потому что этот же проект лежащий рядом работает корректно
                </p>

                <?= Html::a('Подробнее', Url::to(['site/catalog']), ['class' => 'btn btn-default']) ?>
            </div>
            <div class="col-lg-6">
                <h2>PHP Part</h2>

                <p>Задание можно прочитать в README.md</p>

                <p>Сначала начал писать парсер на регулярках, и почти это сделал, если не считать небольших багов.<br>
                    Но потом все бросил и написал на phpQuery. Но мои потуги на регулярках остались. лежит все в /components
                </p>

                <?= Html::a('Подробнее', Url::to(['news/index']), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
