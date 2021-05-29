<?php

namespace Bubu\DevTools;

class Dump
{
    public static function dump(mixed ...$dump)
    {
        foreach ((array) $dump as $var) {
            echo '----- DUMP -----';
            echo '<pre>';
            var_dump(
                $var,
            );
            echo '</pre>';
        }
    }
}
