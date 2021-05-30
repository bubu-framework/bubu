<?php

namespace Bubu\Utils\Form;

class Input
{
    public array $button        = ['type' => 'button'];
    public array $checkbox      = ['type' => 'checkbox'];
    public array $color         = ['type' => 'color'];
    public array $date          = ['type' => 'date'];
    public array $datetimeLocal = ['type' => 'datetime-local'];
    public array $email         = ['type' => 'email'];
    public array $file          = ['type' => 'file'];
    public array $hidden        = ['type' => 'hidden'];
    public array $image         = ['type' => 'image'];
    public array $month         = ['type' => 'month'];
    public array $number        = ['type' => 'number'];
    public array $password      = ['type' => 'password'];
    public array $radio         = ['type' => 'radio'];
    public array $range         = ['type' => 'range'];
    public array $reset         = ['type' => 'reset'];
    public array $search        = ['type' => 'search'];
    public array $submit        = ['type' => 'submit'];
    public array $tel           = ['type' => 'tel'];
    public array $text          = ['type' => 'text'];
    public array $time          = ['type' => 'time'];
    public array $url           = ['type' => 'url'];
    public array $week          = ['type' => 'week'];

    public array $autocomplete  = ['autocomplete' => 'on'];
    public array $autofocus     = ['boolAttribute' => 'autofocus'];
    public array $disable       = ['boolAttribute' => 'disable'];
    public array $readonly       = ['boolAttribute' => 'readonly'];
    public array $required       = ['boolAttribute' => 'required'];
    
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
     * @return array
     */
    public function placeholder(string $placeholder): array
    {
        return ['placeholder' => $placeholder];
    }

    /**
     * id
     *
     * @param  string $id
     * @return array
     */
    public function id(string $id): array
    {
        return ['id' => $id];
    }

    /**
     * minlength
     *
     * @param  int $minlength
     * @return array
     */
    public function minlength(int $minlength): array
    {
        return ['minlength' => $minlength];
    }

    /**
     * maxlength
     *
     * @param  int $maxlength
     * @return array
     */
    public function maxlength(int $maxlength): array
    {
        return ['maxlength' => $maxlength];
    }
}
