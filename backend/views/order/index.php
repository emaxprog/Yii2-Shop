<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => 'Фильтр',
                'content' => $this->render('_search',
                    ['model' => $searchModel, 'users' => $users, 'statuses' => $statuses]),
            ],
        ]
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'delivery_id',
                'value' => function ($model) {
                    return $model->delivery->name;
                }
            ],
            [
                'attribute' => 'payment_id',
                'value' => function ($model) {
                    return $model->payment->name;
                }
            ],
            [
                'attribute' => 'status_id',
                'value' => function ($model) {
                    return $model->status->name;
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return $model->createdAtText;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
