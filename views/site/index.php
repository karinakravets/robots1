<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/** @var yii\web\View $this */

$this->title = 'Главная страница';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Вас приветствует менеджер управления проектами!</h1>

        <p class="lead">Окунемся в мир роботов вместе</p>

        <p><a class="btn btn-lg btn-primary" href="http://pr-kravetc.xn--80ahdri7a.site/site/login">Личный кабинет</a></p>
    </div>

    <style>
    .fixed-size-img {
        width: 100%;
        height: 360px;
        object-fit: cover;
    }

    .card {
        border: 2px solid #77dde7;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <?= Html::img('@web/image/7.jpg', ['class' => 'card-img-top', 'alt' => 'Arduino']) ?>
                <div class="card-body">
                    <h5 class="card-title">Arduino</h5>
                    <p class="card-text">Дешево/сердито</p>
                </div>
                <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('Личный кабинет', ['site/login'], ['class' => 'btn btn-primary mt-3']) ?>
        <?php else: ?>
            <?= Html::a('Личный кабинет', ['projects/index', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-primary mt-3']) ?>
        <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <?= Html::img('@web/image/7.png', ['class' => 'card-img-top', 'alt' => 'Raspberry Pi']) ?>
                <div class="card-body">
                    <h5 class="card-title">Raspberry Pi</h5>
                    <p class="card-text">Больше/возможностей</p>
                </div>
                <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('Личный кабинет', ['site/login'], ['class' => 'btn btn-primary mt-3']) ?>
        <?php else: ?>
            <?= Html::a('Личный кабинет', ['projects/index', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-primary mt-3']) ?>
        <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
