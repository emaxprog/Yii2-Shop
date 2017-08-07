<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 *
 * @property Order[] $orders
 */
class Delivery extends \common\models\Delivery
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\DeliveryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\DeliveryQuery(get_called_class());
    }
}
