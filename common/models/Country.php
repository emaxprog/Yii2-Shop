<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Region[] $regions
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    public static function getCountriesList()
    {
        return ArrayHelper::map(self::find()->select(['id', 'name'])->all(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['country_id' => 'id']);
    }
}
