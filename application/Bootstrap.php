<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function _initREST() {
        $frontController = Zend_Controller_Front::getInstance();

        // set custom request object
        $frontController->setRequest(new REST_Request);
        $frontController->setResponse(new REST_Response);

        // add the REST route for the API module only
        $restRoute = new Zend_Rest_Route($frontController, array(), array('api'));
        $frontController->getRouter()->addRoute('rest', $restRoute);
    }

    protected function _initAutoload() {
        // Autoload
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);
        return $autoloader;
    }

    protected function _initConfiguration() {
        $config = $this->getApplication()->getOptions();
        if (APPLICATION_ENV == 'development') {
            if (isset($config['phpSettings'])) {
                foreach ($config['phpSettings'] as $setting => $value) {
                    ini_set($setting, $value);
                }
            }
        }

        set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/models'),
            realpath(APPLICATION_PATH . '/services'),
            get_include_path(),
        )));

        Zend_Registry::set('KEY', '46196053844814367107123');
    }

    protected function _initDatabase() {
        $options = $this->getApplication()->getOptions();
        $db = Zend_Db::factory($options['database']['adapter'], $options['database']['params']);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Registry::set('DB', $db);

        return $db;
    }

}
