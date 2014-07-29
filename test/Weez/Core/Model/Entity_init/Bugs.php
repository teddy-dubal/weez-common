<?php

namespace Weez\Core\Model\Entity;

use Weez\Core\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Bugs extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_BugId;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_BugDescription;

    /**
        * Database var type varchar(20)
    *
    * @var string
    */
    protected $_BugStatus;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_ReportedBy;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_AssignedTo;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_VerifiedBy;



    /**
    * Parent relation bugs_ibfk_1
    *
    * @var Weez\Core\Model\Accounts
    */
    protected $_Accounts;

    /**
    * Parent relation bugs_ibfk_2
    *
    * @var Weez\Core\Model\Accounts
    */
    protected $_Accounts;

    /**
    * Parent relation bugs_ibfk_3
    *
    * @var Weez\Core\Model\Accounts
    */
    protected $_Accounts;


    /**
    * Dependent relation bugs_products_ibfk_1
    * Type: One-to-Many relationship
    *
    * @var Weez\Core\Model\BugsProducts
    */
    protected $_BugsProducts;

/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'bug_id'=>'BugId',
    'bug_description'=>'BugDescription',
    'bug_status'=>'BugStatus',
    'reported_by'=>'ReportedBy',
    'assigned_to'=>'AssignedTo',
    'verified_by'=>'VerifiedBy',
));

$this->setParentList(array(
    'BugsIbfk1'=> array(
    'property' => 'Accounts',
    'table_name' => 'Accounts',
    ),
    'BugsIbfk2'=> array(
    'property' => 'Accounts',
    'table_name' => 'Accounts',
    ),
    'BugsIbfk3'=> array(
    'property' => 'Accounts',
    'table_name' => 'Accounts',
    ),
));

$this->setDependentList(array(
    'BugsProductsIbfk1' => array(
    'property' => 'BugsProducts',
    'table_name' => 'BugsProducts',
    ),
));
}

public function setInputFilter(InputFilterInterface $inputFilter)
{
throw new \Exception("Not used");
}


    /**
    * Sets column bug_id
    *
            * @param int $data
        * @return Weez\Core\Model\Bugs
    */
    public function setBugId($data)
    {
        $this->_BugId = $data;
    return $this;
    }

    /**
    * Gets column bug_id
    *
            * @return int
        */
    public function getBugId()
    {
            return $this->_BugId;
        }

    /**
    * Sets column bug_description
    *
            * @param string $data
        * @return Weez\Core\Model\Bugs
    */
    public function setBugDescription($data)
    {
        $this->_BugDescription = $data;
    return $this;
    }

    /**
    * Gets column bug_description
    *
            * @return string
        */
    public function getBugDescription()
    {
            return $this->_BugDescription;
        }

    /**
    * Sets column bug_status
    *
            * @param string $data
        * @return Weez\Core\Model\Bugs
    */
    public function setBugStatus($data)
    {
        $this->_BugStatus = $data;
    return $this;
    }

    /**
    * Gets column bug_status
    *
            * @return string
        */
    public function getBugStatus()
    {
            return $this->_BugStatus;
        }

    /**
    * Sets column reported_by
    *
            * @param string $data
        * @return Weez\Core\Model\Bugs
    */
    public function setReportedBy($data)
    {
        $this->_ReportedBy = $data;
    return $this;
    }

    /**
    * Gets column reported_by
    *
            * @return string
        */
    public function getReportedBy()
    {
            return $this->_ReportedBy;
        }

    /**
    * Sets column assigned_to
    *
            * @param string $data
        * @return Weez\Core\Model\Bugs
    */
    public function setAssignedTo($data)
    {
        $this->_AssignedTo = $data;
    return $this;
    }

    /**
    * Gets column assigned_to
    *
            * @return string
        */
    public function getAssignedTo()
    {
            return $this->_AssignedTo;
        }

    /**
    * Sets column verified_by
    *
            * @param string $data
        * @return Weez\Core\Model\Bugs
    */
    public function setVerifiedBy($data)
    {
        $this->_VerifiedBy = $data;
    return $this;
    }

    /**
    * Gets column verified_by
    *
            * @return string
        */
    public function getVerifiedBy()
    {
            return $this->_VerifiedBy;
        }



    /**
    * Sets parent relation ReportedBy
    *
    * @param Weez\Core\Model\Accounts $data
    * @return Weez\Core\Model\Bugs
    */
    public function setAccounts(\Weez\Core\Model\Accounts $data)
    {
    $this->_Accounts = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['account_name'];
        }

        $this->setReportedBy($primary_key);
    
    return $this;
    }

    /**
    * Gets parent ReportedBy
    *
    * @param boolean $load Load the object if it is not already
    * @return Weez\Core\Model\Accounts
    */
    public function getAccounts($load = true)
    {
    if ($this->_Accounts === null && $load) {
    $this->getMapper()->loadRelated('BugsIbfk1', $this);
    }

    return $this->_Accounts;
    }

    /**
    * Sets parent relation AssignedTo
    *
    * @param Weez\Core\Model\Accounts $data
    * @return Weez\Core\Model\Bugs
    */
    public function setAccounts(\Weez\Core\Model\Accounts $data)
    {
    $this->_Accounts = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['account_name'];
        }

        $this->setAssignedTo($primary_key);
    
    return $this;
    }

    /**
    * Gets parent AssignedTo
    *
    * @param boolean $load Load the object if it is not already
    * @return Weez\Core\Model\Accounts
    */
    public function getAccounts($load = true)
    {
    if ($this->_Accounts === null && $load) {
    $this->getMapper()->loadRelated('BugsIbfk2', $this);
    }

    return $this->_Accounts;
    }

    /**
    * Sets parent relation VerifiedBy
    *
    * @param Weez\Core\Model\Accounts $data
    * @return Weez\Core\Model\Bugs
    */
    public function setAccounts(\Weez\Core\Model\Accounts $data)
    {
    $this->_Accounts = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['account_name'];
        }

        $this->setVerifiedBy($primary_key);
    
    return $this;
    }

    /**
    * Gets parent VerifiedBy
    *
    * @param boolean $load Load the object if it is not already
    * @return Weez\Core\Model\Accounts
    */
    public function getAccounts($load = true)
    {
    if ($this->_Accounts === null && $load) {
    $this->getMapper()->loadRelated('BugsIbfk3', $this);
    }

    return $this->_Accounts;
    }

            /**
        * Sets dependent relations bugs_products_ibfk_1
        *
        * @param array $data An array of Weez\Core\Model\BugsProducts
        * @return Weez\Core\Model\Bugs
        */
        public function setBugsProducts(array $data)
        {
        $this->_BugsProducts = array();

        foreach ($data as $object) {
        $this->addBugsProducts($object);
        }

        return $this;
        }

        /**
        * Sets dependent relations bugs_products_ibfk_1
        *
        * @param Weez\Core\Model\BugsProducts $data
        * @return Weez\Core\Model\Bugs
        */
        public function addBugsProducts(\Weez\Core\Model\BugsProducts $data)
        {
        $this->_BugsProducts[] = $data;
        return $this;
        }

        /**
        * Gets dependent bugs_products_ibfk_1
        *
        * @return array The array of Weez\Core\Model\BugsProducts
        */

        public function getBugsProducts()
        {
        return $this->_BugsProducts;
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
    $this->_BugId     = (isset($data['bug_id'])) ? $data['bug_id'] : null;
    $this->_BugDescription     = (isset($data['bug_description'])) ? $data['bug_description'] : null;
    $this->_BugStatus     = (isset($data['bug_status'])) ? $data['bug_status'] : null;
    $this->_ReportedBy     = (isset($data['reported_by'])) ? $data['reported_by'] : null;
    $this->_AssignedTo     = (isset($data['assigned_to'])) ? $data['assigned_to'] : null;
    $this->_VerifiedBy     = (isset($data['verified_by'])) ? $data['verified_by'] : null;

}

/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\Bugs $model
* @return array
*/
public function toArray()
{
$result = array(
    'bug_id' => $this->getBugId(),
    'bug_description' => $this->getBugDescription(),
    'bug_status' => $this->getBugStatus(),
    'reported_by' => $this->getReportedBy(),
    'assigned_to' => $this->getAssignedTo(),
    'verified_by' => $this->getVerifiedBy(),
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
			'name'       => 'bug_id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'bug_description',
			'required' => false,
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
			'max'      => 100,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'bug_status',
			'required' => false,
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
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'reported_by',
			'required' => false,
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
			'max'      => 100,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'assigned_to',
			'required' => false,
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
			'max'      => 100,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'verified_by',
			'required' => false,
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



