<?php

namespace Bubu\Utils\Form\Templates;

use App\User;
use Bubu\Flash\Flash;
use Bubu\Utils\Form\Csrf;
use Bubu\Utils\Form\Form;

class Signup
{
    public static function signup(
        string $action,
        string $method,
        bool $csrf = false
    ): string {
        $form = new Form();
        $form
            ->add([
                'label' => [
                    $form->label->for('username'),
                    $form->label->value($GLOBALS['lang']['ask-username'])
                ]
            ])
            ->add([
                'input' => [
                    $form->input->text,
                    $form->input->name('username'),
                    $form->input->id('username'),
                    $form->input->placeholder($GLOBALS['lang']['ask-username'])
                ]
            ])
            ->add([
                'label' => [
                    $form->label->for('password'),
                    $form->label->value($GLOBALS['lang']['ask-password'])
                ]
            ])
            ->add([
                'input' => [
                    $form->input->password,
                    $form->input->name('password'),
                    $form->input->id('password'),
                    $form->input->placeholder($GLOBALS['lang']['ask-password'])
                ]
            ])
            ->add([
                'label' => [
                    $form->label->for('passwordConfirm'),
                    $form->label->value($GLOBALS['lang']['ask-password'])
                ]
            ])
            ->add([
                'input' => [
                    $form->input->password,
                    $form->input->name('passwordConfirm'),
                    $form->input->id('passwordConfirm'),
                    $form->input->placeholder($GLOBALS['lang']['ask-password'])
                ]
            ])

            ->add([
                'label' => [
                    $form->label->for('email'),
                    $form->label->value($GLOBALS['lang']['ask-email'])
                ]
            ])
            ->add([
                'input' => [
                    $form->input->email,
                    $form->input->name('email'),
                    $form->input->id('email'),
                    $form->input->placeholder($GLOBALS['lang']['ask-email'])
                ]
            ])
            ->add([
                'button' => [
                    $form->button->submit,
                    $form->button->value($GLOBALS['lang']['signup-button']),
                    $form->button->name('sendForm')
                ]
            ]);
            if ($csrf) $form->csrf();
            return $form->action($action)
            ->method($method)
            ->build();
    }

    public static function signupVerify(array $requestData, bool $csrf = false): bool
    {

        if ($csrf) Csrf::check($requestData);

        $return = User::signup(
            $requestData['username'],
            $requestData['password'],
            $requestData['passwordConfirm'],
            $requestData['email']
        );

        var_dump($return);

        if ($return === true) {
            Flash::valid('Connected');
            return true;
        } else {
            Flash::error($return);
            return false;
        }
    }
}
