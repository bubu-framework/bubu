<?php

namespace Bubu\Utils\Form;

class Label
{
    /**
     * for
     *
     * @param  string $for
     * @return array
     */
    public function for(string $for): array
    {
        return ['for' => $for];
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
