<?php

namespace Bubu\Database;

trait QueryMethods
{

    /**
     * @var string $table
     * @var string|null $as
     * @var string|null $action
     * @var string|null $condition
     * @var string|null $set
     * @var array $whereValues
     */
    protected $table;
    protected $as;
    protected $action;
    protected $condition;
    protected $set;
    protected array $whereValues = [];

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param  string $as
     * @return self
     */
    public function as(string $as): self
    {
        $this->as =  "AS {$as} ";
        return $this;
    }

    /**
     * @param string $columns
     * @return self
     */
    public function select(string ...$columns): self
    {
        $select = 'SELECT';
        foreach ($columns as $value) {
            if ($value === '*') {
                $select .= ' *,';
            } else {
                $select .= " `{$value}`,";
            }
        }
        $this->action = rtrim($select, ',') . ' FROM `[TABLE_NAME]`';
        return $this;
    }

    /**
     * @return self
     */
    public function delete(): self
    {
        $this->action = 'DELETE FROM `[TABLE_NAME]` ';
        return $this;
    }

    /**
     * @return self
     */
    public function update(): self
    {
        $this->action = 'UPDATE `[TABLE_NAME]` ';
        return $this;
    }
    
    /**
     * @param array $where
     * @return self
     */
    public function where(array ...$where): self
    {
        if (is_null($this->condition)) {
            $condition = ' WHERE (';
        } else {
            $condition = $this->condition . ' OR (';
        }
        foreach ($where as $value) {
            $marker = key($value[1]);
            $condition .= "`{$value[0]}` " . (isset($value[2]) ? "{$value[2]} " : '= ') . "{$marker} AND ";
            if (isset($value[1])) {
                $this->whereValues[
                    $marker
                ] = $value[1][$marker];
            }
        }
        $condition = rtrim($condition, ' AND ');
        $condition .= ')';
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return string
     */
    private function build(): string
    {
       $request = str_replace('[TABLE_NAME]', $this->table, $this->action);
       if (!is_null($this->condition)) {
           $request .= $this->condition;
       }
       return $request;
    }
}
