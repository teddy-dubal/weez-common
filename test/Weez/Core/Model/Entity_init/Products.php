<?php

namespace Weez\Core\Model\Entity;

use Weez\Core\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Products extends Entity implements InputFilterAwareInterface
{
protected $inputFilter;
    /**
        * Database var type int(11)
    *
    * @var int
    */
    protected $_ProductId;

    /**
        * Database var type varchar(100)
    *
    * @var string
    */
    protected $_ProductName;




    /**
    * Dependent relation bugs_products_ibfk_2
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
    'product_id'=>'ProductId',
    'product_name'=>'ProductName',
));

$this->setParentList(array(
));

$this->setDependentList(array(
    'BugsProductsIbfk2' => array(
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
    * Sets column product_id
    *
            * @param int $data
        * @return Weez\Core\Model\Products
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
    * Sets column product_name
    *
            * @param string $data
        * @return Weez\Core\Model\Products
    */
    public function setProductName($data)
    {
        $this->_ProductName = $data;
    return $this;
    }

    /**
    * Gets column product_name
    *
            * @return string
        */
    public function getProductName()
    {
            return $this->_ProductName;
        }



            /**
        * Sets dependent relations bugs_products_ibfk_2
        *
        * @param array $data An array of Weez\Core\Model\BugsProducts
        * @return Weez\Core\Model\Products
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
        * Sets dependent relations bugs_products_ibfk_2
        *
        * @param Weez\Core\Model\BugsProducts $data
        * @return Weez\Core\Model\Products
        */
        public function addBugsProducts(\Weez\Core\Model\BugsProducts $data)
        {
        $this->_BugsProducts[] = $data;
        return $this;
        }

        /**
        * Gets dependent bugs_products_ibfk_2
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
    $this->_ProductId     = (isset($data['product_id'])) ? $data['product_id'] : null;
    $this->_ProductName     = (isset($data['product_name'])) ? $data['product_name'] : null;

}

/**
* Returns an array, keys are the field names.
*
* @param Weez\Core\Model\Products $model
* @return array
*/
public function toArray()
{
$result = array(
    'product_id' => $this->getProductId(),
    'product_name' => $this->getProductName(),
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
			'name'       => 'product_id',
			'required'   => true,
			'filters' => array(
			array('name'    => 'Int'),
			),
			)));
			            $inputFilter->add($factory->createInput(array(
			'name'     => 'product_name',
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



