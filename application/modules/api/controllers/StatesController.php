<?php

class API_StatesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $statesMapper = new API_Model_StatesMapper();
        $states = new API_Model_States();
        $this->view->entries = $statesMapper->fetchAll();
        $this->view->entries = $statesMapper->find(5, $states);
    }
}

