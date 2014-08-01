<?php

namespace Weez\Core\Model\Model\DbTable;
/**
* Application Model DbTables
*
* @package Weez\Core\Model\Model
* @subpackage DbTable
* @author T.ED <teddy.dubal@gmail.com>
* @copyright ZF model generator
* @license http://framework.zend.com/license/new-bsd     New BSD License
*/

/**
* Table definition for accounts
*
* @package Weez\Core\Model\Model
* @subpackage DbTable
* @author T.ED <teddy.dubal@gmail.com>
*/
class Accounts extends TableAbstract
{
/**
* $_name - name of database table
*
* @var string
*/
protected $_name = 'accounts';

/**
* $_id - this is the primary key name
*
* @var string
*/
protected $_id = 'account_name';

protected $_sequence = true;


protected $_dependentTables = array(
        '\Weez\Core\Model\Model\DbTable\Bugs',
        '\Weez\Core\Model\Model\DbTable\Bugs',
        '\Weez\Core\Model\Model\DbTable\Bugs'
    );



}
