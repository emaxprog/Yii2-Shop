<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%characteristic}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 *
 * @property ProductCharacteristic[] $productCharacteristics
 * @property Product[] $products
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%characteristic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'unit'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['unit'], 'string', 'max' => 16],
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
            'unit' => 'Единица измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCharacteristics()
    {
        return $this->hasMany(ProductCharacteristic::className(), ['characteristic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_characteristic}}', ['characteristic_id' => 'id']);
    }
}
