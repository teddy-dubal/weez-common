<?php

namespace Weez\Core\Model\Entity;

use Weez\Core\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class User extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(10) unsigned
    *
    * @var int
    */
    protected $_Id;

    /**
        * Database var type varchar(20)
    *
    * @var string
    */
    protected $_Name;




/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'id'=>'Id',
    'name'=>'Name',
));

$this->setParentList(array(
));

$this->setDependentList(array(
));
}

public function setInputFilter(InputFilterInterface $inputFilter)
{
throw new \Exception("Not used");
}


    /**
    * Sets column id
    *
            * @param int $data
        * @return Weez\Core\Model\User
    */
    public function setId($data)
    {
        $this->_Id = $data;
    return $this;
    }

    /**
    * Gets column id
    *
            * @return int
        */
    public function getId()
    {
            return $this->_Id;
        }

    /**
    * Sets column name
    *
            * @param string $data
        * @return Weez\Core\Model\User
    */
    public function setName($data)
    {
        $this->_Name = $data;
    return $this;
    }

    /**
    * Gets column name
    *
            * @return string
        */
    public function getName()
    {
            return $this->_Name;
        }



/**
* Array of options/values to be set for this model. Options without a
* matching method are ignored.
*
* @param array $data
*
*/

public function exchangeArray(array $data)
{
    $this->_Id     = (isset($data['id'])) ? $data['id'] : null;
    $this->_Name     = (isset($data['name'])) ? $data['name'] : null;

}

/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\User $model
* @return array
*/
public function toArray()
{
$result = array(
    'id' => $this->getId(),
    'name' => $this->getName(),
);
return $result;
}

/**
* Get input filter
*
* @return InputFilter
*/
public function getInputFilter()
{
if (!$this->inputFilter) {
$inputFilter = new InputFilter();

$factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
			'name'       => 'id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'name',
			'required' => true,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'latin1',
			'min'      => 1,
			'max'      => 20,
				),
				),
				),
				)));
				
$this->inputFilter = $inputFilter;
}

return $this->inputFilter;
}

}



