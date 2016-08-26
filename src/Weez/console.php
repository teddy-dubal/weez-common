<?php

use Symfony\Component\Console\Application;
use Weez\Command\GenerateDbModelCommand;

$console = new Application('Weez Cmd Cli', '1.1.0');
$console->add(new GenerateDbModelCommand());
$console->run();
