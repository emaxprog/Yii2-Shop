<?php

namespace frontend\models;

use common\models\Address;
use common\models\Phone;
use common\models\User;
use common\models\UserProfile;
use mdm\admin\models\form\Signup as Signup;
use yii\db\Exception;
use yii\web\BadRequestHttpException;

/**
 * Signup form
 */
class SignupForm extends Signup
{
    public $password_repeat;
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
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'Этот логин уже занят.'],
            [['username', 'address'], 'string', 'min' => 2, 'max' => 255],
            ['name', 'string', 'min' => 2, 'max' => 32],
            ['surname', 'string', 'min' => 2, 'max' => 64],
            ['phone', 'string'],
            [['postcode', 'city_id'], 'integer'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'Этот E-mail адрес уже занят.'],

            [['password', 'password_repeat'], 'required'],
            ['password', 'compare'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
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
            'password_repeat' => 'Подтвердите пароль',
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
                $userProfile = new UserProfile();
                $address = new Address();

                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->generateAuthKey();

                $userProfile->name = $this->name;
                $userProfile->surname = $this->surname;
                $userProfile->phone = $this->phone;

                $address->address = $this->address;
                $address->postcode = $this->postcode;
                $address->city_id = $this->city_id;

                $isValid = $user->validate() && $userProfile->validate() && $address->validate();

                if ($isValid) {
                    $user->save(false);
                    $user->link('userProfile', $userProfile);
                    $userProfile->link('address', $address);
                    $transaction->commit();

                    return $user;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                throw new BadRequestHttpException();
            }
        }
        return null;
    }
}
