<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProjectDetail $model */

$this->title = 'Добавить' . (boolval($missing) ? ' недостающую' : '') . ' деталь в проект "' . $project->name . '"';
$this->params['breadcrumbs'][] = ['label' => 'Project Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-detail-create">

    <h1 ><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'project' => $project,
        'missing' => $missing,
    ]) ?>

</div>
