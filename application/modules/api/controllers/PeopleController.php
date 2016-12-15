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

          $firstName = $getPeopleValues['firstName'];
          $lastName = $getPeopleValues['lastName'];
          $favFood = $getPeopleValues['favoriteFood'];

          if(empty($firstName) || empty($lastName) || empty($favFood))
          {
            throw new Exception("Please fill out all inputs", 1);
          }

          $people   ->setFirstName($firstName)
                    ->setLastName($lastName)
                    ->setFavoriteFood($favFood);
          $peopleMapper = new API_Model_PeopleMapper();
          $peopleMapper->save($people);
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
