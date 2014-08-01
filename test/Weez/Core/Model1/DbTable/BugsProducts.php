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
* Table definition for bugs_products
*
* @package Weez\Core\Model\Model
* @subpackage DbTable
* @author T.ED <teddy.dubal@gmail.com>
*/
class BugsProducts extends TableAbstract
{
/**
* $_name - name of database table
*
* @var string
*/
protected $_name = 'bugs_products';

/**
* $_id - this is the primary key name
*
* @var array
*/
protected $_id = array('bug_id', 'product_id');

protected $_sequence = false;

protected $_referenceMap = array(
        'BugsProductsIbfk1' => array(
          	'columns' => 'bug_id',
            'refTableClass' => 'Weez\Core\Model\Model\DbTable\Bugs',
            'refColumns' => 'bug_id'
        ),
        'BugsProductsIbfk2' => array(
          	'columns' => 'product_id',
            'refTableClass' => 'Weez\Core\Model\Model\DbTable\Products',
            'refColumns' => 'product_id'
        )
    );




}
