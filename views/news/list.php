<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?foreach ($dataProvider->models as $model):?>
        <div>
            <h2><?=$model->name;?></h2>
            <?=$model->preview_text?>
            <?= Html::a('Подробнее', Url::to(['news/detail', 'id' => $model->id])) ?>
        </div>
    <?endforeach?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'preview_text:raw',
            'detail_text:raw',
            'img',

        ],
    ]); ?>
</div>
