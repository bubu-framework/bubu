<?php

namespace Bubu\Http\Auth\Authorization\roles;

class RoleManager
{

    private const FILE_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'roles.json';

    public static function getAll(): array
    {
        return json_decode(file_get_contents(self::FILE_PATH), true);
    }

    public static function getRole(string $role): array
    {
        return json_decode(file_get_contents(self::FILE_PATH), true)[$role];
    }

    public static function createRole(string $roleName, array $permissions): void
    {
        $roles = json_decode(file_get_contents(self::FILE_PATH), true);
        $roles[$roleName] = $permissions;
        file_put_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'roles.json',
            json_encode($roles)
        );
    }

    public static function removeRole(string $roleName): void
    {
        $roles = json_decode(file_get_contents(self::FILE_PATH), true);
        unset($roles[$roleName]);
        file_put_contents(
            __DIR__ . DIRECTORY_SEPARATOR . 'roles.json',
            json_encode($roles)
        );
    }
}
