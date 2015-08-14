<?php
// create adapter
$logstashAdapter = new LogstashAdapter();
// create log writer object
$writer = new TCPLogWriter($logstashAdapter);
// set formatter
$writer->setFormatter(new LogstashFormatter());
// add writer to log mechanism
SS_Log::add_writer(new TCPLogWriter($logstashAdapter), SS_Log::DEBUG, '<=');