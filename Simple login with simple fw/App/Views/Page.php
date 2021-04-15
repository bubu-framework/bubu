<?php
namespace App\Views;
use App\ExtendHtmlTags\ExtendHtmlTags;

class Page
{

    public $pageContent;

    /**
     * @param string $page
     * @param int|null $code
     * @param string|null $message
     */
    public function show(string $page, ?int $code = null, ?string $message = '')
    {
        if (!is_null($code)) {
            http_response_code($code);
        }

        ob_start();
        require "templates/{$page}.bubu.php";
        $page = $this->pageContent = ob_get_clean();
        exit(ExtendHtmlTags::create($this)->pageContent);
    }
}
