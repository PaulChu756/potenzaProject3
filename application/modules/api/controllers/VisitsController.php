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
      $visits   ->setP_Id($getVisitsValues['humanNameDropDown'])
                ->setS_Id($getVisitsValues['stateNameDropDown'])
                ->setDate_Visited($getVisitsValues['dateVisit']);
      $visitsMapper = new API_Model_VisitsMapper();
      $visitsMapper->save($visits);
    }
    else
    {
      //echo "Error: "; die();
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
