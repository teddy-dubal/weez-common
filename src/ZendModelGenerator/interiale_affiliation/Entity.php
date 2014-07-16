<?php

namespace Interiale\Model;

class Entity
{
/**
* Associative array of columns for this model
*
* @var array
*/
protected $_columnsList;

/**
* Associative array of parent relationships for this model
*
* @var array
*/
protected $_parentList;

/**
* Associative array of dependent relationships for this model
*
* @var array
*/
protected $_dependentList;

/**
* Set the list of columns associated with this model
*
* @param array $data
* @return Interiale\Model\ModelAbstract
*/
public function setColumnsList($data)
{
$this->_columnsList = $data;
return $this;
}

/**
* Returns columns list array
*
* @return array
*/
public function getColumnsList()
{
return $this->_columnsList;
}

/**
* Set the list of relationships associated with this model
*
* @param array $data
* @return Interiale\Model\ModelAbstract
*/
public function setParentList($data)
{
$this->_parentList = $data;
return $this;
}

/**
* Returns relationship list array
*
* @return array
*/
public function getParentList()
{
return $this->_parentList;
}

/**
* Set the list of relationships associated with this model
*
* @param array $data
* @return Interiale\Model\ModelAbstract
*/
public function setDependentList($data)
{
$this->_dependentList = $data;
return $this;
}

/**
* Returns relationship list array
*
* @return array
*/
public function getDependentList()
{
return $this->_dependentList;
}

/**
* Converts database column name to php setter/getter function name
* @param string $column
*/
public function columnNameToVar($column)
{
if (! isset($this->_columnsList[$column])) {
throw new \Exception("column '$column' not found!");
}

return $this->_columnsList[$column];
}

/**
* Converts database column name to PHP setter/getter function name
* @param string $column
*/
public function varNameToColumn($thevar)
{
foreach ($this->_columnsList as $column => $var) {
if ($var == $thevar) {
return $column;
}
}

return null;
}

/**
* Array of options/values to be set for this model. Options without a
* matching method are ignored.
*
* @param array $options
* @return Interiale\Model\ModelAbstract
*/
public function setOptions(array $options)
{
$methods = get_class_methods($this);
foreach ($options as $key => $value) {
$key = preg_replace_callback('/_(.)/',
create_function('$matches','return ucfirst($matches[1]);'),
$key);
$method = 'set' . ucfirst($key);

if (in_array($method, $methods)) {
$this->$method($value);
}
}
return $this;
}



}
