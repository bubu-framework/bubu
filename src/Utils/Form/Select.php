<?php

namespace Bubu\Utils\Form;

class Select
{
    public array $autocomplete  = ['autocomplete' => 'on'];
    public array $autofocus     = ['boolAttribute' => 'autofocus'];
    public array $disable       = ['boolAttribute' => 'disable'];
    public array $required      = ['boolAttribute' => 'required'];
    public array $multiple      = ['boolAttribute' => 'multiple'];
    
    /**
     * option
     *
     * @var string $value
     * @var string $text
     * @var bool $disable
     * @var bool $selected
     * @return void
     */
    public function option(
        string $value,
        string $text,
        bool $disable = false,
        bool $selected = false
    ): array {
        $opt = '';
        if ($disable) {
            $opt .= ' disable ';
        }

        if ($selected) {
            $opt .= ' selected ';
        }

        return ['value' => "<option value=\"{$value}\" {$opt}>{$text}</option>"];
    }

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
     * size
     *
     * @param  int $size
     * @return array
     */
    public function size(int $size): array
    {
        return ['size' => $size];
    }
}
