<?php

namespace Weez\Core\Model\Entity;

use Weez\Core\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Accounts extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_AccountName;




    /**
    * Dependent relation bugs_ibfk_1
    * Type: One-to-Many relationship
    *
    * @var Weez\Core\Model\Bugs
    */
    protected $_BugsByReportedBy;

    /**
    * Dependent relation bugs_ibfk_2
    * Type: One-to-Many relationship
    *
    * @var Weez\Core\Model\Bugs
    */
    protected $_BugsByAssignedTo;

    /**
    * Dependent relation bugs_ibfk_3
    * Type: One-to-Many relationship
    *
    * @var Weez\Core\Model\Bugs
    */
    protected $_BugsByVerifiedBy;

/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'account_name'=>'AccountName',
));

$this->setParentList(array(
));

$this->setDependentList(array(
    'BugsIbfk1' => array(
    'property' => 'BugsByReportedBy',
    'table_name' => 'Bugs',
    ),
    'BugsIbfk2' => array(
    'property' => 'BugsByAssignedTo',
    'table_name' => 'Bugs',
    ),
    'BugsIbfk3' => array(
    'property' => 'BugsByVerifiedBy',
    'table_name' => 'Bugs',
    ),
));
}

public function setInputFilter(InputFilterInterface $inputFilter)
{
throw new \Exception("Not used");
}


    /**
    * Sets column account_name
    *
            * @param string $data
        * @return Weez\Core\Model\Accounts
    */
    public function setAccountName($data)
    {
        $this->_AccountName = $data;
    return $this;
    }

    /**
    * Gets column account_name
    *
            * @return string
        */
    public function getAccountName()
    {
            return $this->_AccountName;
        }



            /**
        * Sets dependent relations bugs_ibfk_1
        *
        * @param array $data An array of Weez\Core\Model\Bugs
        * @return Weez\Core\Model\Accounts
        */
        public function setBugsByReportedBy(array $data)
        {
        $this->_BugsByReportedBy = array();

        foreach ($data as $object) {
        $this->addBugsByReportedBy($object);
        }

        return $this;
        }

        /**
        * Sets dependent relations bugs_ibfk_1
        *
        * @param Weez\Core\Model\Bugs $data
        * @return Weez\Core\Model\Accounts
        */
        public function addBugsByReportedBy(\Weez\Core\Model\Bugs $data)
        {
        $this->_BugsByReportedBy[] = $data;
        return $this;
        }

        /**
        * Gets dependent bugs_ibfk_1
        *
        * @return array The array of Weez\Core\Model\Bugs
        */

        public function getBugsByReportedBy()
        {
        return $this->_BugsByReportedBy;
        }

    
            /**
        * Sets dependent relations bugs_ibfk_2
        *
        * @param array $data An array of Weez\Core\Model\Bugs
        * @return Weez\Core\Model\Accounts
        */
        public function setBugsByAssignedTo(array $data)
        {
        $this->_BugsByAssignedTo = array();

        foreach ($data as $object) {
        $this->addBugsByAssignedTo($object);
        }

        return $this;
        }

        /**
        * Sets dependent relations bugs_ibfk_2
        *
        * @param Weez\Core\Model\Bugs $data
        * @return Weez\Core\Model\Accounts
        */
        public function addBugsByAssignedTo(\Weez\Core\Model\Bugs $data)
        {
        $this->_BugsByAssignedTo[] = $data;
        return $this;
        }

        /**
        * Gets dependent bugs_ibfk_2
        *
        * @return array The array of Weez\Core\Model\Bugs
        */

        public function getBugsByAssignedTo()
        {
        return $this->_BugsByAssignedTo;
        }

    
            /**
        * Sets dependent relations bugs_ibfk_3
        *
        * @param array $data An array of Weez\Core\Model\Bugs
        * @return Weez\Core\Model\Accounts
        */
        public function setBugsByVerifiedBy(array $data)
        {
        $this->_BugsByVerifiedBy = array();

        foreach ($data as $object) {
        $this->addBugsByVerifiedBy($object);
        }

        return $this;
        }

        /**
        * Sets dependent relations bugs_ibfk_3
        *
        * @param Weez\Core\Model\Bugs $data
        * @return Weez\Core\Model\Accounts
        */
        public function addBugsByVerifiedBy(\Weez\Core\Model\Bugs $data)
        {
        $this->_BugsByVerifiedBy[] = $data;
        return $this;
        }

        /**
        * Gets dependent bugs_ibfk_3
        *
        * @return array The array of Weez\Core\Model\Bugs
        */

        public function getBugsByVerifiedBy()
        {
        return $this->_BugsByVerifiedBy;
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
    $this->_AccountName     = (isset($data['account_name'])) ? $data['account_name'] : null;

}

/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\Accounts $model
* @return array
*/
public function toArray()
{
$result = array(
    'account_name' => $this->getAccountName(),
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
			'name'     => 'account_name',
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



