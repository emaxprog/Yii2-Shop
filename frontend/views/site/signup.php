<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните следующие поля для регистрации:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'surname')->textInput() ?>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-9999',
            ]) ?>

            <?= $form->field($model, 'country_id')->dropDownList($countries, ['id' => 'country-id','prompt'=>'Выбрать...']); ?>

            <?= $form->field($model, 'region_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'region-id'],
                'pluginOptions' => [
                    'depends' => ['country-id'],
                    'loading' => false,
                    'placeholder' => 'Выбрать...',
                    'url' => Url::to(['/site/regions'])
                ]
            ]); ?>

            <?= $form->field($model, 'city_id')->widget(DepDrop::classname(), [
                'pluginOptions' => [
                    'depends' => ['country-id', 'region-id'],
                    'loading' => false,
                    'placeholder' => 'Выбрать...',
                    'url' => Url::to(['/site/cities'])
                ]
            ]); ?>

            <?= $form->field($model, 'address')->textInput([
                'placeholder' => 'Улица, дом, кв.'
            ]) ?>

            <?= $form->field($model, 'postcode')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
