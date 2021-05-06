<?php

namespace App\Database;

class DatabaseCreateTable extends Database
{

    private $request;

    public static function createTable(): DatabaseCreateTable
    {
        return new DatabaseCreateTable;
    }

    public function column(): DatabaseCreateTable
    {
        $this->request .= 'yes';
        return $this;
    }

    public function debug()
    {
        var_dump($this);
    }
}