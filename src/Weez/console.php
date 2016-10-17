<?php

use Weez\Command\GenerateDbModelCommand;
use Symfony\Component\Console\Application;

$console = new Application('Weez Cmd Cli', '2.0.0');
$console->add(new GenerateDbModelCommand());
$console->run();
