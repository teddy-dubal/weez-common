<?php

require __DIR__ . '/../../../vendor/autoload.php';

global $is_debug;
$is_debug = false;
$c        = new Pimple\Container();
$ck       = isset($argv[1]) ? $argv[1] : 'local';
$av       = new Weez\Rabbitmq\RabbitMQ($c);
$consumer = $av->getConsumer($ck, $ck);
$consumer->consume(0);

