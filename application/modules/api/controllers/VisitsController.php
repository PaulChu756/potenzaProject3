<?php

class API_VisitsController extends Zend_Controller_Action
{
  public function indexAction()
  {
    if($this->getRequest()->isGet())
    {
      $visitsMapper = new API_Model_VisitsMapper();
      $this->view->entries = $visitsMapper->fetchAll();
    }
    else if($this->getRequest()->isPost())
    {
      $request = $this->getRequest();
      $getVisitsValues = $request->getPost();
      $visits = new API_Model_Visits();

      $humanName = $getVisitsValues['humanNameDropDown'];
      $stateName = $getVisitsValues['stateNameDropDown'];
      $dataVisit = $getVisitsValues['dateVisit'];

      if(empty($humanName) || empty($stateName) || empty($dataVisit))
      {
        throw new Exception("Please fill out all inputs", 1);
      }

      $visits   ->setP_Id($humanName)
                ->setS_Id($stateName)
                ->setDate_Visited($dataVisit);
      $visitsMapper = new API_Model_VisitsMapper();
      $visitsMapper->save($visits);
    }
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
