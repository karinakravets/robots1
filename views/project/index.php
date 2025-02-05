<?php

use app\models\Project;
use app\models\User;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modelsProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="project-index">
    
    <h1 ><?= Html::encode($this->title) ?></h1>
    
    <?php if (User::isAdmin()) { ?>
        <p>
            <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php } ?>
        
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pager'=> ['class'=>LinkPager::class],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name', 
                [
                    'attribute' => 'platform_id',
                    'value' => 'platform.name'
                ],
                [
                    'attribute' => 'icon',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::img("@web/{$model->icon}", ['style' => "width: 100px; height: 75px;"]);
                    }
                ],
                'date_created',
                [
                    'attribute' => 'date_close',
                    'value' => function($model) {
                        return $model->date_close ?? 'В работе';
                    },
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function($model) {
                        return $model->user->username ?? '';
                    }
                ],
                'comment',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'template' => User::isAdmin() ? '{view}{update}{delete}{close}' : '{view}',
                    'buttons' => [
                        'close' => function ($url, $model) {
                            return !$model->date_close ? Html::a('Закрыть', $url, ['class' => 'btn btn-danger']) : null;
                        },
                    ]
                ],
            ],
        ]); ?>

</div>
