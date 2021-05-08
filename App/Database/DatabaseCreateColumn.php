<?php

namespace App\Database;

class DatabaseCreateColumn
{

    /**
     * @var string $name Name of column
     * @var string $type Type of column
     * @var int|null $size Size of column
     * @var bool $unsigned If column should have UNSIGNED attribute
     * @var bool $zerofill If column should have ZEROFILL attribute
     * @var bool $notNull If column should have NOTNULL attribute
     * @var bool $auto_increment If column should have AUTO_INCREMENT attribute
     * @var string|null $defaultValue If column have a default value
     * @var string|null $comments Comments for column
     * @var string|null $collate If column should have a collate
     */
    protected $name;
    protected $type;
    protected $size;
    protected $unsigned = false;
    protected $zerofill = false;
    protected $notNull = false;
    protected $auto_increment = false;
    protected $defaultValue;
    protected $comments;
    protected $collate;
    protected static $required = ['name', 'type'];

    public $request;


    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function debug(): DatabaseCreateColumn
    {
        var_dump(
            '<pre>',
            $this,
            '</pre>'
        );
        return $this;
    }

    /**
     * @method DatabaseCreateColumn unsigned(bool)
     * @return DatabaseCreateColumn
     * @throws DatabaseException
     */
    public function __call($name, $arguments): DatabaseCreateColumn
    {
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
    }

    /**
     * @return array Return all column query with the new
     */
    public function build(): array
    {
        foreach (self::$required as $require) {
            if (is_null($this->{$require})) {
                throw new DatabaseException('A variable required is null');
            }
        }
        $request[] = 
            trim(
                "`{$this->name}`"
                    . ' '
                    . strtoupper($this->type)
                    . (!is_null($this->size) ? "({$this->size})" : '')
                    . ($this->unsigned ? ' UNSIGNED' : '')
                    . ($this->zerofill ? ' ZEROFILL' : '')
                    . ($this->notNull ? ' NOT NULL' : ' NULL')
                    . ($this->auto_increment ? ' AUTO_INCREMENT' : '')
                    . (
                        !is_null($this->defaultValue)
                        ? ' DEFAULT' . 
                            (
                                $this->defaultValue[1] === 'string'
                                ? " '{$this->defaultValue[0]}'"
                                : " {$this->defaultValue[0]}"
                            )
                        : '')


                    . (!is_null($this->comments) ? " COMMENT '{$this->comments}'" : '')
                    . (!is_null($this->collate) ? " COLLATE '{$this->collate}'" : '')
                );
        return $request;
    }
}
