<?php

namespace Weez\Command;

use Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Weez\Generator\Lib\MakeMysql;

class RabbitMqCommand extends BaseCommand {

    protected function configure()
    {
        $this
                ->setName('rabbit:cmd')
                ->setDescription('Generate Model Class')
                ->setDefinition(array(
                    new InputArgument('config-file', InputArgument::REQUIRED, 'Path to config file'),
                    new InputArgument('database', InputArgument::REQUIRED, 'The Database'),
                    new InputArgument('namespace', InputArgument::REQUIRED, 'The namespace.'),
                    new InputArgument('location', InputArgument::REQUIRED, 'Where to store model files'),
                    new InputOption('--tables-all', null, InputOption::VALUE_NONE, '', null),
                    new InputOption('--tables-regex', null, InputOption::VALUE_REQUIRED, '', false),
                    new InputOption('--tables-prefix', null, InputOption::VALUE_REQUIRED, '', array()),
                ))
                ->setHelp(<<<EOT
                        <info>info</info>
                        <comment>foo</comment>
                        <question>foo</question>
                        <error>foo</error>
EOT
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $database     = $input->getArgument('database');
        $namespace    = $input->getArgument('namespace');
        $location     = $input->getArgument('location');
        $configfile   = $input->getArgument('config-file');
        $tablesAll    = $input->getOption('tables-all');
        $tablesRegex  = $input->getOption('tables-regex');
        $tablesPrefix = $input->getOption('tables-prefix');

        $output->writeln(sprintf('<info>Done !!</info>'));
    }

    /**
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {

        if (!$input->getArgument('config-file')) {
            $configfile = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please set the config file path : ', function($configfile) {
                if (empty($configfile)) {
                    throw new Exception('Config path name can not be empty');
                }
                return $configfile;
            }
            );
            $input->setArgument('config-file', $configfile);
        }
        if (!$input->getArgument('database')) {
            $database = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please choose a module database : ', function($database) {
                if (empty($database)) {
                    throw new Exception('Database name can not be empty');
                }
                return $database;
            }
            );
            $input->setArgument('database', $database);
        }
        if (!$input->getArgument('namespace')) {
            $namespace = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please choose a namespace : ', function($namespace) {
                if (empty($namespace)) {
                    throw new Exception('Namespace can not be empty');
                }

                return $namespace;
            }
            );
            $input->setArgument('namespace', $namespace);
        }
        if (!$input->getArgument('location')) {
            $location = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please choose an location : ', function($location) {
                if (empty($location)) {
                    throw new Exception('Location can not be empty');
                }
                return $location;
            }
            );
            $input->setArgument('location', $location);
        }
    }

}
