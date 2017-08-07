<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$totalSum = 0;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Пользователь</th>
            <td colspan="3"><?= $model->user->username ?></td>
        </tr>
        <tr>
            <th>Доставка</th>
            <td colspan="3"><?= $model->delivery->name ?></td>
        </tr>
        <tr>
            <th>Способ оплаты</th>
            <td colspan="3"><?= $model->payment->name ?></td>
        </tr>
        <tr>
            <th>Статус</th>
            <td colspan="3"><?= $model->status->name ?></td>
        </tr>
        <tr>
            <th>Комментарий</th>
            <td colspan="3"><?= $model->comment ?></td>
        </tr>
        <tr>
            <th>Дата заказа</th>
            <td colspan="3"><?= $model->created_at ?></td>
        </tr>
        <tr>
            <th>Название товара</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Общая сумма</th>
        </tr>
        <?php foreach ($model->products as $product): ?>
            <tr>
                <td><?= $product->name ?></td>
                <td><?= $model->getOrderProducts(['product_id' => $product->id])->one()->amount ?></td>
                <td><?= $product->price ?> руб.</td>
                <td><?= $product->price * $model->getOrderProducts(['product_id' => $product->id])->one()->amount ?>
                    руб.
                </td>
            </tr>
            <?php $totalSum += $product->price * $model->getOrderProducts(['product_id' => $product->id])->one()->amount ?>
        <?php endforeach; ?>
        <tr>
            <th>Итого:</th>
            <th colspan="3"><?= $totalSum ?> руб.</th>
        </tr>
        </tbody>
    </table>

</div>
