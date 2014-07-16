<?php

namespace Interiale\Model;

use Interiale\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class FilleulHasParrain extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_FilleulId;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_ParrainId;

    /**
        * Database var type tinyint(1)
    *
    * @var boolean
    */
    protected $_Validate;



    /**
    * Parent relation fk_filleul_has_parrain_filleul
    *
    * @var Interiale\Model\Filleul
    */
    protected $_Filleul;

    /**
    * Parent relation fk_filleul_has_parrain_parrain1
    *
    * @var Interiale\Model\Parrain
    */
    protected $_Parrain;


/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'filleul_id'=>'FilleulId',
    'parrain_id'=>'ParrainId',
    'validate'=>'Validate',
));

$this->setParentList(array(
    'FkFilleulHasParrainFilleul'=> array(
    'property' => 'Filleul',
    'table_name' => 'Filleul',
    ),
    'FkFilleulHasParrainParrain1'=> array(
    'property' => 'Parrain',
    'table_name' => 'Parrain',
    ),
));

$this->setDependentList(array(
));
}

public function setInputFilter(InputFilterInterface $inputFilter)
{
throw new \Exception("Not used");
}


    /**
    * Sets column filleul_id
    *
            * @param int $data
        * @return Interiale\Model\FilleulHasParrain
    */
    public function setFilleulId($data)
    {
        $this->_FilleulId = $data;
    return $this;
    }

    /**
    * Gets column filleul_id
    *
            * @return int
        */
    public function getFilleulId()
    {
            return $this->_FilleulId;
        }

    /**
    * Sets column parrain_id
    *
            * @param int $data
        * @return Interiale\Model\FilleulHasParrain
    */
    public function setParrainId($data)
    {
        $this->_ParrainId = $data;
    return $this;
    }

    /**
    * Gets column parrain_id
    *
            * @return int
        */
    public function getParrainId()
    {
            return $this->_ParrainId;
        }

    /**
    * Sets column validate
    *
            * @param boolean $data
        * @return Interiale\Model\FilleulHasParrain
    */
    public function setValidate($data)
    {
        $this->_Validate = $data;
    return $this;
    }

    /**
    * Gets column validate
    *
            * @return boolean
        */
    public function getValidate()
    {
            return $this->_Validate ? true : false;
        }



    /**
    * Sets parent relation Filleul
    *
    * @param Interiale\Model\Filleul $data
    * @return Interiale\Model\FilleulHasParrain
    */
    public function setFilleul(\Interiale\Model\Filleul $data)
    {
    $this->_Filleul = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['id'];
        }

        $this->setFilleulId($primary_key);
    
    return $this;
    }

    /**
    * Gets parent Filleul
    *
    * @param boolean $load Load the object if it is not already
    * @return Interiale\Model\Filleul
    */
    public function getFilleul($load = true)
    {
    if ($this->_Filleul === null && $load) {
    $this->getMapper()->loadRelated('FkFilleulHasParrainFilleul', $this);
    }

    return $this->_Filleul;
    }

    /**
    * Sets parent relation Parrain
    *
    * @param Interiale\Model\Parrain $data
    * @return Interiale\Model\FilleulHasParrain
    */
    public function setParrain(\Interiale\Model\Parrain $data)
    {
    $this->_Parrain = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['id'];
        }

        $this->setParrainId($primary_key);
    
    return $this;
    }

    /**
    * Gets parent Parrain
    *
    * @param boolean $load Load the object if it is not already
    * @return Interiale\Model\Parrain
    */
    public function getParrain($load = true)
    {
    if ($this->_Parrain === null && $load) {
    $this->getMapper()->loadRelated('FkFilleulHasParrainParrain1', $this);
    }

    return $this->_Parrain;
    }

/**
* Array of options/values to be set for this model. Options without a
* matching method are ignored.
*
* @param array $options
*
*/

public function exchangeArray(array $data)
{
    $this->_FilleulId     = (isset($data['filleul_id'])) ? $data['filleul_id'] : null;
    $this->_ParrainId     = (isset($data['parrain_id'])) ? $data['parrain_id'] : null;
    $this->_Validate     = (isset($data['validate'])) ? $data['validate'] : null;

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
			'name'       => 'filleul_id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'       => 'parrain_id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'       => 'validate',
			'required'   => false,
			)));
			
$this->inputFilter = $inputFilter;
}

return $this->inputFilter;
}

}

