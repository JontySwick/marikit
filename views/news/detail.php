<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?if($model->img):?>
        <?= Html::img($model->img)?>
    <?endif?>
    <?=$model->detail_text?>
</div>
