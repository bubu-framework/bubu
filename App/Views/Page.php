<?php
namespace App\Views;

use App\Views\Exception\PageException;
use Bubu\Exception\ShowException;
use Bubu\ExtendHtmlTags\ExtendHtmlTags;


class Page
{

    public string  $pageContent;
    public ?int    $httpCode    = null;
    public ?string $httpMessage = null;
    public mixed   $pageMessage;

    /**
     * show page
     * 
     * @param string $page
     * @param int|null $code
     * @param string|null $message
     * 
     * @return never
     */
    public function show(string $page)
    {
        try {
            if (!is_null($this->httpMessage)) {
                if (is_null($this->httpCode)) {
                    throw new PageException('HTTP Code is required with HTTP Message!');
                } else {
                    header("HTTP/1.1 {$this->httpCode} {$this->httpMessage}");
                }
            } elseif (!is_null($this->httpCode)) {
                $codes = json_decode(file_get_contents($_ENV['HTTP_CODE_FILE'] . 'httpMessages.json'), true);

                if (array_key_exists($this->httpCode, $codes)) {
                    header("HTTP/1.1 {$this->httpCode} {$codes[$this->httpCode]}");
                } else {
                    http_response_code($this->httpCode);
                }
            }
        } catch (PageException $e) {
            ShowException::SR($e);
        }

        $this->pageContent = file_get_contents("templates/{$page}.bubu.php", true);
        $this->pageContent = ExtendHtmlTags::create($this)->pageContent;
        ob_start();
        echo eval('?>' . $this->pageContent);
        exit(ob_get_clean());
    }
    
    /**
     * http code for page
     *
     * @param  int $httpCode
     * @return self
     */
    public function httpCode(int $httpCode): self
    {
        $this->httpCode = $httpCode;
        return $this;
    }
    
    /**
     * httpMessage
     *
     * @param  string $httpMessage
     * @return self
     */
    public function httpMessage(string $httpMessage): self
    {
        $this->httpMessage = $httpMessage;
        return $this;
    }

    /**
     * pageMessage
     *
     * @param  mixed $pageMessage
     * @return self
     */
    public function pageMessage(mixed $pageMessage): self
    {
        $this->pageMessage = $pageMessage;
        return $this;
    }
}
