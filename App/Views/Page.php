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
     * 
     * @return never
     */
    public function show(string $page, ?int $code = null, ?string $message = '')
    {
        if (!is_null($code)) {
            http_response_code($code);
        }

        $this->pageContent = file_get_contents("templates/{$page}.bubu.php", true);
        $this->pageContent = ExtendHtmlTags::create($this)->pageContent;
        ob_start();
        echo eval('?>' . $this->pageContent);
        exit(ob_get_clean());
    }
}
