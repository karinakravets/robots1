<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DetailPhoto $model */

$this->title = "Фотография к детали: " . $model->detail->name;
$this->params['breadcrumbs'][] = ['label' => 'Detail Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detail-photo-view">

    <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::img("@web/{$model->photo}", ['class' => 'm-auto d-flex justify-content-center w-100', 'style' => 'max-width: 480px;']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'mt-2 m-auto d-flex justify-content-center w-25 btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить фото?',
                'method' => 'post',
            ],
        ]) ?>
    

</div>
