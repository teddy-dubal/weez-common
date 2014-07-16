<?php

namespace Interiale\Model;

use Interiale\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Filleul extends Entity implements InputFilterAwareInterface
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
    protected $_Tel1;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_Tel2;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_Email;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_CpPro;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_Mutuelinit;

    /**
        * Database var type varchar(250)
    *
    * @var string
    */
    protected $_Address;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_Cp;

    /**
        * Database var type varchar(45)
    *
    * @var string
    */
    protected $_City;

    /**
        * Database var type tinyint(1)
    *
    * @var boolean
    */
    protected $_JoinUs;

    /**
        * Database var type datetime
    *
    * @var string
    */
    protected $_Createat;




    /**
    * Dependent relation fk_filleul_has_parrain_filleul
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
    'tel1'=>'Tel1',
    'tel2'=>'Tel2',
    'email'=>'Email',
    'cp_pro'=>'CpPro',
    'mutuelinit'=>'Mutuelinit',
    'address'=>'Address',
    'cp'=>'Cp',
    'city'=>'City',
    'join_us'=>'JoinUs',
    'createat'=>'Createat',
));

$this->setParentList(array(
));

$this->setDependentList(array(
    'FkFilleulHasParrainFilleul' => array(
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
        * @return Interiale\Model\Filleul
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
        * @return Interiale\Model\Filleul
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
        * @return Interiale\Model\Filleul
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
    * Sets column tel1
    *
            * @param int $data
        * @return Interiale\Model\Filleul
    */
    public function setTel1($data)
    {
        $this->_Tel1 = $data;
    return $this;
    }

    /**
    * Gets column tel1
    *
            * @return int
        */
    public function getTel1()
    {
            return $this->_Tel1;
        }

    /**
    * Sets column tel2
    *
            * @param int $data
        * @return Interiale\Model\Filleul
    */
    public function setTel2($data)
    {
        $this->_Tel2 = $data;
    return $this;
    }

    /**
    * Gets column tel2
    *
            * @return int
        */
    public function getTel2()
    {
            return $this->_Tel2;
        }

    /**
    * Sets column email
    *
            * @param string $data
        * @return Interiale\Model\Filleul
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
    * Sets column cp_pro
    *
            * @param int $data
        * @return Interiale\Model\Filleul
    */
    public function setCpPro($data)
    {
        $this->_CpPro = $data;
    return $this;
    }

    /**
    * Gets column cp_pro
    *
            * @return int
        */
    public function getCpPro()
    {
            return $this->_CpPro;
        }

    /**
    * Sets column mutuelinit
    *
            * @param string $data
        * @return Interiale\Model\Filleul
    */
    public function setMutuelinit($data)
    {
        $this->_Mutuelinit = $data;
    return $this;
    }

    /**
    * Gets column mutuelinit
    *
            * @return string
        */
    public function getMutuelinit()
    {
            return $this->_Mutuelinit;
        }

    /**
    * Sets column address
    *
            * @param string $data
        * @return Interiale\Model\Filleul
    */
    public function setAddress($data)
    {
        $this->_Address = $data;
    return $this;
    }

    /**
    * Gets column address
    *
            * @return string
        */
    public function getAddress()
    {
            return $this->_Address;
        }

    /**
    * Sets column cp
    *
            * @param int $data
        * @return Interiale\Model\Filleul
    */
    public function setCp($data)
    {
        $this->_Cp = $data;
    return $this;
    }

    /**
    * Gets column cp
    *
            * @return int
        */
    public function getCp()
    {
            return $this->_Cp;
        }

    /**
    * Sets column city
    *
            * @param string $data
        * @return Interiale\Model\Filleul
    */
    public function setCity($data)
    {
        $this->_City = $data;
    return $this;
    }

    /**
    * Gets column city
    *
            * @return string
        */
    public function getCity()
    {
            return $this->_City;
        }

    /**
    * Sets column join_us
    *
            * @param boolean $data
        * @return Interiale\Model\Filleul
    */
    public function setJoinUs($data)
    {
        $this->_JoinUs = $data;
    return $this;
    }

    /**
    * Gets column join_us
    *
            * @return boolean
        */
    public function getJoinUs()
    {
            return $this->_JoinUs ? true : false;
        }

    /**
    * Sets column createat. Stored in ISO 8601 format.
    *
            * @param string|Datetime $date
        * @return Interiale\Model\Filleul
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
        * Sets dependent relations fk_filleul_has_parrain_filleul
        *
        * @param array $data An array of Interiale\Model\FilleulHasParrain
        * @return Interiale\Model\Filleul
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
        * Sets dependent relations fk_filleul_has_parrain_filleul
        *
        * @param Interiale\Model\FilleulHasParrain $data
        * @return Interiale\Model\Filleul
        */
        public function addFilleulHasParrain(\Interiale\Model\FilleulHasParrain $data)
        {
        $this->_FilleulHasParrain[] = $data;
        return $this;
        }

        /**
        * Gets dependent fk_filleul_has_parrain_filleul
        *
        * @param boolean $load Load the object if it is not already
        * @return array The array of Interiale\Model\FilleulHasParrain
        */
        /*
        public function getFilleulHasParrain($load = true)
        {
        if ($this->_FilleulHasParrain === null && $load) {
        $this->getMapper()->loadRelated('FkFilleulHasParrainFilleul', $this);
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
    $this->_Tel1     = (isset($data['tel1'])) ? $data['tel1'] : null;
    $this->_Tel2     = (isset($data['tel2'])) ? $data['tel2'] : null;
    $this->_Email     = (isset($data['email'])) ? $data['email'] : null;
    $this->_CpPro     = (isset($data['cp_pro'])) ? $data['cp_pro'] : null;
    $this->_Mutuelinit     = (isset($data['mutuelinit'])) ? $data['mutuelinit'] : null;
    $this->_Address     = (isset($data['address'])) ? $data['address'] : null;
    $this->_Cp     = (isset($data['cp'])) ? $data['cp'] : null;
    $this->_City     = (isset($data['city'])) ? $data['city'] : null;
    $this->_JoinUs     = (isset($data['join_us'])) ? $data['join_us'] : null;
    $this->_Createat     = (isset($data['createat'])) ? $data['createat'] : null;

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
			'name'       => 'tel1',
			'required'   => false,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'       => 'tel2',
			'required'   => false,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'email',
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
			'name'       => 'cp_pro',
			'required'   => false,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'mutuelinit',
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
			'name'     => 'address',
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
			'max'      => 250,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'       => 'cp',
			'required'   => false,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'city',
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
			'name'       => 'join_us',
			'required'   => false,
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'createat',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
				)));
				
$this->inputFilter = $inputFilter;
}

return $this->inputFilter;
}

}

