<?php

use app\models\Option;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Platform;
use app\models\User;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'platform_id')->dropdownList(ArrayHelper::map(Platform::find()->all(), 'id', 'name'), ['value' => Option::get()->platform_id]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->fileInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropdownList(ArrayHelper::map(User::find()->where(['is_admin' => false])->all(), 'id', 'username'), ['prompt' => 'Выберите консультанта']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
