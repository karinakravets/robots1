<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetailPhoto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detail-photo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'detail_id')->hiddenInput(['value' => $id])->label(false) ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
