<?php

namespace Weez\Core\Model\Model;
/**
* Application Models
*
* @package Weez\Core\Model\Model
* @subpackage Model
* @author T.ED <teddy.dubal@gmail.com>
* @copyright ZF model generator
* @license http://framework.zend.com/license/new-bsd     New BSD License
*/


/**
* 
*
* @package Weez\Core\Model\Model
* @subpackage Model
* @author T.ED <teddy.dubal@gmail.com>
*/
class Accounts extends ModelAbstract
{

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_AccountName;



/**
* Dependent relation bugs_ibfk_1
* Type: One-to-Many relationship
*
* @var Weez\Core\Model\Model\Bugs
*/
protected $_BugsByReportedBy;

/**
* Dependent relation bugs_ibfk_2
* Type: One-to-Many relationship
*
* @var Weez\Core\Model\Model\Bugs
*/
protected $_BugsByAssignedTo;

/**
* Dependent relation bugs_ibfk_3
* Type: One-to-Many relationship
*
* @var Weez\Core\Model\Model\Bugs
*/
protected $_BugsByVerifiedBy;

/**
* Sets up column and relationship lists
*/
public function __construct($adapter = null)
{
parent::init();
if (null != $adapter){
$this->getMapper()->getDbTable(array('db' => $adapter));
}
$this->setColumnsList(array(
'account_name'=>'AccountName',
));

$this->setParentList(array(
));

$this->setDependentList(array(
'BugsIbfk1' => array(
'property' => 'BugsByReportedBy',
'table_name' => 'Bugs',
),
'BugsIbfk2' => array(
'property' => 'BugsByAssignedTo',
'table_name' => 'Bugs',
),
'BugsIbfk3' => array(
'property' => 'BugsByVerifiedBy',
'table_name' => 'Bugs',
),
));
}

/**
* Sets column account_name
*
* @param string $data
* @return Weez\Core\Model\Model\Accounts
*/
public function setAccountName($data)
{
$this->_AccountName = $data;
return $this;
}

/**
* Gets column account_name
*
* @return string
*/
public function getAccountName()
{
return $this->_AccountName;
}

/**
* Sets dependent relations bugs_ibfk_1
*
* @param array $data An array of Weez\Core\Model\Model\Bugs
* @return Weez\Core\Model\Model\Accounts
*/
public function setBugsByReportedBy(array $data)
{
$this->_BugsByReportedBy = array();

foreach ($data as $object) {
$this->addBugsByReportedBy($object);
}

return $this;
}

/**
* Sets dependent relations bugs_ibfk_1
*
* @param Weez\Core\Model\Model\Bugs $data
* @return Weez\Core\Model\Model\Accounts
*/
public function addBugsByReportedBy(\Weez\Core\Model\Model\Bugs $data)
{
$this->_BugsByReportedBy[] = $data;
return $this;
}

/**
* Gets dependent bugs_ibfk_1
*
* @param boolean $load Load the object if it is not already
* @return array The array of Weez\Core\Model\Model\Bugs
*/
public function getBugsByReportedBy($load = true)
{
if ($this->_BugsByReportedBy === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk1', $this);
}

return $this->_BugsByReportedBy;
}

/**
* Sets dependent relations bugs_ibfk_2
*
* @param array $data An array of Weez\Core\Model\Model\Bugs
* @return Weez\Core\Model\Model\Accounts
*/
public function setBugsByAssignedTo(array $data)
{
$this->_BugsByAssignedTo = array();

foreach ($data as $object) {
$this->addBugsByAssignedTo($object);
}

return $this;
}

/**
* Sets dependent relations bugs_ibfk_2
*
* @param Weez\Core\Model\Model\Bugs $data
* @return Weez\Core\Model\Model\Accounts
*/
public function addBugsByAssignedTo(\Weez\Core\Model\Model\Bugs $data)
{
$this->_BugsByAssignedTo[] = $data;
return $this;
}

/**
* Gets dependent bugs_ibfk_2
*
* @param boolean $load Load the object if it is not already
* @return array The array of Weez\Core\Model\Model\Bugs
*/
public function getBugsByAssignedTo($load = true)
{
if ($this->_BugsByAssignedTo === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk2', $this);
}

return $this->_BugsByAssignedTo;
}

/**
* Sets dependent relations bugs_ibfk_3
*
* @param array $data An array of Weez\Core\Model\Model\Bugs
* @return Weez\Core\Model\Model\Accounts
*/
public function setBugsByVerifiedBy(array $data)
{
$this->_BugsByVerifiedBy = array();

foreach ($data as $object) {
$this->addBugsByVerifiedBy($object);
}

return $this;
}

/**
* Sets dependent relations bugs_ibfk_3
*
* @param Weez\Core\Model\Model\Bugs $data
* @return Weez\Core\Model\Model\Accounts
*/
public function addBugsByVerifiedBy(\Weez\Core\Model\Model\Bugs $data)
{
$this->_BugsByVerifiedBy[] = $data;
return $this;
}

/**
* Gets dependent bugs_ibfk_3
*
* @param boolean $load Load the object if it is not already
* @return array The array of Weez\Core\Model\Model\Bugs
*/
public function getBugsByVerifiedBy($load = true)
{
if ($this->_BugsByVerifiedBy === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk3', $this);
}

return $this->_BugsByVerifiedBy;
}

/**
* Returns the mapper class for this model
*
* @return Weez\Core\Model\Model\Mapper\Accounts
*/
public function getMapper()
{
if ($this->_mapper === null) {
$this->setMapper(new \Weez\Core\Model\Model\Mapper\Accounts());
}

return $this->_mapper;
}

/**
* Deletes current row by deleting the row that matches the primary key
*
* @see Weez\Core\Model\Model\Mapper\Accounts::delete
* @return int|boolean Number of rows deleted or boolean if doing soft delete
*/
public function deleteRowByPrimaryKey()
{
if ($this->getAccountName() === null) {
throw new \Exception('Primary Key does not contain a value');
}

return $this->getMapper()
->getDbTable()
->delete('account_name = ' .
$this->getMapper()
->getDbTable()
->getAdapter()
->quote($this->getAccountName()));
}
}
