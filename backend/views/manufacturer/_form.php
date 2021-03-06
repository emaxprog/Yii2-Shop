<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */
/* @var $countries common\models\Country */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
        'data' => $countries,
        'options' => ['id' => 'country-id', 'placeholder' => 'Выбрать...'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
