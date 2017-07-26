<?php

namespace frontend\models;

use common\models\Address;
use common\models\Phone;
use common\models\User;
use mdm\admin\models\form\Signup as Signup;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends Signup
{
    public $name;
    public $surname;
    public $phone;
    public $address;
    public $postcode;
    public $country_id;
    public $region_id;
    public $city_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'name', 'surname', 'phone', 'address', 'postcode', 'city_id'], 'required'],
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'Это имя пользователя уже занято.'],
            [['username', 'address'], 'string', 'min' => 2, 'max' => 255],
            ['name', 'string', 'min' => 2, 'max' => 32],
            ['surname', 'string', 'min' => 2, 'max' => 64],
            ['phone', 'string'],
            [['postcode', 'city_id'], 'integer'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'Этот E-mail адрес уже занят.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['country', 'region'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'phone' => 'Телефон',
            'country_id' => 'Страна',
            'region_id' => 'Регион',
            'city_id' => 'Город',
            'address' => 'Адрес',
            'postcode' => 'Почтовый индекс',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->name = $this->name;
                $user->surname = $this->surname;
                $user->phone = $this->phone;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                if ($user->save()) {
                    $address = new Address();
                    $address->user_id = $user->id;
                    $address->address = $this->address;
                    $address->postcode = $this->postcode;
                    $address->city_id = $this->city_id;
                    $address->save();

                    $transaction->commit();
                    return $user;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
        return null;
    }
}
