<?php

namespace Bubu\Database;

use Bubu\Exception\ShowException;

/**
 * @method DatabaseCreateTable ifNotExists(bool $ifNotExists)
 * @method DatabaseCreateTable collate(string $collate)
 * @method DatabaseCreateTable comments(string $comments)
 * @method DatabaseCreateTable engine(string $engine)
 */

class DatabaseCreateTable
{

    /**
     * @var bool $ifNotExists Create table if not exists condition
     * @var string $name Table name
     * @var array $allColumn Contain all columns request
     * @var array $allIndex Contain all index request
     * @var array $foreignKey foreign keys of columns
     * @var string $collate Collate of table
     * @var string $comments Comments of table
     * @var string $engine Engine of table
     */
    private bool $ifNotExists = false;
    private string $name;
    private array $allColumn = [];
    private array $allIndex = [];
    private array $foreignKey = [];
    private string $collate = 'utf8_general_ci';
    private $comments;
    private string $engine = 'InnoDB';
    private static array $required = ['name'];
    
    /**
     * @param mixed $name
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * @return DatabaseCreateTable
     */
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
        try {
            if (array_key_exists($name, get_class_vars(get_class($this)))) {
                if (count($arguments) === 0) {
                    $this->{$name} = true;
                } elseif (count($arguments) === 1) {
                    $this->{$name} = $arguments[0];
                } else {
                    $this->{$name} = $arguments;
                }
                return $this;
            } else {
                throw new DatabaseException('Property not found.');
            }
        } catch (DatabaseException $e) {
            ShowException::SR($e);
        }
    }

    /**
     * @param string $arguments
     * @return DatabaseCreateTable
     */
    public function column(string $arguments): DatabaseCreateTable
    {
        $this->allColumn[] = $arguments;
        return $this;
    }

    /**
     * @param array $arguments
     * @return DatabaseCreateTable
     */
    public function addIndex(array $arguments)
    {
        $this->allIndex[] = 
            strtoupper($arguments['type'])
            . (strtoupper($arguments['type']) === 'PRIMARY' ? ' KEY ' : ' INDEX ')
            . "`{$arguments['name']}`"
            . ' (`'
            . implode('`,`', $arguments['column'])
            . '`)';
        return $this;
    }

    /**
     * @return DatabaseCreateTable
     */
    public function foreignKey($arguments)
    {
        $this->foreignKey[] = 
            'CONSTRAINT '
            . "`{$arguments['name']}`"
            . ' FOREIGN KEY (`'
            . implode('`,`', $arguments['columns'])
            . '`) REFERENCES '
            . "`{$arguments['references']}` (`"
            . implode('`,`', $arguments['foreign'])
            . '`) '
            . (isset($arguments['on update']) ? 'ON UPDATE ' . strtoupper($arguments['on update']) . ' ' : '')
            . (isset($arguments['on delete']) ? 'ON DELETE ' . strtoupper($arguments['on delete']) . ' ' : '');
        return $this;
    }

    private function build(): string
    {
        try {
            foreach (self::$required as $require) {
                if (is_null($this->{$require})) {
                    throw new DatabaseException('A variable required is null');
                }
            }

            $request =
                ($this->ifNotExists ? '' : "DROP TABLE IF EXISTS `{$this->name}`; ")
                .'CREATE TABLE'
                . ($this->ifNotExists ? ' IF NOT EXISTS' : '')
                ." `{$this->name}` ("
                . implode(',', $this->allColumn)
                . (!is_null($this->allIndex) ? ',' . implode(',', $this->allIndex) : '')
                . (!is_null($this->foreignKey) ? ',' . implode(',', $this->foreignKey) : '')
                . ')'
                . " COLLATE='{$this->collate}'"
                . (!is_null($this->comments) ? " COMMENT '{$this->comments}'" : '')
                . " ENGINE={$this->engine}";

            return $request;
        } catch (DatabaseException $e) {
            ShowException::SR($e);
        }
    }

    /**
     * @return DatabaseCreateTable
     */
    public function simulate(): DatabaseCreateTable
    {
        $request = $this->build();
        echo $request;
        return $this;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $request = $this->build();
        Database::request($request, [], '');
    }
}