<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="body-content">
        <div class="row">
            <? foreach ($dataProvider->models as $model): ?>
                <div class="col-lg-5">
                    <h2><?= $model->name; ?></h2>
                    <p><?= $model->preview_text ?></p>
                    <?= Html::a('Подробнее', Url::to(['news/detail', 'id' => $model->id]), ['class' => 'btn btn-default']) ?>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>