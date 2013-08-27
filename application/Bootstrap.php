<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
    function _initViewRes(){
        $this->bootstrap('view');
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        return $view;
    }

}

