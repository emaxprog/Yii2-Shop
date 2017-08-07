<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $categories backend\models\Category */
/* @var $manufacturers backend\models\Manufacturer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => 'Фильтр',
                'content' => $this->render('_search', ['model' => $searchModel, 'categories' => $categories, 'manufacturers' => $manufacturers]),
            ],
        ]
    ]); ?>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'manufacturer_id',
                'value' => function ($model) {
                    return $model->manufacturer->name;
                }
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return $model->priceText;
                }
            ],
            'code',
            [
                'attribute' => 'visibility',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->visibility ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>';
                },
                'filter' => ['1' => 'Видимый', '0' => 'Скрытый']
            ],
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
