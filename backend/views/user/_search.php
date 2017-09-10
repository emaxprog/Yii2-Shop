<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'created_at', [
        'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-calendar"></i>']],
        'options' => ['class' => 'drp-container form-group']
    ])->widget(DateRangePicker::classname(), [
        'useWithAddon' => true,
        'language' => 'ru',
        'convertFormat' => true,
        'hideInput' => false,
        'presetDropdown' => false,
        'pluginOptions' => [
            'locale' => ['format' => 'd.m.Y'],
            'separator' => '-',
            'opens' => 'left'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
