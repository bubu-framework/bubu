<?php

namespace Bubu\Utils\Form;

use Bubu\DevTools\Dump;
use Bubu\Exception\ShowException;
use Bubu\Http\Session\Session;
use Bubu\Http\Session\SessionException;
use Bubu\Logger\Logger;

class Csrf
{
    public static function create(): array
    {
        $token = bin2hex(random_bytes(30));
        Session::set('csrf', $token);
        return [
            'input' => [
                (new Form)->input->hidden,
                (new Form)->input->value($token),
                (new Form)->input->name('csrf')
            ]
        ];
    }

    public static function check(array $post)
    {
        try {
            $csrf = Session::get('csrf');
            Session::delete('csrf');
            if (is_object($csrf) && get_class($csrf) === SessionException::class) {
                throw new CsrfException('Invalid CSRF');
            } else {
                if ($post['csrf'] !== $csrf) {
                    throw new CsrfException('Invalid CSRF');
                } else {
                    return true;
                }
            }
        } catch (CsrfException $e) {
            ShowException::SR($e);
        }
    }
}
