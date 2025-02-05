<?php

use app\models\Category;
use app\models\Platform;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Option $model */

$this->title = "Опции";
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="option-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'platform_id',
                'value' => function($model) {
                    return Platform::findOne($model->platform_id)->name;
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) {
                    return Category::findOne($model->category_id)->name;
                }
            ],
        ],
    ]) ?>

</div>
