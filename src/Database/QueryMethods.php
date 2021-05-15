<?php

namespace Bubu\Database;

trait QueryMethods
{
    
    /**
     * @var string|null $as
     * @var string|null $select
     * @var string|null $condition
     * @var array $whereValues
     */
    protected $as;
    protected $select;
    protected $condition;
    protected array $whereValues = [];

    /**
     * @param  string $as
     * @return self
     */
    public function as(string $as): self
    {
        $this->as = $as;
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
        $this->select = rtrim($select, ',') . ' FROM ';
        return $this;
    }

    /**
     * @return self
     */
    public function delete(): self
    {
        $this->delete = 'DELETE FROM ';
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
            $marker = array_key_first($value[1]);
            $condition .= "`{$value[0]}` " . (isset($value[2]) ? "{$value[2]} " : '= ') . "{$marker} AND ";
            if (isset($value[1][1])) {
                $this->whereValues[] = $value[1];
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
        $request = 0;
       return $request;
    }
}
