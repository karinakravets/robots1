<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProjectDetail $model */

$this->title = 'Изменить деталь "' . $detail->name . '" в проекте: ' . $project->name;
$this->params['breadcrumbs'][] = ['label' => 'Project Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
