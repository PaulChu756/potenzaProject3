<?php

class Api_PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        echo "people controller";
        $people = new API_Model_PeopleMapper();
        $this->view->entries = $people->fetchAll();
    }
}

?>

