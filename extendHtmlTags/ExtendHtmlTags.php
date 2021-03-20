<?php

class ExtendHtmlTags
{

    public static $prefix = "+";

    public static function create($file)
    {
        $doc = new DOMDocument();
        $doc->loadHTMLFile($file);
        $doc = self::css($doc);
        echo $doc->saveHTML();
    }

    private static function css(DOMDocument $content): DOMDocument
    {
        var_dump(explode('+css(\'', $content->textContent));
        return $content;
    }
}

// https://www.php.net/manual/fr/domdocument.savehtml.php
// https://www.php.net/manual/en/domdocument.registernodeclass.php
// https://www.php.net/manual/fr/function.preg-replace.php
// https://www.php.net/manual/fr/function.preg-replace.php