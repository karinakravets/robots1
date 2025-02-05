<?php

use app\models\Detail;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\ProjectDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project->id])->label(false) ?>

    <?= $form->field($model, 'detail_id')->dropDownList(ArrayHelper::map(Detail::find()->all(), 'id', 'name'), ['prompt' => 'Выберите деталь']) ?>

    <?= $form->field($model, 'count')->textInput(['type' => 'number', 'min' => 0]) ?>
    <?= $form->field($model, 'missing')->checkbox(['checked' => boolval($missing), 'class' => 'd-none'])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
