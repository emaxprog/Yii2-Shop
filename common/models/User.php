<?php

namespace common\models;

use mdm\admin\models\User as UserModel;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property Address $address
 */
class User extends UserModel
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'created_at',
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'created_at',
                ],
                'value' => function ($event) {
                    if ($event->name == ActiveRecord::EVENT_AFTER_FIND) {
                        return \Yii::$app->formatter->asDatetime($this->created_at, 'php:d.m.Y H:i:s');
                    }

                    return $this->created_at;
                }
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'updated_at',
                    ActiveRecord::EVENT_BEFORE_INSERT => 'updated_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function ($event) {
                    if ($event->name == ActiveRecord::EVENT_AFTER_FIND) {
                        return \Yii::$app->formatter->asDatetime($this->updated_at, 'php:d.m.Y H:i:s');
                    }

                    return $this->updated_at;
                }
            ]
        ]);
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['user_id' => 'id'])->inverseOf('user');
    }
}
