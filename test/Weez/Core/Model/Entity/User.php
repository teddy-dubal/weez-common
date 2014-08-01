<?php

namespace Weez\Core\Model;

use Weez\Core\Model\Entity;

class User extends Entity
{

    /**
     * @property int $Id
     */
    protected $Id = null;

    /**
     * @property string $Name
     */
    protected $Name = null;

    /**
     * Sets up column and relationship lists
     *
     * @param Adapter $adapter
     * @param Entity $entity
     */
    public function __construct()
    {
        $this->setColumnsList(array(
             'id' => 'Id',
             'name' => 'Name',
        ));
        $this->setParentList(array(
        ));
        $this->setDependentList(array(
        ));
    }

    /**
     * Sets column id
     *
     * @param mixed $data
     */
    public function setId($data)
    {
        $this->Id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return int
     */
    public function getId()
    {
        return $this->Id ;
    }

    /**
     * Sets column name
     *
     * @param mixed $data
     */
    public function setName($data)
    {
        $this->Name = $data;
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name ;
    }


}

