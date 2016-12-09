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
        echo "states api controller";
        $states = new API_Model_StatesMapper();
        $this->view->entries = $states->fetchAll();
    }
}

