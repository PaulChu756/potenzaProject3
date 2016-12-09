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
            throw new Exception('Invalid table data gateway provided');
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
            'id'            => $people->getId(),
            'firstname'     => $people->getFirstName(),
            'lastname'      => $people->getLastName(),
            'food'          => $people->getFavoriteFood(),
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

    public function getPeople($id=0)
    {
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $segments = explode('/', $requestURI['path']);
        $apiVars = [];

        $i = 2;
        while($i < count($segments)) 
        {    
            if($segments[$i+1])
            {  
                $apiVars[$segments[$i]] = $segments[$i+1];  
                $i += 2;    
            }
            else 
            {  
                $apiVars[$segments[$i]] = null;  
                $i++;    
            }
        }

        header('Content-Type: application/json');

        /*
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            return;
        }
        $row = $result->current();
        $people->setId($row->id)
                ->setFirstName($row->firstname)
                ->setLastName($row->lastname)
                ->setFavoriteFood($row->food);
        */
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach($resultSet as $row)
        {
            $entry = new API_Model_People();
            $entry->setId($row->id)
                    ->setFirstName($row->firstname)
                    ->setLastName($row->lastname)
                    ->setFavoriteFood($row->food);
            $entries[] = $entry;
        }

        foreach($entries as $entryObj)
        {
            $resultArray[] = 
            [
                'id'        => $entryObj->id,
                'firstname' => $entryObj->firstname,
                'lastname'  => $entryObj->lastname,
                'food'      => $entryObj->favoritefood
            ];
        }
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }
}

?>
