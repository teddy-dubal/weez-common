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
* Data Mapper implementation for Weez\Core\Model\Model\Products
*
* @package Weez\Core\Model\Model
* @subpackage Mapper
* @author T.ED <teddy.dubal@gmail.com>
*/
class Products extends MapperAbstract
{
/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\Model\Products $model
* @return array
*/
public function toArray($model)
{
if (! $model instanceof \Weez\Core\Model\Model\Products) {
throw new \Exception('Unable to create array: invalid model passed to mapper');
}

$result = array(
'product_id' => $model->getProductId(),
'product_name' => $model->getProductName(),
);

return $result;
}

/**
* Returns the DbTable class associated with this mapper
* @params array of options for dbtable
* @return Weez\Core\Model\Model\DbTable\Products
*/
public function getDbTable($options = null)
{
if ($this->_dbTable === null) {
$this->setDbTable('\Weez\Core\Model\Model\DbTable\Products',$options);
}

return $this->_dbTable;
}

/**
* Deletes the current model
*
* @param Weez\Core\Model\Model\Products $model The model to delete
* @param boolean $useTransaction Flag to indicate if delete should be done inside a database transaction
* @see Weez\Core\Model\Model\DbTable\TableAbstract::delete()
* @return int
*/
public function delete($model, $useTransaction = true)
{
if (! $model instanceof \Weez\Core\Model\Model\Products) {
throw new \Exception('Unable to delete: invalid model passed to mapper');
}

if ($useTransaction) {
$this->getDbTable()->getAdapter()->beginTransaction();
}
try {
$where = $this->getDbTable()->getAdapter()->quoteInto('product_id = ?', $model->getProductId());
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
* @param \Weez\Core\Model\Model\Products $model
* @param boolean $ignoreEmptyValues Should empty values saved
* @param boolean $recursive Should the object graph be walked for all related elements
* @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
* @return current Id
*/
public function save(\Weez\Core\Model\Model\Products $model,
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

$primary_key = $model->getProductId();
$success = true;

if ($useTransaction) {
$this->getDbTable()->getAdapter()->beginTransaction();
}

unset($data['product_id']);

try {
if ($primary_key === null) {
$primary_key = $this->getDbTable()->insert($data);
if ($primary_key) {
$model->setProductId($primary_key);
} else {
$success = false;
}
} else {
$this->getDbTable()
->update($data,
array(
                                 'product_id = ?' => $primary_key
)
);
}

if ($recursive) {
if ($success && $model->getBugsProducts(false) !== null) {
$BugsProducts = $model->getBugsProducts();
foreach ($BugsProducts as $value) {
$success = $success &&
$value->setProductId($primary_key)
->save($ignoreEmptyValues, $recursive, false);

if (! $success) {
break;
}
}
}

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
* @param Weez\Core\Model\Model\Products|null $model
* @return Weez\Core\Model\Model\Products|null The object provided or null if not found
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
* @param Weez\Core\Model\Model\Products|null $entry The object to load the data into, or null to have one created
* @return Weez\Core\Model\Model\Products The model with the data provided
*/
public function loadModel($data, $entry)
{
if ($entry === null) {
$entry = new \Weez\Core\Model\Model\Products();
}

if (is_array($data)) {
$entry->setProductId($data['product_id'])
                  ->setProductName($data['product_name']);
} elseif ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof stdClass) {
$entry->setProductId($data->product_id)
                  ->setProductName($data->product_name);
}

$entry->setMapper($this);

return $entry;
}
}
