<?php

namespace Bubu\Utils\Form;

class Output
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
     * name
     *
     * @param  string $name
     * @return array
     */
    public function name(string $name): array
    {
        return ['name' => $name];
    }
}
