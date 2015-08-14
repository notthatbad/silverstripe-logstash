Logstash adapter for Silverstripe
=================================

This module makes it possible to log all data into a logstash-based system.

Documentation for logstash tcp input: https://www.elastic.co/guide/en/logstash/current/plugins-inputs-tcp.html

## TODO

 * we should add a type or identifier for the application, that can be configured
 * the output with the server variables is okay, but still needs some improvements
 * the stack trace should only included in debug mode