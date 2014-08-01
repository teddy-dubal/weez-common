<?php

namespace Weez\Core\Model;

use Weez\Core\Model\Entity;

class Accounts extends Entity
{

    /**
     * @property string $AccountName
     */
    protected $AccountName = null;

    /**
     * Dependent relation 
     *
     * Type:  One-to-Many relationship
     *
     * @property Weez\Core\Model\Bugs $BugsByReportedBy
     */
    protected $BugsByReportedBy = null;

    /**
     * Dependent relation 
     *
     * Type:  One-to-Many relationship
     *
     * @property Weez\Core\Model\Bugs $BugsByAssignedTo
     */
    protected $BugsByAssignedTo = null;

    /**
     * Dependent relation 
     *
     * Type:  One-to-Many relationship
     *
     * @property Weez\Core\Model\Bugs $BugsByVerifiedBy
     */
    protected $BugsByVerifiedBy = null;

    /**
     * Sets up column and relationship lists
     *
     * @param Adapter $adapter
     * @param Entity $entity
     */
    public function __construct()
    {
        $this->setColumnsList(array(
             'account_name' => 'AccountName',
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

    /**
     * Sets column account_name
     *
     * @param mixed $data
     */
    public function setAccountName($data)
    {
        $this->AccountName = $data;
        return $this;
    }

    /**
     * Gets column account_name
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->AccountName ;
    }


}

