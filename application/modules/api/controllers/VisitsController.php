<?php

class API_VisitsController extends Zend_Controller_Action
{
  public function indexAction()
  {
      $visitsMapper = new API_Model_VisitsMapper();
      $this->view->entries = $visitsMapper->fetchAll();
  }

  public function getAction()
  {
      $visits = new API_Model_Visits();
      $visitsMapper = new API_Model_VisitsMapper();
      $request = $this->getRequest();
      $id = $request->getParam('visitId');
      $this->view->entries = $visitsMapper->find($id, $visits);
  }
}

?>
