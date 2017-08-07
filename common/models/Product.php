<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
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
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'manufacturer_id', 'price', 'code', 'amount'], 'required'],
            [['category_id', 'manufacturer_id', 'price', 'code', 'is_new', 'is_recommended', 'is_popular', 'visibility', 'amount'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
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
            'category_id' => 'Категория',
            'manufacturer_id' => 'Производитель',
            'description' => 'Описание',
            'price' => 'Цена',
            'code' => 'Код',
            'is_new' => 'Новинка',
            'is_recommended' => 'Рекомендованный',
            'is_popular' => 'Популярный',
            'visibility' => 'Видимость',
            'amount' => 'Количество',
        ];
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
        return $this->hasMany(Characteristic::className(), ['id' => 'characteristic_id'])->viaTable('{{%product_characteristic}}', ['product_id' => 'id']);
    }
}
