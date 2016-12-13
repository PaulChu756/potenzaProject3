<?php

class API_PeopleController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $peopleMapper = new API_Model_PeopleMapper();
        $this->view->entries = $peopleMapper->fetchAll();
    }

    public function getAction()
    {
        $people = new API_Model_People();
        $peopleMapper = new API_Model_PeopleMapper();
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->view->entries = $peopleMapper->find($id, $people);
    }
}

?>
