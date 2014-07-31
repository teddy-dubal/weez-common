<?php

namespace Weez\Core\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Pimple;
use Zend\Db\Adapter\Adapter;

/**
 * Application Model DbTables
 *
 * @package Weez\Core\Model
 * @author T.ED <teddy.dubal@gmail.com>
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Manager extends AbstractTableGateway
{

    protected $entity = null;

    protected $container = null;

    /**
     * Constructor
     *
     * @param Adapter $adapter
     * @param Entity $entity
     */
    public function __construct(Adapter $adapter, Entity $entity)
    {
        $this->adapter = $adapter;
        $this->entity = $entity;
        $this->featureSet = new Feature\FeatureSet();
        $this->initialize();
    }

    /**
     * Inject container
     *
     * @param Pimple $c
     * @return self
     */
    public function setContainer(Pimple $c)
    {
        $this->container = $c;
        return $this;
    }

    /**
     * @return Pimple
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return self
     */
    public function all()
    {
        return $this->select();
    }

    /**
     * @return array|string
     */
    public function getPrimaryKeyName()
    {
        return $this->id;
    }

    /**
     * @return array|string
     */
    public function getTableName()
    {
        return $this->id;
    }

    /**
     * Saves current row, and optionally dependent rows
     *
     * @param Entity $entity
     * @return int
     */
    public function save(Entity $entity)
    {
        $data = $entity->toArray();
        $returnId = false;
        $id = (int)$data[$this->id];
        if ($id == 0) {
           $this->insert($data);
           $returnId = $this->getLastInsertValue();
        } else {
           if ($this->find($id)) {
               $returnId = $id;
               $this->update($data, array($this->id => $id));
           } else {
               throw new \Exception('Form id does not exit');
           }
        }
        return $returnId;
    }

    /**
     * Converts database column name to php setter/getter function name
     *
     * @param Entity $entity
     * @param boolean $useTransaction
     * @return int
     */
    abstract public function deleteEntity(Entity $entity, $useTransaction = true);

}

