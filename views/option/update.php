<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Option $model */

$this->title = 'Изменить опции';
?>
<div class="option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
