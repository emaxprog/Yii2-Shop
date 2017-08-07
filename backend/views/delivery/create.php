<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Delivery */

$this->title = 'Создать тип доставки';
$this->params['breadcrumbs'][] = ['label' => 'Типы доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
