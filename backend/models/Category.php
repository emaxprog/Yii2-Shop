<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $sort
 * @property integer $visibility
 *
 * @property Product[] $products
 */
class Category extends \common\models\Category
{
    public function getParentCategory()
    {
        $parentCategory = self::findOne($this->parent_id);
        return $parentCategory ? $parentCategory->name : 'Главная категория';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\CategoryQuery(get_called_class());
    }
}
