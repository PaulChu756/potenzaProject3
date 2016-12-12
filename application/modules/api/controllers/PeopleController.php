<?php

class API_PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $peopleMapper = new API_Model_PeopleMapper();
        $people = new API_Model_People();
        $this->view->entries = $peopleMapper->fetchAll();
        $this->view->entries = $peopleMapper->find(4, $people);
    }
}

?>

