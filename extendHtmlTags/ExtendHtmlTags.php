<?php

class ExtendHtmlTags
{

    public static $prefix = "+";
    public static $types = [
        'css' => 'style',
        'js' => 'script'
    ];

    public static function create($file)
    {
        $doc = file_get_contents($file);
        $doc = self::tags($doc);
        $doc = self::var($doc);
        echo $doc;
    }

    private static function tags(string $dom): string
    {
        foreach (self::$types as $key => $value) {
            $dom = preg_replace_callback(
                "/(\\" . self::$prefix . $key . "\('([^']+)'\))+/im",
                function ($match) use ($key, $value) {
                    $str = "<{$value}>\n";
                    $str .= file_get_contents($match[2] . "." . $key);
                    $str .= "\n</{$value}>";
                    return $str;
                },
                $dom
            );
        }
        return $dom;
    }

    private static function var(string $dom): string
    {
        $dom = preg_replace_callback("/((\|){2}(.+)(\|){2})+/m", function ($match) {
        }, $dom);
        return $dom;
    }
}