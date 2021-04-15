<?php
namespace App;

class User extends Database
{
    protected $globalAccountInformation;

    /**
     * @param string $username
     * @param string $mail
     * @param string $password
     * @param string $passwordConfirm
     * 
     * @return bool|string
     */

    private function setNewAccount(string $username, string $mail, string $password, string $passwordConfirm)
    {
        $accountNumber =
        self::getRequest(
            'SELECT *
                FROM `users`
                WHERE `username` = :username',
            [
                'username' => $username,
            ],
            'fetchAll'
        );
        if (
            count($accountNumber) !== 0
        ) {
            return 'Nom d\'utilisateur déjà existant!';
        } elseif (
            $password !== $passwordConfirm
        ) {
            return 'Les mots de passe ne correspondent pas!';
        } elseif (
            strlen($password) < 10
            || strlen($password) > 30
        ) {
            return 'Saisissez un mot de passe entre 10 et 30 caractères!';
        } elseif (
            strlen($username) <= 3
        ) {
            return 'Votre identifiant doit contenir au moins 3 caractères inclus!';
        } else {
            if (
                self::getRequest(
                    'INSERT INTO `users` (
                        `username`,
                        `password`,
                        `mail`
                    ) VALUES (
                        :username,
                        :password,
                        :mail
                    )',
                    [
                        'username' => $username,
                        'password' => password_hash($password, $_ENV['HASH_ALGO']),
                        'mail' => $mail,
                    ]
                )
            ) {
                return true;
            } else {
                return 'Une erreur s\'est produite!';
            }
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $keepSession
     * 
     * @return bool|string
     */
    private function setConnexion(string $username, string $password, bool $keepSession = false)
    {
        $request = self::getRequest(
            'SELECT *
            FROM `users`
            WHERE `username` = :username',
            [
                'username' => $username,
            ],
            'fetch'
        );

        if (!$request) {
            return 'Compte introuvable';
        } elseif (!password_verify($password, $request['password'])) {
            return 'Mot de passe incorrect';
        } else {
            $this->globalAccountInformation = $request;
            if ($keepSession) {
                session_set_cookie_params($_ENV['SESSION_DURATION']*60*60*24);
            }
            return true;
        }
    }

    /**
     * @param string $username
     * @param string $mail
     * @param string $password
     * @param string $passwordConfirm
     * 
     * @return bool|string
     */
    public function getNewAccount(string $username, string $mail, string $password, string $passwordConfirm)
    {
        return $this->setNewAccount($username, $mail, $password, $passwordConfirm);
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $keepSession
     * 
     * @return bool|string
     */
    public function getConnexion(string $username, string $password)
    {
        return $this->setConnexion($username, $password);
    }

    /**
     * @param string $info
     * 
     * @return mixed
     */
    public function getInformation(string $info): mixed
    {
        return $this->globalAccountInformation[$info];
    }

    /**
     * @return array
     */
    public function getAllInformation(): array
    {
        return $this->globalAccountInformation;
    }

    /**
     * @param array $informations
     * 
     * @return void
     */
    public function setInformation(array $informations): void
    {
        foreach ($informations['globalAccountInformation'] as $key => $value) {
            $this->globalAccountInformation[$key] = $value;
        }
    }
}
