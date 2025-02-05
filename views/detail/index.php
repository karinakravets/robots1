<?php

use app\models\Detail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DetailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Детали';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить деталь', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'icon',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img("@web/{$model->icon}", ['style' => "width: 100px; height: 75px;"]);
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => 'category.name'
            ],
            'description',
            'comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Detail $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
