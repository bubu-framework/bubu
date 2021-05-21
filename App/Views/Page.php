<?php
namespace App\Views;

use Bubu\ExtendHtmlTags\ExtendHtmlTags;


class Page
{

    public $pageContent;

    /**
     * @param string $page
     * @param int|null $code
     * @param string|null $message
     * 
     * @return never
     */
    public function show(string $page, ?int $code = null, ?string $message = '', $sessionCache = null)
    {
        if (!is_null($code)) {
            http_response_code($code);
        }

        if (is_null($sessionCache)) {
            $sessionCache = $_ENV['HTTP_EXPIRES'];
        }

        session_cache_expire($sessionCache);
        session_cache_limiter($_ENV['SESSION_CACHE_LIMITER']);

        $this->pageContent = file_get_contents("templates/{$page}.bubu.php", true);
        $this->pageContent = ExtendHtmlTags::create($this)->pageContent;
        ob_start();
        echo eval('?>' . $this->pageContent);
        exit(ob_get_clean());
    }
}
