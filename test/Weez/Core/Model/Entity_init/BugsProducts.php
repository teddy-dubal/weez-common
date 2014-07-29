<?php

namespace Weez\Core\Model\Entity;

use Weez\Core\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class BugsProducts extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_BugId;

    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_ProductId;



    /**
    * Parent relation bugs_products_ibfk_1
    *
    * @var Weez\Core\Model\Bugs
    */
    protected $_Bug;

    /**
    * Parent relation bugs_products_ibfk_2
    *
    * @var Weez\Core\Model\Products
    */
    protected $_Product;


/**
* Sets up column and relationship lists
*/
public function __construct()
{
$this->setColumnsList(array(
    'bug_id'=>'BugId',
    'product_id'=>'ProductId',
));

$this->setParentList(array(
    'BugsProductsIbfk1'=> array(
    'property' => 'Bug',
    'table_name' => 'Bugs',
    ),
    'BugsProductsIbfk2'=> array(
    'property' => 'Product',
    'table_name' => 'Products',
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
    * Sets column bug_id
    *
            * @param int $data
        * @return Weez\Core\Model\BugsProducts
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
    * Sets column product_id
    *
            * @param int $data
        * @return Weez\Core\Model\BugsProducts
    */
    public function setProductId($data)
    {
        $this->_ProductId = $data;
    return $this;
    }

    /**
    * Gets column product_id
    *
            * @return int
        */
    public function getProductId()
    {
            return $this->_ProductId;
        }



    /**
    * Sets parent relation Bug
    *
    * @param Weez\Core\Model\Bugs $data
    * @return Weez\Core\Model\BugsProducts
    */
    public function setBug(\Weez\Core\Model\Bugs $data)
    {
    $this->_Bug = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['bug_id'];
        }

        $this->setBugId($primary_key);
    
    return $this;
    }

    /**
    * Gets parent Bug
    *
    * @param boolean $load Load the object if it is not already
    * @return Weez\Core\Model\Bugs
    */
    public function getBug($load = true)
    {
    if ($this->_Bug === null && $load) {
    $this->getMapper()->loadRelated('BugsProductsIbfk1', $this);
    }

    return $this->_Bug;
    }

    /**
    * Sets parent relation Product
    *
    * @param Weez\Core\Model\Products $data
    * @return Weez\Core\Model\BugsProducts
    */
    public function setProduct(\Weez\Core\Model\Products $data)
    {
    $this->_Product = $data;

    $primary_key = $data->getPrimaryKey();
            if (is_array($primary_key)) {
        $primary_key = $primary_key['product_id'];
        }

        $this->setProductId($primary_key);
    
    return $this;
    }

    /**
    * Gets parent Product
    *
    * @param boolean $load Load the object if it is not already
    * @return Weez\Core\Model\Products
    */
    public function getProduct($load = true)
    {
    if ($this->_Product === null && $load) {
    $this->getMapper()->loadRelated('BugsProductsIbfk2', $this);
    }

    return $this->_Product;
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
    $this->_ProductId     = (isset($data['product_id'])) ? $data['product_id'] : null;

}

/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\BugsProducts $model
* @return array
*/
public function toArray()
{
$result = array(
    'bug_id' => $this->getBugId(),
    'product_id' => $this->getProductId(),
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
			'name'       => 'product_id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			
$this->inputFilter = $inputFilter;
}

return $this->inputFilter;
}

}



