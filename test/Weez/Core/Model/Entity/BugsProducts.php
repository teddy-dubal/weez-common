<?php

namespace Weez\Core\Model;

use Weez\Core\Model\Entity;

class BugsProducts extends Entity
{

    /**
     * @property int $BugId
     */
    protected $BugId = null;

    /**
     * @property int $ProductId
     */
    protected $ProductId = null;

    /**
     * Parent relation
     *
     * @property Weez\Core\Model\Bugs $Bug_bug_id
     */
    protected $Bug_bug_id = null;

    /**
     * Parent relation
     *
     * @property Weez\Core\Model\Products $Product_product_id
     */
    protected $Product_product_id = null;

    /**
     * Sets up column and relationship lists
     *
     * @param Adapter $adapter
     * @param Entity $entity
     */
    public function __construct()
    {
        $this->setColumnsList(array(
             'bug_id' => 'BugId',
             'product_id' => 'ProductId',
        ));
        $this->setParentList(array(
         'BugsProductsIbfk1' => array(
             'property' => 'Bug_bug_id',
             'table_name' => 'Bugs',
         ),
         'BugsProductsIbfk2' => array(
             'property' => 'Product_product_id',
             'table_name' => 'Products',
         ),
        ));
        $this->setDependentList(array(
        ));
    }

    /**
     * Sets column bug_id
     *
     * @param mixed $data
     */
    public function setBugId($data)
    {
        $this->BugId = $data;
        return $this;
    }

    /**
     * Gets column bug_id
     *
     * @return int
     */
    public function getBugId()
    {
        return $this->BugId ;
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


}

