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
                <?= Html::a('Подробнее', Url::to(['site/catalog']), ['class' => 'btn btn-default']) ?>
            </div>
            <div class="col-lg-6">
                <h2>PHP Part</h2>

                <p>Задание можно прочитать в README.md</p>

                <?= Html::a('Подробнее', Url::to(['news/index']), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
