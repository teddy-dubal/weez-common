<?php

use Symfony\Component\Console\Application;
use Weez\Command\GenerateDbModelCommand;
use Weez\Command\RabbitMqCommand;

$console = new Application('Weez Cmd Cli', '1.1.0');
$console->add(new GenerateDbModelCommand());
$console->add(new RabbitMqCommand());
$console->run();
