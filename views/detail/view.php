<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Detail $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('+', Url::to(['detail-photo/create', 'id' => $model->id]), ['class' => 'mx-2 btn btn-primary']); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            'description',
            'comment',
            [
                'attribute' => 'photos',
                'format' => 'html',
                'label' => 'Дополнительные фото',
                'value' => function ($model) {
                    $photos = $model->detailPhotos;
                    $html = '';
                    if (count($photos) == 0) {
                        return $html;
                    }
                    foreach ($photos as $photo) {
                        $html .= Html::a(Html::img("@web/{$photo->photo}", ['style' => "width: 100px; height: 75px;"]), Url::to(['detail-photo/view', 'id' => $photo->id]));
                    }
                    return $html;
                }
            ]
        ],
    ]) ?>

</div>
