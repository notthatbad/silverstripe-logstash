<?php

/**
 * Class LogstashAdapter
 */
class LogstashAdapter implements ILogAdapter
{

    /**
     * @return string
     */
    public function host()
    {
        return Config::inst()->get('LogstashAdapter', 'Host');
    }

    /**
     * @return int
     */
    public function port()
    {
        return Config::inst()->get('LogstashAdapter', 'Port');
    }
}
