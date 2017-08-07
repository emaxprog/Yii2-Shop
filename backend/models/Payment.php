<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Order[] $orders
 */
class Payment extends \common\models\Payment
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\PaymentQuery(get_called_class());
    }
}
