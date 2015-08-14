<?php

require_once THIRDPARTY_PATH . '/Zend/Log/Formatter/Interface.php';

class LogstashFormatter implements Zend_Log_Formatter_Interface {

    /**
     * Formats data into a single line to be written by the writer.
     *
     * @param  array $event event data with `timestamp`, `priority`, `priorityName` and `message`.
     * @return string formatted line to write to the log
     */
    public function format($event) {
        $string = json_encode($event) . PHP_EOL;
        return $string;
    }
}