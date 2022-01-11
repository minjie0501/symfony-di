<?php 
namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MonoLogger
{
    public function do(string $text):void
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('./log.info', Logger::INFO));

        // add records to the log
        $log->info($text);
    }
}