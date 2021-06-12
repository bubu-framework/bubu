<?php

namespace Bubu\Http\HttpRequire;

use Bubu\Http\HttpRequire\Exception\HttpRequireException;

class HttpRequire
{
        
    /**
     * https
     *
     * @param  bool $throwException True for throw exception, false for just redirect to https
     * @return never
     */
    public static function https(bool $throwException = false)
    {
        if ($throwException) {
            throw new HttpRequireException('HTTPS is required');
        } else {
            if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
                $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . $location);
                exit;
            }
        }
    }
}
