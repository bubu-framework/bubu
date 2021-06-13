<?php

namespace Bubu\Http\Auth\Authorization;

use Bubu\Database\Database;

class Authorization
{

    public static function hasAuthorization(int $userId, ...$authorization): bool
    {
        if (is_array($authorization[0])) $authorization = array_flip($authorization[0]);
        self::userInTable($userId);
        $db = Database::queryBuilder('authorization');
        foreach ($authorization as $value) {
            $db->select($value);
        }

        $db->where([
            'id',
            ['?' => $userId]
        ]);
        $results = $db->fetch();
        foreach ($results as $value) {
            if ($value !== 1) {
                return false;
            }
        }
        return true;
    }

    public static function addAuthorization(int $userId, mixed ...$authorization)
    {
        self::changeAuthorization($userId, $authorization, 1);
    }

    public static function removeAuthorization(int $userId, mixed ...$authorization)
    {
        self::changeAuthorization($userId, $authorization, 0);
    }

    private static function userInTable(int $userId)
    {
        $userIsset =
            Database::queryBuilder('authorization')
                ->select('id')
                ->where([
                    'id',
                    ['?' => $userId]
                ])
                ->fetch()
        ;

        if ($userIsset === false) {
            Database::queryBuilder('authorization')
                ->insert(['id' => $userId])
                ->execute();
        }
    }

    public static function changeMultipleAuthorizations(int $userId, array $authorization)
    {
        self::userInTable($userId);
        $db = Database::queryBuilder('authorization');
        $listAuth = [];
        foreach ($authorization as $key => $value) {
            $listAuth[$key] = $value;
        }
        $db->update($listAuth);
        $db->where([
            'id',
            ['id' => $userId]
        ]);
        $db->execute();
    }

    private static function changeAuthorization(
        int $userId,
        array $authorization,
        bool $auth
    ): void {
        self::userInTable($userId);
        $db = Database::queryBuilder('authorization');
        $db->update(
            [
                $authorization => $auth
            ]
        );
        $db->where([
            'id',
            ['id' => $userId]
        ]);
        $db->execute();
    }
}
