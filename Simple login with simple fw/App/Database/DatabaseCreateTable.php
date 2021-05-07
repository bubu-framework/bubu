<?php

namespace App\Database;

class DatabaseCreateTable extends Database
{

    /**
     * @var string $name Table name
     * @var array $allColumn Contain all columns request
     * @var array $allIndex Contain all index request
     * @var string $collate Collate of table
     * @var string $engine Engine of table
     */
    private $name;
    private $allColumn = [];
    private $allIndex = [];
    private $collate = 'utf8_general_ci';
    private $engine = 'InnoDB';
    private static $required = ['name'];

    public static function createTable(): DatabaseCreateTable
    {
        return new DatabaseCreateTable;
    }

    public function debug(): DatabaseCreateTable
    {
        var_dump(
            '<pre>',
            $this,
            '</pre>'
        );
        return $this;
    }

    /**
     * @return DatabaseCreateTable
     * @throws DatabaseException
     */
    public function __call($name, $arguments): DatabaseCreateTable
    {
        if (array_key_exists($name, get_class_vars(get_class($this)))) {
            $this->{$name} = $arguments[0];
            return $this;
        } else {
            throw new DatabaseException('Property not found.');
        }
    }

    public function column($arguments): DatabaseCreateTable
    {
        $this->allColumn[] = $arguments[0];
        return $this;
    }

    public function addIndex($arguments)
    {
        $this->allIndex[] = 
            strtoupper($arguments['type'])
            . ' INDEX '
            . "`{$arguments['name']}`"
            . ' (`'
            . implode('`,`', $arguments['column'])
            . '`)';
        return $this;
    }

    public function build()
    {
        foreach (self::$required as $require) {
            if (is_null($this->{$require})) {
                throw new DatabaseException('A variable required is null');
            }
        }

        $request =
            "CREATE TABLE `{$this->name}` ("
            . implode(',', $this->allColumn)
            . (!is_null($this->allIndex) ? ',' . implode(',', $this->allIndex) : '')
            . ')'
            . " COLLATE='{$this->collate}'"
            . " ENGINE={$this->engine}";

        Database::request($request, [], '');
    }
}