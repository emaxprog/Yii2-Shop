<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $countries \common\models\Country */

$this->title = 'Произодители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => 'Фильтр',
                'content' => $this->render('_search', ['model' => $searchModel, 'countries' => $countries]),
            ],
        ]
    ]); ?>

    <p>
        <?= Html::a('Создать производителя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'country_id',
                'value' => function ($model) {
                    return $model->country->name;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
