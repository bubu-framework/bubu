<?php

namespace Bubu\Http\Session;

class Session
{
    public function __construct(?int $sessionCache = null, ?int $sessionLifetime = null)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {

            if (is_null($sessionLifetime)) $sessionLifetime = $_ENV['SESSION_DURATION'];

            ini_set('session.gc_maxlifetime', $sessionLifetime * 60 * 60 * 24);
            session_set_cookie_params($sessionLifetime * 60 * 60 * 24);

            if (is_null($sessionCache))  $sessionCache = $_ENV['HTTP_EXPIRES'];

            session_cache_expire($sessionCache);
            session_cache_limiter($_ENV['SESSION_CACHE_LIMITER']);
            session_start();
        }
    }

    public static function start(?int $sessionCache = null, ?int $sessionLifetime = null): Session
    {
        return new Session($sessionCache, $sessionLifetime);
    }

    public static function get(string $key): mixed
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return new SessionException('Undefined');
        }
    }

    public static function getAll(): array
    {
        self::start();
        return $_SESSION;
    }

    public static function set(string $key, mixed $data): void
    {
        self::start();
        $_SESSION[$key] = $data;
    }

    public static function push(string $key, mixed $data): void
    {
        self::start();
        if (!array_key_exists($key, $_SESSION)) $_SESSION[$key] = [];
        $_SESSION[$key] = array_merge_recursive($_SESSION[$key], $data);
    }

    public static function delete(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function changeSessionLifetime(int $newLifetime)
    {
        $tempSession = $_SESSION;
        $cacheExpire = session_cache_expire();
        self::destroy();
        self::start($cacheExpire, $newLifetime);
        session_regenerate_id(true);
        $_SESSION = $tempSession;
    }

    public static function destroy(): void
    {
        session_reset();
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', '', 1);
    }
}
