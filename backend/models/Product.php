<?php

namespace backend\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $manufacturer_id
 * @property string $description
 * @property integer $price
 * @property integer $code
 * @property integer $is_new
 * @property integer $is_recommended
 * @property integer $is_popular
 * @property integer $visibility
 * @property integer $amount
 *
 * @property Category $category
 * @property Manufacturer $manufacturer
 * @property ProductCharacteristic[] $productCharacteristics
 * @property Characteristic[] $characteristics
 */
class Product extends \common\models\Product
{
    public function getPriceText()
    {
        return $this->price . ' руб.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCharacteristics()
    {
        return $this->hasMany(ProductCharacteristic::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasMany(Characteristic::className(),
            ['id' => 'characteristic_id'])->viaTable('product_characteristic', ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\ProductQuery(get_called_class());
    }
}
