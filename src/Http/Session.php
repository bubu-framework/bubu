<?php

namespace Bubu\Http;

class Session
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            ini_set('session.gc_maxlifetime', $_ENV['SESSION_DURATION'] * 60 * 60 * 24);
            session_set_cookie_params($_ENV['SESSION_DURATION'] * 60 * 60 * 24);
            session_start();
        }
    }

    public static function start()
    {
        return new Session();
    }

    public static function get(string $key): mixed
    {
        self::start();
        return $_SESSION[$key];
    }

    public static function set(string $key, mixed $data): void
    {
        self::start();
        $_SESSION[$key] = $data;
    }

    public static function push(string $key, mixed $data): void
    {
        self::start();
        if (!array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = [];
        }
        $_SESSION[$key] = array_merge_recursive($_SESSION[$key], $data);
    }

    public static function delete(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_reset();
        session_unset();
        session_destroy();
    }
}
