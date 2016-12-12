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
        $people = new API_Model_PeopleMapper();
        $entry = new API_Model_People();
        //$this->view->entries = $people->fetchAll();
        $this->view->entries = $people->find(5, $entry);
    }
}

?>

