<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $alias
 * @property integer $sort
 * @property integer $visibility
 *
 * @property Product[] $products
 */
class Category extends \common\models\Category
{

    public function getVisibilityText()
    {
        return $this->visibility ? 'Да' : 'Нет';
    }

    public function getParentNameText()
    {
        if (intval($this->parent_id) === 0) {
            return 'Главная категория';
        }

        if ($parent = self::findOne($this->parent_id)) {
            return $parent->name;
        }

        throw new BadRequestHttpException('Невозможно определить родительскую категорию у категории #' . $this->id);
    }

    public static function getParentsList()
    {
        return ArrayHelper::merge(
            [0 => 'Главная категория'],
            ArrayHelper::map(self::find()->select(['id', 'name'])->all(), 'id', 'name')
        );
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
