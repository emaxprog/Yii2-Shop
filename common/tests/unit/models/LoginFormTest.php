<?php

namespace common\tests\unit\models;

use Yii;
use common\models\LoginForm;
use common\fixtures\UserFixture as UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        expect('Модель не должна аутентифицировать пользователя', $model->login())->false();
        expect('Пользователь не должен быть аутентифицирован', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        expect('Модель не должна аутентифицировать пользователя', $model->login())->false();
        expect('Должны быть сообщания об ошибках', $model->errors)->hasKey('password');
        expect('Пользователь не должен быть аутентифицирован', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);

        expect('Модель должна аутентифицировать пользователя', $model->login())->true();
        expect('Не должны быть сообщания об ошибках', $model->errors)->hasntKey('password');
        expect('Пользователь должен быть аутентифицирован', Yii::$app->user->isGuest)->false();
    }
}
