<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 */
class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['username', 'email', 'name', 'surname'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 32],
            [['surname'], 'string', 'max' => 64],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'phone' => 'Телефон',
            'created_at' => 'Зарегистрирован',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\UserQuery(get_called_class());
    }
}
