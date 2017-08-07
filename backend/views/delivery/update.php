<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Delivery */

$this->title = 'Редактировать тип доставки: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тип доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
