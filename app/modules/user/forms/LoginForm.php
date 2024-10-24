<?php
namespace App\Modules\User\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;

class LoginForm extends Form
{
    public function initialize()
    {
        $email = new Text('email', [
            'placeholder' => 'Email Address',
            'class' => 'form-control'
        ]);
        $email->setLabel('Email Address');
        $email->addValidators([
            new PresenceOf([
                'message' => 'Email is required'
            ]),
            new EmailValidator([
                'message' => 'The email is not valid'
            ])
        ]);
        $this->add($email);

        $password = new Password('pass', [
            'placeholder' => 'Password',
            'class' => 'form-control'
        ]);
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ]),
            new StringLength([
                'min' => 6,
                'messageMinimum' => 'Password must be at least 6 characters'
            ])
        ]);
        $this->add($password);

        $submit = new Submit('Login', [
            'value' => 'Login',
            'class' => 'btn btn-primary w-100'
        ]);
        $this->add($submit);
    }
}
?>