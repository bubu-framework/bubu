<?php

namespace Bubu\Flash;

use Bubu\Http\Session\Session;

class Flash
{

    private static $validBg = '#DFFFD8';
    private static $validText = '#3C763D';
    private static $infoBg = '#D9EDF7';
    private static $infoText = '#31708F';
    private static $alertBg = '#FFB149';
    private static $alertText = '#FF5D00';
    private static $errorBg = '#FFABAB';
    private static $errorText = '#FF3331';

    public static function valid(string $message): void
    {
        Session::push('flash', ['valid' => $message]);
    }

    public static function info(string $message): void
    {
        Session::push('flash', ['info' => $message]);
    }

    public static function alert(string $message): void
    {
        Session::push('flash', ['alert' => $message]);
    }

    public static function error(string $message): void
    {
        Session::push('flash', ['error' => $message]);
    }

    public static function other(string $message, string $colorText, string $backgroundColor): void
    {
        Session::push('flash',
            [
                'other' => [
                    'message' => $message,
                    'colorText' => $colorText,
                    'colorBackground' => $backgroundColor
                ]
            ]
        );
    }

    public static function generate()
    {
        if (is_null(Session::get('flash'))) {
            return '';
        }

        $flash = <<<HTML
            <style>
                .flash {
                    margin: 10px;
                    padding: 10px;
                    border-radius: 75px;
                    font-weight: 1000;
                    font-size: 18px;
                }
            </style>
        HTML;
        foreach (Session::get('flash') as $key => $value) {
            switch ($key) {
                case 'valid':
                    $textColor = self::$validText;
                    $bg = self::$validBg;
                    $iconCode = '&#10003';
                    break;
                case 'info':
                    $textColor = self::$infoText;
                    $bg = self::$infoBg;
                    $iconCode = '&#128712';
                    break;
                case 'alert':
                    $textColor = self::$alertText;
                    $bg = self::$alertBg;
                    $iconCode = '&#9888';
                    break;
                case 'error':
                    $textColor = self::$errorText;
                    $bg = self::$errorBg;
                    $iconCode = '&#10754';
                    break;
                case 'other':
                    $textColor = $value['colorText'];
                    $bg = $value['colorBackground'];
                    $value = $value['message'];
                    $iconCode = '&#128712';
                    break;
            }

            foreach ((array) $value as $messages) {
                $flash .= <<<HTML
                    <div
                        class="flash"
                        style="
                            color: {$textColor};
                            border-color: {$textColor};
                            background: {$bg};
                        "
                    >
                        <p onclick="this.remove()">&cross;</p>
                        <p>
                            <span style="margin: 0 10px; font-size: 1.5em; vertical-align: sub">{$iconCode}</span>
                            {$messages}
                        </p>
                    </div>
                HTML;
            }
        }
        Session::delete('flash');
        return $flash;
    }
}
