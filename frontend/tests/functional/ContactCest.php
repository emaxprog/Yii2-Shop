<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }

    public function checkContact(FunctionalTester $I)
    {
        $I->see('Контакты', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Контакты', 'h1');
        $I->seeValidationError('Необходимо заполнить «Имя».');
        $I->seeValidationError('Необходимо заполнить «E-mail».');
        $I->seeValidationError('Необходимо заполнить «Тема сообщения».');
        $I->seeValidationError('Необходимо заполнить «Сообщение».');
        $I->seeValidationError('Неправильный проверочный код.');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeValidationError('Значение «E-mail» не является правильным email адресом.');
        $I->dontSeeValidationError('Необходимо заполнить «Имя».');
        $I->dontSeeValidationError('Необходимо заполнить «Тема сообщения».');
        $I->dontSeeValidationError('Необходимо заполнить «Сообщение».');
        $I->dontSeeValidationError('Неправильный проверочный код.');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->see('Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
    }
}
