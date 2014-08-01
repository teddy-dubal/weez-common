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
* Table definition for bugs
*
* @package Weez\Core\Model\Model
* @subpackage DbTable
* @author T.ED <teddy.dubal@gmail.com>
*/
class Bugs extends TableAbstract
{
/**
* $_name - name of database table
*
* @var string
*/
protected $_name = 'bugs';

/**
* $_id - this is the primary key name
*
* @var int
*/
protected $_id = 'bug_id';

protected $_sequence = true;

protected $_referenceMap = array(
        'BugsIbfk1' => array(
          	'columns' => 'reported_by',
            'refTableClass' => 'Weez\Core\Model\Model\DbTable\Accounts',
            'refColumns' => 'account_name'
        ),
        'BugsIbfk2' => array(
          	'columns' => 'assigned_to',
            'refTableClass' => 'Weez\Core\Model\Model\DbTable\Accounts',
            'refColumns' => 'account_name'
        ),
        'BugsIbfk3' => array(
          	'columns' => 'verified_by',
            'refTableClass' => 'Weez\Core\Model\Model\DbTable\Accounts',
            'refColumns' => 'account_name'
        )
    );
protected $_dependentTables = array(
        '\Weez\Core\Model\Model\DbTable\BugsProducts'
    );



}
