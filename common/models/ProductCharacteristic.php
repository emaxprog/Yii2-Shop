<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_characteristic}}".
 *
 * @property integer $product_id
 * @property integer $characteristic_id
 * @property string $value
 *
 * @property Characteristic $characteristic
 * @property Product $product
 */
class ProductCharacteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_characteristic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'characteristic_id', 'value'], 'required'],
            [['product_id', 'characteristic_id'], 'integer'],
            [['value'], 'string', 'max' => 64],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::className(), 'targetAttribute' => ['characteristic_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::className(), ['id' => 'characteristic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
