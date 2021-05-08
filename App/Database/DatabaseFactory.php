<?php
/*
namespace App\Database;

class DatabaseFactory
{
    public static function __callStatic($name, $arguments)
    {
        $classPath = __NAMESPACE__ . '\Database' . ucfirst($name);
        if (class_exists($classPath)) {
            return call_user_func_array([$classPath, $name], $arguments);
        } else {
            throw new DatabaseException('Method not fond');
        }
    }
}*/
