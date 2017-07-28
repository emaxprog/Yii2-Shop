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
    public $new_password;

    public $new_password_repeat;

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
            ['new_password', 'compare'],
            [['new_password', 'new_password_repeat'], 'string', 'min' => 6],
        ]);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'password_hash',
                    ActiveRecord::EVENT_BEFORE_INSERT => 'password_hash'
                ],
                'value' => function () {
                    if ($this->new_password) {
                        return Yii::$app->security->generatePasswordHash($this->new_password);
                    }
                    return $this->password_hash;
                }
            ]
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
            'new_password' => 'Новый пароль',
            'new_password_repeat' => 'Подтвердите пароль',
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
