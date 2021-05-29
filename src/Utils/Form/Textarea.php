<?php

namespace Bubu\Utils\Form;

class Textarea
{
    public array $autocomplete  = ['autocomplete' => 'on'];
    public array $autofocus     = ['boolAttribute' => 'autofocus'];
    public array $disable       = ['boolAttribute' => 'disable'];
    public array $readonly      = ['boolAttribute' => 'readonly'];
    public array $required      = ['boolAttribute' => 'required'];
    public array $wrapHard      = ['wrap' => 'hard'];

    
    /**
     * name
     *
     * @param  string $name
     * @return array
     */
    public function name(string $name): array
    {
        return ['name' => $name];
    }
    
    /**
     * value
     *
     * @param  string $value
     * @return array
     */
    public function value(string $value): array
    {
        return ['value' => $value];
    }

    /**
     * placeholder
     *
     * @param  string $placeholder
     * @return void
     */
    public function placeholder(string $placeholder): array
    {
        return ['placeholder' => $placeholder];
    }

    /**
     * minlength
     *
     * @param  int $minlength
     * @return void
     */
    public function minlength(int $minlength): array
    {
        return ['minlength' => $minlength];
    }

    /**
     * maxlength
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
     * cols
     *
     * @param  int $cols
     * @return void
     */
    public function cols(int $cols): array
    {
        return ['cols' => $cols];
    }

    /**
     * rows
     *
     * @param  int $rows
     * @return void
     */
    public function rows(int $rows): array
    {
        return ['rows' => $rows];
    }
}
