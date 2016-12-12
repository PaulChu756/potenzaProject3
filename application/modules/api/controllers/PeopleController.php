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
        $zendRequest = new Zend_Controller_Request();

        $request = $zendRequest->getRequest();
        //$id = $request->_getParam('id');
        var_dump($request);

        $this->view->entries = $peopleMapper->find($request, $people);
        
        //$id = $request->getParam('id');
        //$id = $request->_getParam('id');  
    }
}

?>

