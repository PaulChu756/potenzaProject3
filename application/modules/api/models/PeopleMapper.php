<?php

class API_Model_PeopleMapper
{

    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if(is_string($dbTable))
        {
            $dbTable = new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_Abstract)
        {
            throw new Exception("Invalid table data gateway provided");
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbTable()
    {
        if( null === $this->_dbTable)
        {
            $this->setDbTable('API_Model_DbTable_People');
        }
        return $this->_dbTable;
    }

    public function save(API_Model_People $people)
    {
        $data = array(
            'firstName' => $people->getFirstName(),
            'lastName' => $people->getLastName(),
            'favoriteFood' => $people->getFavoriteFood(),
        );

        if(null === ($id = $people->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        }
        else
        {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, API_Model_People $people)
    {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            return;
        }
        $row = $result->current();
        $people->setId($row->id)
                ->setFirstName($row->firstName)
                ->setLastName($row->lastName)
                ->setFavoriteFood($row->favoriteFood);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchall;
        $entries = array();
        foreach($resultSet as $row)
        {
            $entry = new API_Model_People();
            $entry->setId($row-id)
                    ->setFirstName($row->firstName)
                    ->setLastName($row->lastName)
                    ->setFavoriteFood($row->favoriteFood);
            $entries[] = $entry;
        }
        return $entries;
    }
}

?>
