<?php

namespace Bubu\Utils\Form;

class Textarea
{
    /**
     * Textarea attributes
     */
    public array $autocomplete  = ['autocomplete' => 'on'];
    public array $autofocus     = ['boolAttribute' => 'autofocus'];
    public array $disable       = ['boolAttribute' => 'disable'];
    public array $readonly      = ['boolAttribute' => 'readonly'];
    public array $required      = ['boolAttribute' => 'required'];
    public array $wrapHard      = ['wrap' => 'hard'];

    
    /**
     * Name to give to textarea field
     * 
     * @param  string $name
     * @return array
     */
    public function name(string $name): array
    {
        return ['name' => $name];
    }
    
    /**
     * Value of textarea field
     * 
     * @param  string $value
     * @return array
     */
    public function value(string $value): array
    {
        return ['value' => $value];
    }

    /**
     * Placeholder of textarea field
     * 
     * @param  string $placeholder
     * @return void
     */
    public function placeholder(string $placeholder): array
    {
        return ['placeholder' => $placeholder];
    }

    /**
     * Min length of textarea field
     * 
     * @param  int $minlength
     * @return void
     */
    public function minlength(int $minlength): array
    {
        return ['minlength' => $minlength];
    }

    /**
     * Man length of textarea field
     * 
     * @param  int $maxlength
     * @return void
     */
    public function maxlength(int $maxlength): array
    {
        return ['maxlength' => $maxlength];
    }

    /**
     * spellcheck
     *
     * @param  bool $spellcheck
     * @return void
     */
    public function spellcheck(bool $spellcheck): array
    {
        return ['spellcheck' => $spellcheck];
    }

    /**
     * Number of columns
     *
     * @param  int $cols
     * @return void
     */
    public function cols(int $cols): array
    {
        return ['cols' => $cols];
    }

    /**
     * Number of rows
     *
     * @param  int $rows
     * @return void
     */
    public function rows(int $rows): array
    {
        return ['rows' => $rows];
    }
}
