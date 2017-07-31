<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Регистрация', 'h1');
        $I->see('Пожалуйста заполните следующие поля для регистрации:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Необходимо заполнить «Логин».');
        $I->seeValidationError('Необходимо заполнить «E-mail».');
        $I->seeValidationError('Необходимо заполнить «Пароль».');
        $I->seeValidationError('Необходимо заполнить «Подтвердите пароль».');
        $I->seeValidationError('Необходимо заполнить «Имя».');
        $I->seeValidationError('Необходимо заполнить «Фамилия».');
        $I->seeValidationError('Необходимо заполнить «Телефон».');
        $I->seeValidationError('Необходимо заполнить «Адрес».');
        $I->seeValidationError('Необходимо заполнить «Почтовый индекс».');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[password]'  => 'tester_password',
        ]
        );
        $I->dontSee('Необходимо заполнить «Логин».', '.help-block');
        $I->dontSee('Необходимо заполнить «Пароль».', '.help-block');
        $I->see('Значение «E-mail» не является правильным email адресом.', '.help-block');
    }

//    public function signupSuccessfully(FunctionalTester $I)
//    {
//        $I->submitForm($this->formId, [
//            'SignupForm[username]' => 'tester',
//            'SignupForm[email]' => 'tester.email@example.com',
//            'SignupForm[password]' => 'tester_password',
//            'SignupForm[password_repeat]' => 'tester_password_repeat',
//            'SignupForm[name]' => 'tester_name',
//            'SignupForm[surname]' => 'tester_surname',
//            'SignupForm[phone]' => '+7 (925) 123-3213',
//            'SignupForm[country_id]' => 'tester_password',
//            'SignupForm[region_id]' => 'tester_password',
//            'SignupForm[city_id]' => 1,
//            'SignupForm[address]' => 'tester_address',
//            'SignupForm[postcode]' => 'tester_postcode',
//        ]);
//
//        $I->seeRecord('common\models\User', [
//            'username' => 'tester',
//            'email' => 'tester.email@example.com',
//        ]);
//
//        $I->see('Logout (tester)', 'form button[type=submit]');
//    }
}
