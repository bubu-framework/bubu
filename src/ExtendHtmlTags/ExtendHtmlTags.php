<?php
namespace Bubu\ExtendHtmlTags;

use Bubu\View\View;
use Bubu\Flash\Flash;

class ExtendHtmlTags
{

    public static $prefix = '+';
    public static $types = [
        'css' => '<link attr rel="stylesheet" href="--link--.css"/>',
        'js' => '<script attr src="--link--.js"></script>',
        'picture' => '<img attr src="--link--"/>',
    ];

    /**
     * @param View $view
     * 
     * @return View
     */
    public static function create(View $view): View
    {
        $view = self::include($view);
        $view = self::variable($view);
        $view = self::tags($view);
        $view = self::flash($view);
        return $view;
    }

    /**
     * @param View $view
     * 
     * @return View
     */
    private static function include(View $view): View
    {
        $regex = "/(\\" . self::$prefix . "include\('([^']+)'\))+/im";
        while (preg_match_all($regex, $view->pageContent)) {
            $view->pageContent = preg_replace_callback(
                $regex,
                function ($match) {
                    return file_get_contents($_ENV['INCLUABLE'] . $match[2] . '.bubu.php');
                },
                $view->pageContent
            );
        }
        return $view;
    }

    /**
     * @param View $view
     * 
     * @return View
     */
    private static function variable(View $view): View
    {
        $view->pageContent = preg_replace_callback(
            "/(\\" . self::$prefix ."\|{2}(.+)\|{2})+/m",
            function($match) {
                return "<?= htmlspecialchars($$match[2]) ?>";
            },
            $view->pageContent
        );
        $view->pageContent = preg_replace_callback(
            "/(\\" . self::$prefix ."\|\!(.+)\!\|)+/m",
            function($match) {
                return "<?= $$match[2] ?>";
            },
            $view->pageContent
        );
        return $view;
    }

    /**
     * @param View $view
     * 
     * @return View
     */
    private static function tags(View $view): View
    {
        foreach (self::$types as $key => $value) {
            $view->pageContent = preg_replace_callback(
                "/(\\" . self::$prefix . $key . "\('([^']+)'\))(\|.+)*+/im",
                function ($match) use ($key, $value) {
                    $tag = str_replace('--link--', $_ENV['ASSETS'] . "/{$key}/" . $match[2], $value);
                    $tag = str_replace('attr', str_replace('|', ' ', $match[3] ?? ''), $tag);
                    return $tag;
                },
                $view->pageContent
            );
        }
        return $view;
    }

    /**
     * @param View $view
     * 
     * @return View
     */
    private static function flash(View $view): View
    {
        $view->pageContent = preg_replace_callback(
            "/(\\" . self::$prefix ."flash)+/im",
            function() {
                return Flash::generate();
            },
            $view->pageContent
        );
        return $view;
    }
}