<?php

namespace app\classes;

class Info
{
    public function addInfo($message, $context = [])
    {
        $info = [
            'Date: ' . date('d-m-Y H:i:s') . ' |',
            'Message: ' . $message
        ];
        $info = implode(' ', $info);
        return $log = $info . "\n";
    }
}
