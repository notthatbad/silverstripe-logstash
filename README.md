Logstash adapter for Silverstripe
=================================

This module makes it possible to log all data into a logstash-based system.

## Setup

Write somewhere in your config:

```php
<?php
// create adapter
$logstashAdapter = new LogstashAdapter();
// create log writer object
$writer = LogstashFactory::factory($logstashAdapter, NetworkLogWriter::UDP);
// set formatter
$writer->setFormatter(new LogstashFormatter());
// add writer to log mechanism
SS_Log::add_writer($writer, LogstashFactory::log_level(), '<=');
```

Documentation for logstash tcp input: https://www.elastic.co/guide/en/logstash/current/plugins-inputs-tcp.html

## TODO

 * we should add a type or identifier for the application, that can be configured
 * the output with the server variables is okay, but still needs some improvements
 * the stack trace should only included in debug mode