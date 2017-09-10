<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%manufacturer}}".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 *
 * @property Country $country
 * @property Product[] $products
 */
class Manufacturer extends \common\models\Manufacturer
{
    /**
     * @inheritdoc
     * @return \backend\scopes\ManufacturerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\ManufacturerQuery(get_called_class());
    }
}
