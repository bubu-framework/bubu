<?php

class ExtendHtmlTags
{

    public static $prefix = "+";

    public static function create($file)
    {
        $doc = new DOMDocument();
        $doc->loadHTMLFile($file);
        $doc->textContent = self::css($doc->textContent);
        echo $doc->saveHTML();
    }

    private static function css(string $dom): string
    {
        $dom = preg_replace_callback("/(\+css\('([^']+)'\))+/im", function ($match) {

            $str = "<style>\n";
            $str .= file_get_contents($match[2] . ".css");
            $str .= "\n</style>";
            return $str;
        }, $dom);
        return $dom;
    }
}

// https://www.php.net/manual/fr/domdocument.savehtml.php
// https://www.php.net/manual/en/domdocument.registernodeclass.php
// https://www.php.net/manual/fr/function.preg-replace.php
// https://www.php.net/manual/fr/function.preg-replace.php