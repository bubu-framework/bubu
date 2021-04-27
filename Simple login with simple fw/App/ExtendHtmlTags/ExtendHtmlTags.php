<?php
namespace App\ExtendHtmlTags;

use App\Views\Page;

class ExtendHtmlTags
{

    public static $prefix = '+';
    public static $types = [
        'css' => '<link attr rel="stylesheet" href="--link--.css"/>',
        'js' => '<script attr src="--link--.js"></script>',
        'picture' => '<img attr src="--link"/>'
    ];

    /**
     * @param Page $page
     * 
     * @return Page
     */
    public static function create(Page $page): Page
    {
        $page = self::include($page);
        //$page = self::variable($page);
        $page = self::tags($page);
        return $page;
    }

    /**
     * @param Page $page
     * 
     * @return Page
     */
    private static function include(Page $page): Page
    {
        $regex = "/(\\" . self::$prefix . "include\('([^']+)'\))+/im";
        while (preg_match_all($regex, $page->pageContent)) {
            $page->pageContent = preg_replace_callback(
                $regex,
                function ($match) {
                    return file_get_contents($_ENV['INCLUABLE'] . $match[2] . '.bubu.php');
                },
                $page->pageContent
            );
        }
        return $page;
    }

    /**
     * @param Page $page
     * 
     * @return Page
     */
    private static function variable(Page $page): Page
    {
        $page->pageContent = preg_replace_callback(
            "/(\+\|{2}(.+)\|{2})+/m",
            function($match) {
                return "<?= htmlspecialchars($match[2]) ?>";
            },
            $page->pageContent
        );
        return $page;
    }

    /**
     * @param Page $page
     * 
     * @return Page
     */
    private static function tags(Page $page): Page
    {
        foreach (self::$types as $key => $value) {
            $page->pageContent = preg_replace_callback(
                "/(\\" . self::$prefix . $key . "\('([^']+)'\))(\|.+)*+/im",
                function ($match) use ($key, $value) {
                    $tag = str_replace('--link--', $_ENV['ASSETS'] . "/{$key}/" . $match[2], $value);
                    $tag = str_replace('attr', str_replace('|', ' ', $match[3] ?? ''), $tag);
                    return $tag;
                },
                $page->pageContent
            );
        }
        return $page;
    }
}