<?php
namespace Interiale\Model;

use Interiale\Model\Manager;

class FilleulHasParrainTable extends Manager
{
protected $table ='filleul_has_parrain';
protected $tableName ='filleul_has_parrain';

public function qi($name)  { return $this->adapter->platform->quoteIdentifier($name); }

public function fp($name) { return $this->adapter->driver->formatParameterName($name); }


public function __construct(Adapter $adapter)
{
$this->adapter = $adapter;
$this->resultSetPrototype = new ResultSet(new FilleulHasParrain);
//$this->resultSetPrototype = new ResultSet();
//$this->resultSetPrototype->setArrayObjectPrototype(new FilleulHasParrain);
$this->initialize();
}

public function fetchAll()
{
$resultSet = $this->select();
return $resultSet;
}


public function getSelect(&$select,$columnsArray=array())
{
$select = new Select;
return $select->from('filleul_has_parrain')->columns($columnsArray);
}

public function createIfNotExist($checkColumnsArray,$optionalColumns=array(),&$isRowCreated=null) {
$rowset=$this->select($checkColumnsArray);
$row = $rowset->current();
$id=null;
if ($row == null) {
$allColumns=array_merge($checkColumnsArray,$optionalColumns);
$affectedRows = $this->insert($allColumns);
if ($affectedRows != 1) {
throw new \Exception("error: could not add line to db");
}
$id=$this->lastInsertValue;
$isRowCreated=true;
} else {
$id=$row->array('filleul_id', 'parrain_id');
$isRowCreated=false;
}
return $id;
}


public function get($id)
{
$id  = (int) $id;
$rowset = $this->select(array('array('filleul_id', 'parrain_id')' => $id));
$row = $rowset->current();
if (!$row) {
throw new \Exception("Could not find row $id");
}
return $row;
}

public function match($filleul_id, $parrain_id, $validate)
{
$select = $this->getSelect();
    if ($filleul_id != null) {
    $select->where->like('filleul_id' ,'%'.$filleul_id.'%');
    }
    if ($parrain_id != null) {
    $select->where->like('parrain_id' ,'%'.$parrain_id.'%');
    }
    if ($validate != null) {
    $select->where->like('validate' ,'%'.$validate.'%');
    }
$statement = $this->getSql()->prepareStatementForSqlObject($select);
$result = $statement->execute();
$ret = $result->current();
if ($ret !== false) {
$ret = array($ret);
while (($line=$result->next()) !== false ) {
$ret[]=$line;
}
}
return $ret;
}


public function save(FilleulHasParrain $filleul_has_parrain)
{
$data = array(
    'filleul_id' => $filleul_has_parrain->filleul_id,
    'parrain_id' => $filleul_has_parrain->parrain_id,
    'validate' => $filleul_has_parrain->validate,
);

$id = (int)$filleul_has_parrain->id;
if ($id == 0) {
$this->insert($data);
} else {
if ($this->get($id)) {
$this->update($data, array('array('filleul_id', 'parrain_id')' => $id));
} else {
throw new \Exception('Form id does not exit');
}
}
}

public function add($filleul_id, $parrain_id, $validate = null)
{
$data = array(    'filleul_id' => $filleul_id,
    'parrain_id' => $parrain_id,
    'validate' => $validate,
);
$affectedRows=$this->insert($data);
    return $affectedRows;
}

public function delete($id)
{
$this->delete(array('array('filleul_id', 'parrain_id')' => $id));
}

}
