<?php

namespace Interiale\Model;

use Interiale\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Parrain extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_Id;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_Firstname;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_Lastname;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_Number;

    /**
        * Database var type varchar(45)
    *
    * @var string
    */
    protected $_Cp;

    /**
        * Database var type datetime
    *
    * @var string
    */
    protected $_Createat;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_Email;




    /**
    * Dependent relation fk_filleul_has_parrain_parrain1
    * Type: One-to-Many relationship
    *
    * @var Interiale\Model\FilleulHasParrain
    */
    protected $_FilleulHasParrain;

/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'id'=>'Id',
    'firstname'=>'Firstname',
    'lastname'=>'Lastname',
    'number'=>'Number',
    'cp'=>'Cp',
    'createat'=>'Createat',
    'email'=>'Email',
));

$this->setParentList(array(
));

$this->setDependentList(array(
    'FkFilleulHasParrainParrain1' => array(
    'property' => 'FilleulHasParrain',
    'table_name' => 'FilleulHasParrain',
    ),
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
        * @return Interiale\Model\Parrain
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
    * Sets column firstname
    *
            * @param string $data
        * @return Interiale\Model\Parrain
    */
    public function setFirstname($data)
    {
        $this->_Firstname = $data;
    return $this;
    }

    /**
    * Gets column firstname
    *
            * @return string
        */
    public function getFirstname()
    {
            return $this->_Firstname;
        }

    /**
    * Sets column lastname
    *
            * @param string $data
        * @return Interiale\Model\Parrain
    */
    public function setLastname($data)
    {
        $this->_Lastname = $data;
    return $this;
    }

    /**
    * Gets column lastname
    *
            * @return string
        */
    public function getLastname()
    {
            return $this->_Lastname;
        }

    /**
    * Sets column number
    *
            * @param int $data
        * @return Interiale\Model\Parrain
    */
    public function setNumber($data)
    {
        $this->_Number = $data;
    return $this;
    }

    /**
    * Gets column number
    *
            * @return int
        */
    public function getNumber()
    {
            return $this->_Number;
        }

    /**
    * Sets column cp
    *
            * @param string $data
        * @return Interiale\Model\Parrain
    */
    public function setCp($data)
    {
        $this->_Cp = $data;
    return $this;
    }

    /**
    * Gets column cp
    *
            * @return string
        */
    public function getCp()
    {
            return $this->_Cp;
        }

    /**
    * Sets column createat. Stored in ISO 8601 format.
    *
            * @param string|Datetime $date
        * @return Interiale\Model\Parrain
    */
    public function setCreateat($data)
    {
            if (! empty($data)) {
        if (! $data instanceof \DateTime) {
        $data = new \DateTime($data);
        }

        $data = $data->format ('YYYY-MM-ddTHH:mm:ss.S');
        }

        $this->_Createat = $data;
    return $this;
    }

    /**
    * Gets column createat
    *
            * @param boolean $returnDateTime
        * @return \DateTime|null|string DateTime representation of this datetime if enabled, or ISO 8601 string if not
        */
    public function getCreateat($returnDateTime = false)
    {
            if ($returnDateTime) {
        if ($this->_Createat === null) {
        return null;
        }
        return new \DateTime($this->_Createat, 'YYYY-MM-ddTHH:mm:ss.S');
        }

        return $this->_Createat;
        }

    /**
    * Sets column email
    *
            * @param string $data
        * @return Interiale\Model\Parrain
    */
    public function setEmail($data)
    {
        $this->_Email = $data;
    return $this;
    }

    /**
    * Gets column email
    *
            * @return string
        */
    public function getEmail()
    {
            return $this->_Email;
        }



            /**
        * Sets dependent relations fk_filleul_has_parrain_parrain1
        *
        * @param array $data An array of Interiale\Model\FilleulHasParrain
        * @return Interiale\Model\Parrain
        */
        public function setFilleulHasParrain(array $data)
        {
        $this->_FilleulHasParrain = array();

        foreach ($data as $object) {
        $this->addFilleulHasParrain($object);
        }

        return $this;
        }

        /**
        * Sets dependent relations fk_filleul_has_parrain_parrain1
        *
        * @param Interiale\Model\FilleulHasParrain $data
        * @return Interiale\Model\Parrain
        */
        public function addFilleulHasParrain(\Interiale\Model\FilleulHasParrain $data)
        {
        $this->_FilleulHasParrain[] = $data;
        return $this;
        }

        /**
        * Gets dependent fk_filleul_has_parrain_parrain1
        *
        * @param boolean $load Load the object if it is not already
        * @return array The array of Interiale\Model\FilleulHasParrain
        */
        /*
        public function getFilleulHasParrain($load = true)
        {
        if ($this->_FilleulHasParrain === null && $load) {
        $this->getMapper()->loadRelated('FkFilleulHasParrainParrain1', $this);
        }

        return $this->_FilleulHasParrain;
        }
        */
    
/**
* Array of options/values to be set for this model. Options without a
* matching method are ignored.
*
* @param array $options
*
*/

public function exchangeArray(array $data)
{
    $this->_Id     = (isset($data['id'])) ? $data['id'] : null;
    $this->_Firstname     = (isset($data['firstname'])) ? $data['firstname'] : null;
    $this->_Lastname     = (isset($data['lastname'])) ? $data['lastname'] : null;
    $this->_Number     = (isset($data['number'])) ? $data['number'] : null;
    $this->_Cp     = (isset($data['cp'])) ? $data['cp'] : null;
    $this->_Createat     = (isset($data['createat'])) ? $data['createat'] : null;
    $this->_Email     = (isset($data['email'])) ? $data['email'] : null;

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
			'name'     => 'firstname',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 100,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'lastname',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 100,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'       => 'number',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'cp',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 45,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'createat',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'email',
			'required' => true,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 100,
				),
				),
				),
				)));
				
$this->inputFilter = $inputFilter;
}

return $this->inputFilter;
}

}

