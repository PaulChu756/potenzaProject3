<?php

class API_StatesController extends Zend_Controller_Action
{
  public function indexAction()
  {
      $statesMapper = new API_Model_StatesMapper();
      $this->view->entries = $statesMapper->fetchAll();
  }

  public function getAction()
  {
      $states = new API_Model_States();
      $statesMapper = new API_Model_StatesMapper();
      $request = $this->getRequest();
      $id = $request->getParam('stateId');
      $this->view->entries = $statesMapper->find($id, $states);
  }
}

?>
