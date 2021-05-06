<?php

namespace App\Database;

class DatabaseCreateColumn
{

    protected $name;
    protected $type;
    protected static $required = ['name', 'type'];

    public static function createColumn()
    {
        return new DatabaseCreateColumn;
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function build()
    {
        foreach (self::$required as $require) {
            if (is_null($this->{$require})) {
                throw new DatabaseException('A variable required is null');
            }
        }

        return "{$this->name}  {$this->type}";
    }
}
