<?php

namespace Weez\ZendModelGenerator\Lib;

class MakeSqlsrv /* extends MakeMssql */
{

    protected function getPDOString($host, $port, $dbname)
    {
        $seperator = ':';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $seperator = ',';
        }

        return "sqlsrv:server=$host; port=$port; Database=$dbname";
    }

}
