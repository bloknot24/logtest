<?php
namespace app\classes;
use app\interfaces\LoggerInterface;

class Add extends Info implements LoggerInterface
{
    public function emergency($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/emergency.log', $log, FILE_APPEND);
    }

    public function alert($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/alert.log', $log, FILE_APPEND);
    }

    public function critical($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/critical.log', $log, FILE_APPEND);
    }

    public function error($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/error.log', $log, FILE_APPEND);
    }

    public function warning($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/warning.log', $log, FILE_APPEND);
    }

    public function notice($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/notice.log', $log, FILE_APPEND);
    }

    public function info($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/info.log', $log, FILE_APPEND);
    }

    public function debug($message, $context = [])
    {
        $log = parent::addInfo($message, $context = []);
        file_put_contents('logs/debug.log', $log, FILE_APPEND);
    }
}
