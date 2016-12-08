<?php

class Api_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH.'/application/modules'));
            return $autoloader;
    }
}

?>