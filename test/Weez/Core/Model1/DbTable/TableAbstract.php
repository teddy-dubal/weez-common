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
* Abstract class that is extended by all tables
*
* @package Weez\Core\Model\Model
* @subpackage DbTable
* @author T.ED <teddy.dubal@gmail.com>
*/
abstract class TableAbstract extends \Zend_Db_Table_Abstract
{
/**
* $_name - Name of database table
*
* @return string
*/
protected $_name;

/**
* $_id - The primary key name(s)
*
* @return string|array
*/
protected $_id;

/**
* Returns the primary key column name(s)
*
* @return string|array
*/
public function getPrimaryKeyName()
{
return $this->_id;
}

/**
* Returns the table name
*
* @return string
*/
public function getTableName()
{
return $this->_name;
}

/**
* Returns the number of rows in the table
*
* @return int
*/
public function countAllRows()
{
$query = $this->select()->from($this->_name, 'count(*) AS all_count');
$numRows = $this->fetchRow($query);

return $numRows['all_count'];
}

/**
* Returns the number of rows in the table with optional WHERE clause
*
* @param $where mixed Where clause to use with the query
* @return int
*/
public function countByQuery($where = '')
{
$query = $this->select()->from($this->_name, 'count(*) AS all_count');

if (! empty($where) && is_string($where))
{
$query->where($where);
}
elseif(is_array($where) && isset($where[0]))
{
/**
* Adds a where/and statement for each of the inner arrays, and checks if it is a PDO escape statement or a string
*/
foreach($where as $i => $v)
{
if(isset($v[1]) && is_string($v[0]) && count($v) == 2)
{
$query->where($v[0], $v[1]);
}
elseif(is_string($v))
{
$query->where($v);
}
}
}
else
{
throw new \Exception("You must pass integer indexes on the select statement array.");
}


$row = $this->getAdapter()->query($query)->fetch(PDO::FETCH_ASSOC);

return $row['all_count'];
}

/**
* Generates a query to fetch a list with the given parameters
*
* @param $where mixed Where clause to use with the query
* @param $order string Order clause to use with the query
* @param $count int Maximum number of results
* @param $offset int Offset for the limited number of results
* @return \Zend\Db\Sql\Select
*/
public function fetchList($where = null, $order = null, $count = null, $offset = null)
{
$select = $this->select()
->order($order)
->limit($count, $offset);

if (! empty($where) && is_string($where))
{
$select->where($where);
}
elseif(is_array($where) && isset($where[0]))
{
/**
* Adds a where/and statement for each of the inner arrays, and checks if it is a PDO escape statement or a string
*/
foreach($where as $i => $v)
{
if(isset($v[1]) && is_string($v[0]) && count($v) == 2)
{
$select->where($v[0], $v[1]);
}
elseif(is_string($v))
{
$select->where($v);
}
}
}
else
{
throw new \Exception("You must pass integer indexes on the select statement array.");
}

return $select;
}

}
