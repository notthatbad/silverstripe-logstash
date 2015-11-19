<?php

require_once THIRDPARTY_PATH . '/Zend/Log/Writer/Abstract.php';

class NetworkLogWriter extends Zend_Log_Writer_Abstract {

    const UDP = "udp";
    const TCP = "tcp";

    /**
     * @var ILogAdapter
     */
    protected $adapter = null;
    /**
     * @var string
     */
    protected $protocol;

    /**
     * @param ILogAdapter $adapter
     * @param string $protocol
     */
    public function __construct($adapter, $protocol) {
        $this->adapter = $adapter;
        $this->protocol = $protocol;
    }

    /**
     * Write a message to the log.
     *
     * @param  array $event log data event
     * @return void
     */
    protected function _write($event) {
        // format data
        if(!$this->_formatter) {
            $formatter = new LogstashFormatter();
            $this->setFormatter($formatter);
        }

        $formattedData = $this->_formatter->format($event);
        $socket = $this->createSocket();
        var_dump($formattedData);
        if($socket !== false) {
            fwrite($socket, $formattedData);
            fflush($socket);
            fclose($socket);
        } else {
            // report into local error logs, that the socket is not reachable from this host.
            error_log("{$this->protocol} socket for logging is not reachable");
        }
    }

    /**
     * @return resource
     */
    protected function createSocket() {
        $fp = @fsockopen("{$this->protocol}://{$this->adapter->host()}", $this->adapter->port());
        return $fp;
    }

    /**
     * Construct a Zend_Log driver
     *
     * @param  ILogAdapter $adapter
     * @return Zend_Log_FactoryInterface
     */
    static public function factory($adapter) {
        return new NetworkLogWriter($adapter, self::UDP);
    }
}