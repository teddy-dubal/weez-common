<?php

namespace Weez\Core\Model;

use Weez\Core\Model\Entity;

class Bugs extends Entity
{

    /**
     * @property int $BugId
     */
    protected $BugId = null;

    /**
     * @property string $BugDescription
     */
    protected $BugDescription = null;

    /**
     * @property string $BugStatus
     */
    protected $BugStatus = null;

    /**
     * @property string $ReportedBy
     */
    protected $ReportedBy = null;

    /**
     * @property string $AssignedTo
     */
    protected $AssignedTo = null;

    /**
     * @property string $VerifiedBy
     */
    protected $VerifiedBy = null;

    /**
     * Parent relation
     *
     * @property Weez\Core\Model\Accounts $Accounts_reported_by
     */
    protected $Accounts_reported_by = null;

    /**
     * Parent relation
     *
     * @property Weez\Core\Model\Accounts $Accounts_assigned_to
     */
    protected $Accounts_assigned_to = null;

    /**
     * Parent relation
     *
     * @property Weez\Core\Model\Accounts $Accounts_verified_by
     */
    protected $Accounts_verified_by = null;

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
             'bug_id' => 'BugId',
             'bug_description' => 'BugDescription',
             'bug_status' => 'BugStatus',
             'reported_by' => 'ReportedBy',
             'assigned_to' => 'AssignedTo',
             'verified_by' => 'VerifiedBy',
        ));
        $this->setParentList(array(
         'BugsIbfk1' => array(
             'property' => 'Accounts_reported_by',
             'table_name' => 'Accounts',
         ),
         'BugsIbfk2' => array(
             'property' => 'Accounts_assigned_to',
             'table_name' => 'Accounts',
         ),
         'BugsIbfk3' => array(
             'property' => 'Accounts_verified_by',
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
     * Sets column bug_description
     *
     * @param mixed $data
     */
    public function setBugDescription($data)
    {
        $this->BugDescription = $data;
        return $this;
    }

    /**
     * Gets column bug_description
     *
     * @return string
     */
    public function getBugDescription()
    {
        return $this->BugDescription ;
    }

    /**
     * Sets column bug_status
     *
     * @param mixed $data
     */
    public function setBugStatus($data)
    {
        $this->BugStatus = $data;
        return $this;
    }

    /**
     * Gets column bug_status
     *
     * @return string
     */
    public function getBugStatus()
    {
        return $this->BugStatus ;
    }

    /**
     * Sets column reported_by
     *
     * @param mixed $data
     */
    public function setReportedBy($data)
    {
        $this->ReportedBy = $data;
        return $this;
    }

    /**
     * Gets column reported_by
     *
     * @return string
     */
    public function getReportedBy()
    {
        return $this->ReportedBy ;
    }

    /**
     * Sets column assigned_to
     *
     * @param mixed $data
     */
    public function setAssignedTo($data)
    {
        $this->AssignedTo = $data;
        return $this;
    }

    /**
     * Gets column assigned_to
     *
     * @return string
     */
    public function getAssignedTo()
    {
        return $this->AssignedTo ;
    }

    /**
     * Sets column verified_by
     *
     * @param mixed $data
     */
    public function setVerifiedBy($data)
    {
        $this->VerifiedBy = $data;
        return $this;
    }

    /**
     * Gets column verified_by
     *
     * @return string
     */
    public function getVerifiedBy()
    {
        return $this->VerifiedBy ;
    }


}

