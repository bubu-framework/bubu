<?php

require 'ExtendHtmlTags.php';

class Controller
{
    public static function generate()
    {
        ExtendHtmlTags::create('file.php');
    }
}