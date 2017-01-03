<?php

// just route api to api
$apiRoute = new Zend_Controller_Router_Route(
    'api',
    array(
        'module'        => 'api',
        'controller'    => 'index',
        'action'        => 'index'
    )
);
$router->addRoute('api', $apiRoute);


//get all people
$peopleRoute = new Zend_Controller_Router_Route(
    'api/people',
    array(
        'module'        => 'api',
        'controller'    => 'people',
        'action'        => 'index'
    )
);
$router->addRoute('people', $peopleRoute);

//get a person by id
$personRoute = new Zend_Controller_Router_Route(
    'api/people/:peopleId',
    array(
        'module'        => 'api',
        'controller'    => 'people',
        'action'        => 'get'
    )
);
$router->addRoute('peopleId', $personRoute);


//get all states
$statesRoute = new Zend_Controller_Router_Route(
    'api/states',
    array(
        'module'        => 'api',
        'controller'    => 'states',
        'action'        => 'index'
    )
);
$router->addRoute('states', $statesRoute);

//get a states by id
$stateRoute = new Zend_Controller_Router_Route(
    'api/states/:stateId',
    array(
        'module'        => 'api',
        'controller'    => 'states',
        'action'        => 'get'
    )
);
$router->addRoute('statesId', $stateRoute);


//get all visits
$visitsRoute = new Zend_Controller_Router_Route(
    'api/visits',
    array(
        'module'        => 'api',
        'controller'    => 'visits',
        'action'        => 'index'
    )
);
$router->addRoute('visits', $visitsRoute);

//get a visits by id
$visitRoute = new Zend_Controller_Router_Route(
    'api/visits/:visitId',
    array(
        'module'        => 'api',
        'controller'    => 'visits',
        'action'        => 'get'
    )
);
$router->addRoute('visitId', $visitRoute);

?>
