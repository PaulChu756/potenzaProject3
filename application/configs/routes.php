<?php

$route = new Zend_Controller_Router_Route(
    //get all people
    'api/people',
    array(
        'module'        => 'API',
        'controller'    => 'people',
        'action'        => 'index'
    )
);
$router->addRoute('people', $route);
//var_dump($router);

/*
$route = new Zend_Controller_Router_Route(
    //get by id
    'api/people/:id',
    array(
        'module'        => 'API',
        'controller'    => 'people',
        'action'        => 'get'
    )
);
$router->addRoute('id', $route);
*/

?>