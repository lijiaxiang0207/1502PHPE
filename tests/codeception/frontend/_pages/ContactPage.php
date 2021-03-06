<?php

namespace tests\codeception\frontend\_pages;

use frontend\models\ContactForm;
use yii\codeception\BasePage;

/**
 * Represents contact page
 * @property \tests\codeception\frontend\AcceptanceTester|\tests\codeception\frontend\FunctionalTester $actor
 */
class ContactPage extends BasePage
{
    public $route = 'site/contact';

    /**
     * @param array $contactData
     */
    public function submit(array $contactData)
    {
        $contactForm = new ContactForm;

        foreach ($contactData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $contactForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('contact-button');
    }
}
