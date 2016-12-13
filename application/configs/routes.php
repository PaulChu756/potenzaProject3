<?php

// just route API to api
$route = new Zend_Controller_Router_Route(
    'api',
    array(
        'module'        => 'API',
        'controller'    => 'index',
        'action'        => 'index'
    )
);
$router->addRoute('api', $route);

//get all people
$route = new Zend_Controller_Router_Route(
    'api/people',
    array(
        'module'        => 'API',
        'controller'    => 'people',
        'action'        => 'index'
    )
);
$router->addRoute('people', $route);

//get by id
$route = new Zend_Controller_Router_Route(
    'api/people/:id',
    array(
        'module'        => 'API',
        'controller'    => 'people',
        'action'        => 'get'
    )
);
$router->addRoute('id', $route);

?>
