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
        echo "visits api controller";
        $visits = new API_Model_VisitsMapper();
        $this->view->entries = $visits->fetchAll();
    }
}

