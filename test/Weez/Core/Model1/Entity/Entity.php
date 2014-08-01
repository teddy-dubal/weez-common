<?php

namespace Weez\Core\Model;

class Entity
{

    /**
     * Set the list of columns associated with this model
     *
     * @param array $data
     * @return self
     */
    public function setColumnsList($data)
    {
        $this->_columnsList = $data;
        return $this;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getColumnsList()
    {
        return $this->_columnsList;
    }

    /**
     * Set the list of relationships associated with this model
     *
     * @param array $data
     * @return self
     */
    public function setParentList($data)
    {
        $this->_parentList = $data;
        return $this;
    }

    /**
     * Returns relationship list array
     *
     * @return array
     */
    public function getParentList()
    {
        return $this->_parentList;
    }

    /**
     * Set the list of relationships associated with this model
     *
     * @param array $data
     * @return self
     */
    public function setDependentList($data)
    {
        $this->_dependentList = $data;
        return $this;
    }

    /**
     * Returns relationship list array
     *
     * @return array
     */
    public function getDependentList()
    {
        return $this->_dependentList;
    }

    /**
     * Converts database column name to php setter/getter function name
     *
     * @param string $column
     * @return self
     */
    public function columnNameToVar($column)
    {
        if (! isset($this->_columnsList[$column])) {
           throw new \Exception("column '$column' not found!");
        }
        return $this->_columnsList[$column];
    }

    /**
     * Converts database column name to PHP setter/getter function name
     *
     * @param string $thevar
     * @return self
     */
    public function varNameToColumn($thevar)
    {
        foreach ($this->_columnsList as $column => $var) {
           if ($var == $thevar) {
               return $column;
           }
        }
        return null;
    }

    /**
     * Array of options/values to be set for this model. Options without a matching
     * method are ignored.
     *
     * @param array $options
     * @return self
     */
    public function setOptions($options)
    {
        $this->exchangeArray($options);
        return $this;
    }


}

