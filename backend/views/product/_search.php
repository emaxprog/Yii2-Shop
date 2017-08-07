<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $categories backend\models\Category */
/* @var $manufacturers backend\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => $categories,
        'options' => ['placeholder' => 'Выбрать ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'manufacturer_id')->widget(Select2::classname(), [
        'data' => $manufacturers,
        'options' => ['placeholder' => 'Выбрать ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'priceFrom')->textInput() ?>

    <?= $form->field($model, 'priceTo')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'is_new')->checkbox() ?>

    <?= $form->field($model, 'is_recommended')->checkbox() ?>

    <?= $form->field($model, 'is_popular')->checkbox() ?>

    <?= $form->field($model, 'visibility')->checkbox(['checked ' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
