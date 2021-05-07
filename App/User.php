<?php
namespace App;

use App\Database\Database;

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
        self::request(
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
            return $GLOBALS['lang']['existing-username'];
        } elseif (
            $password !== $passwordConfirm
        ) {
            return $GLOBALS['lang']['not-same-password'];
        } elseif (
            strlen($password) < 10
            || strlen($password) > 30
        ) {
            return $GLOBALS['lang']['password-length'];
        } elseif (
            strlen($username) < 3
        ) {
            return $GLOBALS['lang']['username-length'];
        } else {
            self::request(
                'INSERT INTO `users` (
                    `username`,
                    `password`,
                    `mail`,
                    `token`
                ) VALUES (
                    :username,
                    :password,
                    :mail,
                    :token
                )',
                [
                    'username' => $username,
                    'password' => password_hash($password, constant($_ENV['HASH_ALGO'])),
                    'mail' => $mail,
                    'token' => bin2hex((new \OAuthProvider)->generateToken(128))
                ]
            );
            return true;
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
        $request = self::request(
            'SELECT `username`, `password`
            FROM `users`
            WHERE `username` = :username',
            [
                'username' => $username,
            ],
            'fetch'
        );

        if (count($request) === 0) {
            return $GLOBALS['lang']['account-not-found'];
        } elseif (!password_verify($password, $request['password'])) {
            return $GLOBALS['lang']['incorrect-password'];
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
