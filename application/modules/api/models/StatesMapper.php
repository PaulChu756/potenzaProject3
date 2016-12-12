<?php

class API_Model_StatesMapper
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
            $this->setDbTable('API_Model_DbTable_States');
        }
        return $this->_dbTable;
    }

    public function save(API_Model_States $states)
    {
        $data = array(
            'id'            => $states->getId(),
            'stateabb'      => $states->getStateAbb(),
            'statename'     => $states->getStateName(),
        );

        if(null === ($id = $states->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        }
        else
        {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, API_Model_States $states)
    {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            echo "invalid get request";
            return;
        }
        $row = $result->current();
        $states->setId($row->id)
                ->setStateAbb($row->stateabb)
                ->setStateName($row->statename);

        $resultArray[] = 
        [
            'id'        => $states->id,
            'stateabb'  => $states->stateabb,
            'statename' => $states->statename
        ];

        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach($resultSet as $row)
        {
            $entry = new API_Model_States();
            $entry->setId($row->id)
                    ->setStateAbb($row->stateabb)
                    ->setStateName($row->statename);
            $entries[] = $entry;
        }

        foreach($entries as $entryObj)
        {
            $resultArray[] = 
            [
                'id'        => $entryObj->id,
                'stateabb' => $entryObj->stateAbb,
                'statename'  => $entryObj->stateName
            ];
        }
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }
}
?>

