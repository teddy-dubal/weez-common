<?php
namespace Interiale\Model;

use Interiale\Model\Manager;

class FilleulTable extends Manager
{
protected $table ='filleul';
protected $tableName ='filleul';

public function qi($name)  { return $this->adapter->platform->quoteIdentifier($name); }

public function fp($name) { return $this->adapter->driver->formatParameterName($name); }


public function __construct(Adapter $adapter)
{
$this->adapter = $adapter;
$this->resultSetPrototype = new ResultSet(new Filleul);
//$this->resultSetPrototype = new ResultSet();
//$this->resultSetPrototype->setArrayObjectPrototype(new Filleul);
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
return $select->from('filleul')->columns($columnsArray);
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

public function match($firstname, $lastname, $tel1, $tel2, $email, $cp_pro, $mutuelinit, $address, $cp, $city, $join_us, $createat)
{
$select = $this->getSelect();
    if ($firstname != null) {
    $select->where->like('firstname' ,'%'.$firstname.'%');
    }
    if ($lastname != null) {
    $select->where->like('lastname' ,'%'.$lastname.'%');
    }
    if ($tel1 != null) {
    $select->where->like('tel1' ,'%'.$tel1.'%');
    }
    if ($tel2 != null) {
    $select->where->like('tel2' ,'%'.$tel2.'%');
    }
    if ($email != null) {
    $select->where->like('email' ,'%'.$email.'%');
    }
    if ($cp_pro != null) {
    $select->where->like('cp_pro' ,'%'.$cp_pro.'%');
    }
    if ($mutuelinit != null) {
    $select->where->like('mutuelinit' ,'%'.$mutuelinit.'%');
    }
    if ($address != null) {
    $select->where->like('address' ,'%'.$address.'%');
    }
    if ($cp != null) {
    $select->where->like('cp' ,'%'.$cp.'%');
    }
    if ($city != null) {
    $select->where->like('city' ,'%'.$city.'%');
    }
    if ($join_us != null) {
    $select->where->like('join_us' ,'%'.$join_us.'%');
    }
    if ($createat != null) {
    $select->where->like('createat' ,'%'.$createat.'%');
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


public function save(Filleul $filleul)
{
$data = array(
    'firstname' => $filleul->firstname,
    'lastname' => $filleul->lastname,
    'tel1' => $filleul->tel1,
    'tel2' => $filleul->tel2,
    'email' => $filleul->email,
    'cp_pro' => $filleul->cp_pro,
    'mutuelinit' => $filleul->mutuelinit,
    'address' => $filleul->address,
    'cp' => $filleul->cp,
    'city' => $filleul->city,
    'join_us' => $filleul->join_us,
    'createat' => $filleul->createat,
);

$id = (int)$filleul->id;
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

public function add($firstname = null, $lastname = null, $tel1 = null, $tel2 = null, $email = null, $cp_pro = null, $mutuelinit = null, $address = null, $cp = null, $city = null, $join_us = null, $createat = null)
{
$data = array(    'firstname' => $firstname,
    'lastname' => $lastname,
    'tel1' => $tel1,
    'tel2' => $tel2,
    'email' => $email,
    'cp_pro' => $cp_pro,
    'mutuelinit' => $mutuelinit,
    'address' => $address,
    'cp' => $cp,
    'city' => $city,
    'join_us' => $join_us,
    'createat' => $createat,
);
$affectedRows=$this->insert($data);
    return $affectedRows;
}

public function delete($id)
{
$this->delete(array('id' => $id));
}

}
