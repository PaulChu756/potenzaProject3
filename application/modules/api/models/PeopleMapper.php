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

    public function getPeopleVisits($id)
    {
      $host = "localhost";
      $user = "root";
      $password = "root";
      $database = "myDB";

      $connection = mysqli_connect($host, $user, $password);
      if(!$connection){
      die("Could not connect: " . mysqli_connect_error());}
      $connection->select_db($database);

      $sql = "SELECT p.id, p.firstname, p.lastname, s.statename, p.food, v.date_visited
  		FROM Visits v
  		INNER JOIN People p ON v.p_id = p.id
  		INNER JOIN States s ON v.s_id = s.id
  		WHERE v.p_id =" . $id;

      $query = mysqli_query ($connection, $sql) or die(mysqli_error($connection));
  		$row = mysqli_fetch_array($query);

      $id = $row["id"];
  		$firstName = $row["firstname"];
      $lastName = $row["lastname"];
      $foodName = $row["food"];
  		$stateName = $row["statename"];
      $dateVisit = $row["date_visited"];

      while($row = mysqli_fetch_array($query))
      {
        $stateName = $row["statename"];
      }

      $resultArray[] =
      [
          'id'            => $id,
          'firstname'     => $firstName,
          'lastname'      => $lastName,
          'food'          => $foodName,
          'statename'     => $stateName,
          'date_visited'  => $dateVisit
      ];

      echo json_encode($resultArray, JSON_PRETTY_PRINT);
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

    public function find($id, API_Model_People $people)
    {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            echo "invalid get request";
            return;
        }
        $row = $result->current();
        $people->setId($row->id)
                ->setFirstName($row->firstname)
                ->setLastName($row->lastname)
                ->setFavoriteFood($row->food);

        $resultArray[] =
        [
            'id'        => $people->id,
            'firstname' => $people->firstname,
            'lastname'  => $people->lastname,
            'food'      => $people->favoritefood
        ];

        echo json_encode($resultArray, JSON_PRETTY_PRINT);
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
