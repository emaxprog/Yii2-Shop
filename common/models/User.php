<?php

namespace common\models;

use mdm\admin\models\User as UserModel;
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
    public $new_password;

    public $new_password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            ['new_password', 'compare'],
            [['new_password', 'new_password_repeat'], 'string', 'min' => 6],
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
            'email' => 'E-mail',
            'new_password' => 'Новый пароль',
            'new_password_repeat' => 'Подтвердите пароль',
            'created_at' => 'Зарегистрирован',
            'updated_at' => 'Обновлен',
            'createdAtText' => 'Зарегистрирован',
            'updatedAtText' => 'Обновлен',
        ];
    }

    public function getCreatedAtText()
    {
        return \Yii::$app->formatter->asDatetime($this->created_at);
    }

    public function getUpdatedAtText()
    {
        return \Yii::$app->formatter->asDatetime($this->updated_at);
    }

    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id'])->inverseOf('user');
    }
}
