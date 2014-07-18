<?php

namespace Weez\ZendModelGenerator\Lib;

class MakeDblib extends MakeMssql
{

    protected function getPDOString($host, $port = 1433, $dbname)
    {
        $seperator = ':';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $seperator = ',';
        }

        return "dblib:host=$host$seperator$port;dbname=$dbname";
    }

}
