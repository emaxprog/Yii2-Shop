<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */
/* @var $countries \common\models\Country */
/* @var $model backend\models\Manufacturer */

$this->title = 'Редактировать производителя: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="manufacturer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries
    ]) ?>

</div>
