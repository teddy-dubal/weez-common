<?php

namespace Weez\Core\Model;

use Weez\Core\Model\Entity;

class Products extends Entity
{

    /**
     * @property int $ProductId
     */
    protected $ProductId = null;

    /**
     * @property string $ProductName
     */
    protected $ProductName = null;

    /**
     * Dependent relation 
     *
     * Type:  One-to-Many relationship
     *
     * @property Weez\Core\Model\BugsProducts $BugsProducts
     */
    protected $BugsProducts = null;

    /**
     * Sets up column and relationship lists
     *
     * @param Adapter $adapter
     * @param Entity $entity
     */
    public function __construct()
    {
        $this->setColumnsList(array(
             'product_id' => 'ProductId',
             'product_name' => 'ProductName',
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

    /**
     * Sets column product_id
     *
     * @param mixed $data
     */
    public function setProductId($data)
    {
        $this->ProductId = $data;
        return $this;
    }

    /**
     * Gets column product_id
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->ProductId ;
    }

    /**
     * Sets column product_name
     *
     * @param mixed $data
     */
    public function setProductName($data)
    {
        $this->ProductName = $data;
        return $this;
    }

    /**
     * Gets column product_name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->ProductName ;
    }


}

