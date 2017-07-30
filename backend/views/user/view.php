<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данного пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'label' => 'Имя',
                'value' => $model->userProfile->name
            ],
            [
                'label' => 'Фамилия',
                'value' => $model->userProfile->surname
            ],
            [
                'label' => 'Телефон',
                'value' => $model->userProfile->phone
            ],
            [
                'label' => 'Город',
                'value' => $model->userProfile->address->city->name
            ],
            [
                'label' => 'Адрес',
                'value' => $model->userProfile->address->address
            ],
            [
                'label' => 'Почтовый индекс',
                'value' => $model->userProfile->address->postcode
            ],
            'createdAtText',
            'updatedAtText',
        ],
    ]) ?>

</div>
