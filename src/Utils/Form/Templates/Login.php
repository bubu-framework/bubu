<?php

namespace Bubu\Utils\Form\Templates;

use App\User;
use Bubu\Flash\Flash;
use Bubu\Utils\Form\Form;

class Login
{
    public static function login(string $action, string $method): string
    {
        $form = new Form();
        return $form
            ->add([
                'label' => [
                    $form->label->for('username'),
                    $form->label->value('Nom d\'utilisateur')
                ]
            ])
            ->add([
                'input' => [
                    $form->input->text,
                    $form->input->name('username'),
                    $form->input->id('username'),
                    $form->input->placeholder('Votre nom d\'utilisateur')
                ]
            ])
            ->add([
                'label' => [
                    $form->label->for('password'),
                    $form->label->value('Mot de passe')
                ]
            ])
            ->add([
                'input' => [
                    $form->input->password,
                    $form->input->name('password'),
                    $form->input->id('password'),
                    $form->input->placeholder('Votre mot de passe')
                ]
            ])
            ->add([
                'label' => [
                    $form->label->for('keepConnect'),
                    $form->label->value('Rester connecter? ')
                ]
            ])
            ->add([
                'input' => [
                    $form->input->checkbox,
                    $form->input->name('keepConnect'),
                    $form->input->id('keepConnect')
                ]
            ])
            ->add([
                'button' => [
                    $form->button->submit,
                    $form->button->value('Se connecter'),
                    $form->button->name('sendForm')
                ]
            ])
            ->action($action)
            ->method($method)
            ->build();
    }

    public static function loginVerify(array $requestData): bool
    {
        $return = User::login(
            $requestData['username'],
            $requestData['password'],
            (isset($requestData['keepConnect']) ? true : false)
        );

        if ($return === true) {
            Flash::valid('Connected');
            return true;
        } else {
            Flash::error($return);
            return false;
        }
    }
}
