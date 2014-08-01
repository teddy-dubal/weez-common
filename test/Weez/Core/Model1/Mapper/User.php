<?php

namespace Weez\Core\Model\Model\Mapper;
/**
* Application Model Mappers
*
* @package Weez\Core\Model\Model
* @subpackage Mapper
* @author T.ED <teddy.dubal@gmail.com>
* @copyright ZF model generator
* @license http://framework.zend.com/license/new-bsd     New BSD License
*/

/**
* Data Mapper implementation for Weez\Core\Model\Model\User
*
* @package Weez\Core\Model\Model
* @subpackage Mapper
* @author T.ED <teddy.dubal@gmail.com>
*/
class User extends MapperAbstract
{
/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\Model\User $model
* @return array
*/
public function toArray($model)
{
if (! $model instanceof \Weez\Core\Model\Model\User) {
throw new \Exception('Unable to create array: invalid model passed to mapper');
}

$result = array(
'id' => $model->getId(),
'name' => $model->getName(),
);

return $result;
}

/**
* Returns the DbTable class associated with this mapper
* @params array of options for dbtable
* @return Weez\Core\Model\Model\DbTable\User
*/
public function getDbTable($options = null)
{
if ($this->_dbTable === null) {
$this->setDbTable('\Weez\Core\Model\Model\DbTable\User',$options);
}

return $this->_dbTable;
}

/**
* Deletes the current model
*
* @param Weez\Core\Model\Model\User $model The model to delete
* @param boolean $useTransaction Flag to indicate if delete should be done inside a database transaction
* @see Weez\Core\Model\Model\DbTable\TableAbstract::delete()
* @return int
*/
public function delete($model, $useTransaction = true)
{
if (! $model instanceof \Weez\Core\Model\Model\User) {
throw new \Exception('Unable to delete: invalid model passed to mapper');
}

if ($useTransaction) {
$this->getDbTable()->getAdapter()->beginTransaction();
}
try {
$where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $model->getId());
$result = $this->getDbTable()->delete($where);

if ($useTransaction) {
$this->getDbTable()->getAdapter()->commit();
}
} catch (Exception $e) {
if ($useTransaction) {
$this->getDbTable()->getAdapter()->rollback();
}
$result = false;
}

return $result;
}

/**
* Saves current row, and optionally dependent rows
*
* @param \Weez\Core\Model\Model\User $model
* @param boolean $ignoreEmptyValues Should empty values saved
* @param boolean $recursive Should the object graph be walked for all related elements
* @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
* @return current Id
*/
public function save(\Weez\Core\Model\Model\User $model,
$ignoreEmptyValues = true, $recursive = false, $useTransaction = true
) {
$data = $model->toArray();
if ($ignoreEmptyValues) {
foreach ($data as $key => $value) {
if ($value === null or $value === '') {
unset($data[$key]);
}
}
}

$primary_key = $model->getId();
$success = true;

if ($useTransaction) {
$this->getDbTable()->getAdapter()->beginTransaction();
}

unset($data['id']);

try {
if ($primary_key === null) {
$primary_key = $this->getDbTable()->insert($data);
if ($primary_key) {
$model->setId($primary_key);
} else {
$success = false;
}
} else {
$this->getDbTable()
->update($data,
array(
                                 'id = ?' => $primary_key
)
);
}

if ($useTransaction && $success) {
$this->getDbTable()->getAdapter()->commit();
} elseif ($useTransaction) {
$this->getDbTable()->getAdapter()->rollback();
}

} catch (Exception $e) {
if ($useTransaction) {
$this->getDbTable()->getAdapter()->rollback();
}

$success = false;
}

return $success;
}

/**
* Finds row by primary key
*
* @param int $primary_key
* @param Weez\Core\Model\Model\User|null $model
* @return Weez\Core\Model\Model\User|null The object provided or null if not found
*/
public function find($primary_key, $model)
{
$result = $this->getRowset($primary_key);

if (is_null($result)) {
return null;
}

$row = $result->current();

$model = $this->loadModel($row, $model);

return $model;
}

/**
* Loads the model specific data into the model object
*
* @param \Zend\Db\RowGateway\AbstractRowGateway|array $data The data as returned from a Zend_Db query
* @param Weez\Core\Model\Model\User|null $entry The object to load the data into, or null to have one created
* @return Weez\Core\Model\Model\User The model with the data provided
*/
public function loadModel($data, $entry)
{
if ($entry === null) {
$entry = new \Weez\Core\Model\Model\User();
}

if (is_array($data)) {
$entry->setId($data['id'])
                  ->setName($data['name']);
} elseif ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof stdClass) {
$entry->setId($data->id)
                  ->setName($data->name);
}

$entry->setMapper($this);

return $entry;
}
}
