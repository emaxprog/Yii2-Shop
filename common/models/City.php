<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 *
 * @property Region $region
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}
