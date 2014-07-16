<?php
namespace Interiale\Model;

use Interiale\Model\Manager;

class ParrainTable extends Manager
{
protected $table ='parrain';
protected $tableName ='parrain';

public function qi($name)  { return $this->adapter->platform->quoteIdentifier($name); }

public function fp($name) { return $this->adapter->driver->formatParameterName($name); }


public function __construct(Adapter $adapter)
{
$this->adapter = $adapter;
$this->resultSetPrototype = new ResultSet(new Parrain);
//$this->resultSetPrototype = new ResultSet();
//$this->resultSetPrototype->setArrayObjectPrototype(new Parrain);
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
return $select->from('parrain')->columns($columnsArray);
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
$id=$row->id;
$isRowCreated=false;
}
return $id;
}


public function get($id)
{
$id  = (int) $id;
$rowset = $this->select(array('id' => $id));
$row = $rowset->current();
if (!$row) {
throw new \Exception("Could not find row $id");
}
return $row;
}

public function match($firstname, $lastname, $number, $cp, $createat, $email)
{
$select = $this->getSelect();
    if ($firstname != null) {
    $select->where->like('firstname' ,'%'.$firstname.'%');
    }
    if ($lastname != null) {
    $select->where->like('lastname' ,'%'.$lastname.'%');
    }
    if ($number != null) {
    $select->where->like('number' ,'%'.$number.'%');
    }
    if ($cp != null) {
    $select->where->like('cp' ,'%'.$cp.'%');
    }
    if ($createat != null) {
    $select->where->like('createat' ,'%'.$createat.'%');
    }
    if ($email != null) {
    $select->where->like('email' ,'%'.$email.'%');
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


public function save(Parrain $parrain)
{
$data = array(
    'firstname' => $parrain->firstname,
    'lastname' => $parrain->lastname,
    'number' => $parrain->number,
    'cp' => $parrain->cp,
    'createat' => $parrain->createat,
    'email' => $parrain->email,
);

$id = (int)$parrain->id;
if ($id == 0) {
$this->insert($data);
} else {
if ($this->get($id)) {
$this->update($data, array('id' => $id));
} else {
throw new \Exception('Form id does not exit');
}
}
}

public function add($number, $email, $firstname = null, $lastname = null, $cp = null, $createat = null)
{
$data = array(    'firstname' => $firstname,
    'lastname' => $lastname,
    'number' => $number,
    'cp' => $cp,
    'createat' => $createat,
    'email' => $email,
);
$affectedRows=$this->insert($data);
    return $affectedRows;
}

public function delete($id)
{
$this->delete(array('id' => $id));
}

}
