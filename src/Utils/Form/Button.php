<?php

namespace Bubu\Utils\Form;

class Button
{
    public array $button        = ['type' => 'button'];
    public array $reset         = ['type' => 'reset'];
    public array $submit        = ['type' => 'submit'];
    
    public array $autofocus     = ['boolAttribute' => 'autofocus'];
    public array $disable       = ['boolAttribute' => 'disable'];

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
}
