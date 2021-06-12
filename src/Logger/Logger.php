<?php

namespace Bubu\Logger;

use Carbon\Carbon;

class Logger
{
    /**
     * @var string $logPath
     */
    private static string $logPath = __DIR__ . DIRECTORY_SEPARATOR . 'Logs' . DIRECTORY_SEPARATOR;

    /**
     * @param string $log
     * @return bool
     */
    public static function addLog(string $log, string $file = 'errors'): bool
    {
        $date = Carbon::now($_ENV['TIMEZONE']);
        $textToAppend = "[{$date}]: {$log}";
        if (
            file_put_contents(
                self::$logPath . $file . '.log',
                $textToAppend . PHP_EOL,
                FILE_APPEND | LOCK_EX | FILE_USE_INCLUDE_PATH
            )
            === false
        ) {
            throw new LoggerException('An error encountered');
        } else {
            return true;
        }
    }
    
    /**
     * @param string $file
     * @return bool
     */
    public static function cleanLog(string $file = 'errors'): bool
    {
        if (
            file_put_contents(
                self::$logPath . $file . '.log',
                null,
                FILE_USE_INCLUDE_PATH
            )
            === false
        ) {
            throw new LoggerException('An error encountered');
        } else {
            return true;
        }
    }

    /**
     * @param string $file
     * @return string
     */
    public static function readLog(string $file = 'errors'): string
    {
        $file = self::$logPath . "{$file}.log";
        $content = file_get_contents(
            $file,
            FILE_USE_INCLUDE_PATH
        );
        if ($content === false) {
            throw new LoggerException('An error encountered');
        } else {
            return $content;
        }
    }

    /**
     * @param string|null $logName
     * @param string $file
     * @return bool
     */
    public static function saveLog(?string $logName = null, string $file = 'errors'): bool
    {
        if (is_null($logName)) {
            $logName = Carbon::now($_ENV['TIMEZONE']);
            $logName = str_replace(':', '-', $logName);
        }

        if (copy(self::$logPath . $file . '.log', self::$logPath . "{$logName}.log")) {
            return true;
        } else {
            throw new LoggerException('An error encountered');
        }
    }

    /**
     * @return bool
     */
    public static function deleteAllLog(): bool
    {
        $files = glob(self::$logPath . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        return true;
    }
}
