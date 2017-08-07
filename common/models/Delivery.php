<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%delivery}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 *
 * @property Order[] $orders
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_id' => 'id']);
    }
}
