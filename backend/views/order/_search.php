<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => $users,
        'options' => ['placeholder' => 'Выбрать ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' => $statuses,
        'options' => ['placeholder' => 'Выбрать ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

<!--    --><?//= $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
//        'options' => ['placeholder' => 'Выбрать дату заказа ...'],
//        'convertFormat' => true,
//        'pluginOptions' => [
//            'todayHighlight' => true,
//            'todayBtn' => true,
//            'format' => 'dd.MM.y h:i:s',
//            'autoclose' => true
//        ]
//    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
