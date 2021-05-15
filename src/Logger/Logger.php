<?php

namespace Bubu\Logger;

use Carbon\Carbon;
use LogicException;

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
    public static function addLog(string $log): bool
    {
        $date = Carbon::now($_ENV['TIMEZONE']);
        $textToAppend = "[{$date}]: {$log}";
        if (
            file_put_contents(
                self::$logPath . 'errors.log',
                $textToAppend . PHP_EOL,
                FILE_APPEND | LOCK_EX | FILE_USE_INCLUDE_PATH
            )
            === false
        ) {
            throw new LogicException('An error encountered');
        } else {
            return true;
        }
    }
    
    /**
     * @return bool
     */
    public static function cleanLog(): bool
    {
        if (
            file_put_contents(
                self::$logPath . 'errors.log',
                null,
                FILE_USE_INCLUDE_PATH
            )
            === false
        ) {
            throw new LogicException('An error encountered');
        } else {
            return true;
        }
    }

    /**
     * @param string $logName
     * @return string
     */
    public static function readLog(string $logName = 'errors'): string
    {
        $logName = self::$logPath . "{$logName}.log";
        $content = file_get_contents(
            $logName,
            FILE_USE_INCLUDE_PATH
        );
        if ($content === false) {
            throw new LogicException('An error encountered');
        } else {
            return $content;
        }
    }

    /**
     * @param string|null $logName
     * @return bool
     */
    public static function saveLog(?string $logName = null): bool
    {
        if (is_null($logName)) {
            $logName = Carbon::now($_ENV['TIMEZONE']);
            $logName = str_replace(':', '-', $logName);
        }

        if (copy(self::$logPath . 'errors.log', self::$logPath . "{$logName}.log")) {
            return true;
        } else {
            throw new LogicException('An error encountered');
        }
    }

    /**
     * @return boolean
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
