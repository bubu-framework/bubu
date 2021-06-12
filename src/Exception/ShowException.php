<?php

namespace Bubu\Exception;

use Bubu\Logger\Logger;

class ShowException
{
    /**
     * Show and Register
     *
     * @param Exception $e
     * @return void
     */
    public static function SR($e)
    {
        self::show($e);
        self::register($e);
    }

    public static function show($exception)
    {
        if ($_ENV['DEBUG']) echo $exception;
    }

    public static function register($exception)
    {
        Logger::addLog(
              "{$exception->getMessage()} "
            . "in {$exception->getFile()} "
            . "on line {$exception->getLine()} "
            . "(code {$exception->getCode()})"
        );
    }
}
