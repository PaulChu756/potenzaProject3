<?php

class API_VisitsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $visitsMapper = new API_Model_VisitsMapper();
        $visits = new API_Model_Visits();
        $this->view->entries = $visitsMapper->fetchAll();
        $this->view->entries = $visitsMapper->find(4, $visits);
    }
}

