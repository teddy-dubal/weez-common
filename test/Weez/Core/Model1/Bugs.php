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
class Bugs extends ModelAbstract
{

/**
* Database var type int(11)
*
* @var int
*/
protected $_BugId;

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_BugDescription;

/**
* Database var type varchar(20)
*
* @var string
*/
protected $_BugStatus;

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_ReportedBy;

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_AssignedTo;

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_VerifiedBy;


/**
* Parent relation bugs_ibfk_1
*
* @var Weez\Core\Model\Model\Accounts
*/
protected $_Accounts;

/**
* Parent relation bugs_ibfk_2
*
* @var Weez\Core\Model\Model\Accounts
*/
protected $_Accounts;

/**
* Parent relation bugs_ibfk_3
*
* @var Weez\Core\Model\Model\Accounts
*/
protected $_Accounts;


/**
* Dependent relation bugs_products_ibfk_1
* Type: One-to-Many relationship
*
* @var Weez\Core\Model\Model\BugsProducts
*/
protected $_BugsProducts;

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
'bug_id'=>'BugId',
'bug_description'=>'BugDescription',
'bug_status'=>'BugStatus',
'reported_by'=>'ReportedBy',
'assigned_to'=>'AssignedTo',
'verified_by'=>'VerifiedBy',
));

$this->setParentList(array(
'BugsIbfk1'=> array(
'property' => 'Accounts',
'table_name' => 'Accounts',
),
'BugsIbfk2'=> array(
'property' => 'Accounts',
'table_name' => 'Accounts',
),
'BugsIbfk3'=> array(
'property' => 'Accounts',
'table_name' => 'Accounts',
),
));

$this->setDependentList(array(
'BugsProductsIbfk1' => array(
'property' => 'BugsProducts',
'table_name' => 'BugsProducts',
),
));
}

/**
* Sets column bug_id
*
* @param int $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setBugId($data)
{
$this->_BugId = $data;
return $this;
}

/**
* Gets column bug_id
*
* @return int
*/
public function getBugId()
{
return $this->_BugId;
}

/**
* Sets column bug_description
*
* @param string $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setBugDescription($data)
{
$this->_BugDescription = $data;
return $this;
}

/**
* Gets column bug_description
*
* @return string
*/
public function getBugDescription()
{
return $this->_BugDescription;
}

/**
* Sets column bug_status
*
* @param string $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setBugStatus($data)
{
$this->_BugStatus = $data;
return $this;
}

/**
* Gets column bug_status
*
* @return string
*/
public function getBugStatus()
{
return $this->_BugStatus;
}

/**
* Sets column reported_by
*
* @param string $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setReportedBy($data)
{
$this->_ReportedBy = $data;
return $this;
}

/**
* Gets column reported_by
*
* @return string
*/
public function getReportedBy()
{
return $this->_ReportedBy;
}

/**
* Sets column assigned_to
*
* @param string $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setAssignedTo($data)
{
$this->_AssignedTo = $data;
return $this;
}

/**
* Gets column assigned_to
*
* @return string
*/
public function getAssignedTo()
{
return $this->_AssignedTo;
}

/**
* Sets column verified_by
*
* @param string $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setVerifiedBy($data)
{
$this->_VerifiedBy = $data;
return $this;
}

/**
* Gets column verified_by
*
* @return string
*/
public function getVerifiedBy()
{
return $this->_VerifiedBy;
}

/**
* Sets parent relation ReportedBy
*
* @param Weez\Core\Model\Model\Accounts $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setAccounts(\Weez\Core\Model\Model\Accounts $data)
{
$this->_Accounts = $data;

$primary_key = $data->getPrimaryKey();
if (is_array($primary_key)) {
$primary_key = $primary_key['account_name'];
}

$this->setReportedBy($primary_key);

return $this;
}

/**
* Gets parent ReportedBy
*
* @param boolean $load Load the object if it is not already
* @return Weez\Core\Model\Model\Accounts
*/
public function getAccounts($load = true)
{
if ($this->_Accounts === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk1', $this);
}

return $this->_Accounts;
}

/**
* Sets parent relation AssignedTo
*
* @param Weez\Core\Model\Model\Accounts $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setAccounts(\Weez\Core\Model\Model\Accounts $data)
{
$this->_Accounts = $data;

$primary_key = $data->getPrimaryKey();
if (is_array($primary_key)) {
$primary_key = $primary_key['account_name'];
}

$this->setAssignedTo($primary_key);

return $this;
}

/**
* Gets parent AssignedTo
*
* @param boolean $load Load the object if it is not already
* @return Weez\Core\Model\Model\Accounts
*/
public function getAccounts($load = true)
{
if ($this->_Accounts === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk2', $this);
}

return $this->_Accounts;
}

/**
* Sets parent relation VerifiedBy
*
* @param Weez\Core\Model\Model\Accounts $data
* @return Weez\Core\Model\Model\Bugs
*/
public function setAccounts(\Weez\Core\Model\Model\Accounts $data)
{
$this->_Accounts = $data;

$primary_key = $data->getPrimaryKey();
if (is_array($primary_key)) {
$primary_key = $primary_key['account_name'];
}

$this->setVerifiedBy($primary_key);

return $this;
}

/**
* Gets parent VerifiedBy
*
* @param boolean $load Load the object if it is not already
* @return Weez\Core\Model\Model\Accounts
*/
public function getAccounts($load = true)
{
if ($this->_Accounts === null && $load) {
$this->getMapper()->loadRelated('BugsIbfk3', $this);
}

return $this->_Accounts;
}

/**
* Sets dependent relations bugs_products_ibfk_1
*
* @param array $data An array of Weez\Core\Model\Model\BugsProducts
* @return Weez\Core\Model\Model\Bugs
*/
public function setBugsProducts(array $data)
{
$this->_BugsProducts = array();

foreach ($data as $object) {
$this->addBugsProducts($object);
}

return $this;
}

/**
* Sets dependent relations bugs_products_ibfk_1
*
* @param Weez\Core\Model\Model\BugsProducts $data
* @return Weez\Core\Model\Model\Bugs
*/
public function addBugsProducts(\Weez\Core\Model\Model\BugsProducts $data)
{
$this->_BugsProducts[] = $data;
return $this;
}

/**
* Gets dependent bugs_products_ibfk_1
*
* @param boolean $load Load the object if it is not already
* @return array The array of Weez\Core\Model\Model\BugsProducts
*/
public function getBugsProducts($load = true)
{
if ($this->_BugsProducts === null && $load) {
$this->getMapper()->loadRelated('BugsProductsIbfk1', $this);
}

return $this->_BugsProducts;
}

/**
* Returns the mapper class for this model
*
* @return Weez\Core\Model\Model\Mapper\Bugs
*/
public function getMapper()
{
if ($this->_mapper === null) {
$this->setMapper(new \Weez\Core\Model\Model\Mapper\Bugs());
}

return $this->_mapper;
}

/**
* Deletes current row by deleting the row that matches the primary key
*
* @see Weez\Core\Model\Model\Mapper\Bugs::delete
* @return int|boolean Number of rows deleted or boolean if doing soft delete
*/
public function deleteRowByPrimaryKey()
{
if ($this->getBugId() === null) {
throw new \Exception('Primary Key does not contain a value');
}

return $this->getMapper()
->getDbTable()
->delete('bug_id = ' .
$this->getMapper()
->getDbTable()
->getAdapter()
->quote($this->getBugId()));
}
}
