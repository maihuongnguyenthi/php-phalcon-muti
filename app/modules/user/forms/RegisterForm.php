<?php
namespace App\Modules\User\Forms;

use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;
use Phalcon\Filter\Validation\Validator\Regex;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Form;

class RegisterForm extends Form
{
    public function initialize()
    {
        $name = new Text('name', [
            'placeholder' => 'name'
        ]);
        $name->setLabel('name');
        $name->addValidators([
            new PresenceOf(['message' => 'Username is required']),
            new Regex([
                'pattern' => '/^[a-zA-Z\s]+$/',
                'message' => 'UserName Only letters and white space allowed'
            ])
        ]);
        $this->add($name);

        $phone = new Text('phone', [
            'placeholder' => 'Phone',
            'class' => 'form-control'
        ]);
        $phone->setLabel('Phone');
        $phone->addValidators([
            new PresenceOf([
                'message' => 'Phone is required'
            ]),
            new Regex([
                'pattern' => '/^0\d{9,10}$/',
                'message' => 'Please enter a valid phone number'
            ])
        ]);
        $this->add($phone);

        $address = new Text('address', [
            'placeholder' => 'Address',
            'class' => 'form-control'
        ]);
        $address->setLabel('Address');
        $address->addValidators([
            new PresenceOf([
                'message' => 'Address is required'
            ]),
            new Regex([
                'pattern' => '/^[a-zA-Z0-9\s,]+$/',
                'message' => 'Address Only letters, numbers, commas, and white space allowed'
            ])
        ]);
        $this->add($address);

        $email = new Text('email', [
            'placeholder' => 'Email Address',
            'class' => 'form-control'
        ]);
        $email->setLabel('Email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'Email is required'
            ]),
            new EmailValidator([
                'message' => 'The email is not valid'
            ])
        ]);
        $this->add($email);

        $pass = new Password('pass', [
            'placeholder' => 'Password'
        ]);
        $pass->setLabel('Pass');
        $pass->addValidators([
            new PresenceOf(['message' => 'Password is required']),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password must be at least 8 characters'
            ]),
        ]);
        $this->add($pass);

        $signup = new Submit('signup', [
            'value' => 'signup',
            'class' => 'btn btn-primary'
        ]);
        $this->add($signup);
    }
}
