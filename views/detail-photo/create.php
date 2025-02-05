<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetailPhoto $model */

$this->title = 'Добавить фото';
$this->params['breadcrumbs'][] = ['label' => 'Detail Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
