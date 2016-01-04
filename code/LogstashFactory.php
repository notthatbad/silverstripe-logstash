<?php


class LogstashFactory
{
    /**
     * Construct a Zend_Log writer
     *
     * @param  ILogAdapter $adapter
     * @param string $protocol the network protocol (eg. 'udp' or 'tcp')
     * @return Zend_Log_Writer_Abstract
     */
    public static function factory($adapter, $protocol)
    {
        return new NetworkLogWriter($adapter, $protocol);
    }

    public static function log_level()
    {
        $configured_level = Config::inst()->get('LogstashAdapter', 'Level');
        switch ($configured_level) {
            case 'Debug':
                return SS_Log::DEBUG;
            case 'Info':
                return SS_Log::INFO;
            case 'Warn':
                return SS_Log::WARN;
            case 'Error':
                return SS_Log::ERR;
        }
    }
}
