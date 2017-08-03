<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */
/* @var $countries \common\models\Country */

$this->title = 'Создать производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
    ]) ?>

</div>
