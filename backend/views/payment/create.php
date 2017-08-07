<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Payment */

$this->title = 'Создать способ оплаты';
$this->params['breadcrumbs'][] = ['label' => 'Способы оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
