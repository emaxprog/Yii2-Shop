<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends \common\models\OrderProduct
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
