<?php
// create adapter
$logstashAdapter = new LogstashAdapter();
// create log writer object
$writer = LogstashFactory::factory($logstashAdapter, NetworkLogWriter::UDP);
// set formatter
$writer->setFormatter(new LogstashFormatter());
// add writer to log mechanism
SS_Log::add_writer($writer, LogstashFactory::log_level(), '<=');