<?php

require_once THIRDPARTY_PATH . '/Zend/Log/Writer/Abstract.php';

class TCPLogWriter extends Zend_Log_Writer_Abstract {

    /**
     * @var ILogAdapter
     */
    protected $adapter = null;

    /**
     * @param ILogAdapter $adapter
     */
    public function __construct($adapter) {
        $this->adapter = $adapter;
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

        if($socket !== false) {
            fwrite($socket, $formattedData);
            fflush($socket);
            fclose($socket);
        } else {
            // report into local error logs, that the socket is not reachable from this host.
            error_log("TCP socket for logging is not reachable");
        }
    }

    /**
     * @return resource
     */
    protected function createSocket() {
        $fp = @fsockopen("tcp://{$this->adapter->host()}", $this->adapter->port());
        return $fp;
    }

    /**
     * Construct a Zend_Log driver
     *
     * @param  ILogAdapter $adapter
     * @return Zend_Log_FactoryInterface
     */
    static public function factory($adapter) {
        return new TCPLogWriter($adapter);
    }
}