<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $address
 * @property integer $postcode
 * @property integer $city_id
 *
 * @property City $city
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
