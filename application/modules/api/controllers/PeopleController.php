<?php

class API_PeopleController extends Zend_Controller_Action
{
  public function indexAction()
  {
      if($this->getRequest()->isGet())
      {
        $peopleMapper = new API_Model_PeopleMapper();
        $this->view->entries = $peopleMapper->fetchAll();
      }
      else if($this->getRequest()->isPost())
      {
          $request = $this->getRequest();
          $getPeopleValues = $request->getPost();
          $people = new API_Model_People();
          $people   ->setFirstName($getPeopleValues['firstName'])
                    ->setLastName($getPeopleValues['lastName'])
                    ->setFavoriteFood($getPeopleValues['favoriteFood']);
          $peopleMapper = new API_Model_PeopleMapper();
          $peopleMapper->save($people);
      }
    else
    {
      //echo "Error: "; die();
    }
  }

  public function getAction()
  {
      $people = new API_Model_People();
      $peopleMapper = new API_Model_PeopleMapper();
      $request = $this->getRequest();
      $id = $request->getParam('peopleId');
      $this->view->entries = $peopleMapper->find($id, $people);
  }
}

?>
