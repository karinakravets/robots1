<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1 ><?= Html::encode($this->title) ?></h1>
    <?php if (User::isAdmin()) { ?>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить проект?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Закрыть', Url::to(['/project/close', 'id' => $model->id]), ['class' => 'btn btn-danger']) ?>
    </p>
    <?php } ?>
    <h2 >Основная информация</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'platform_id',
                'value' => function($model) {
                    return $model->platform->name;
                }
            ],
            'name',
            [
                'attribute' => 'icon',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img("@web/{$model->icon}", ['style' => "width: 100px; height: 75px;"]);
                }
            ],
            'comment',
            'date_created',
            [
                'attribute' => 'date_close',
                'value' => function($model) {
                    return $model->date_close ?? 'В работе';
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->user->username ?? '';
                }
            ],
        ],
    ]) ?>

    <h2 >Детали</h2>
    <? if (User::isConsultant($model)) { ?>
    <p>
        <?= Html::a('Добавить', Url::to(['project-detail/create', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
    </p>
    <? } ?>
    <?= GridView::widget([
        'dataProvider' => $detailDataProvider,
        'filterModel' => $searchDetail,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'detail_id',
                'value' => 'detail.name'
            ],
            'count',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view}{delete}'
            ],
        ],
    ]); ?>

    <h2 >Недостающие детали</h2>
        <? if (User::isConsultant($model)) { ?>
        <p>
            <?= Html::a('Добавить', Url::to(['project-detail/create', 'id' => $model->id, 'missing' => true]), ['class' => 'btn btn-primary']) ?>
        </p>
        <? } ?>
        <?= GridView::widget([
            'dataProvider' => $missingDetailDataProvider,
            'filterModel' => $searchDetail,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'detail_id',
                    'value' => 'detail.name'
                ],
                [
                    'attribute' => 'count',
                    'value' => function($model) {
                        return -$model->count;
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'template' => '{view}{delete}'
                ],
            ],
        ]); ?>

</div>
