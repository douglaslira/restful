<?php

/**
 * This file define error controller system.
 *
 * @package Restful
 * @category Controller
 * @name ErrorController
 * @author Douglas Lira <douglas.lira.web@gmail.com>
 * @copyright 2014
 * @license MIT
 * @link https://github.com/douglaslira/restfull
 * @version 0.1
 * @since 28/09/2014
 */

class Api_ErrorController extends REST_Controller {

    public function errorAction() {
        if ($this->_request->hasError()) {
            $error = $this->_request->getError();
            $this->view->message = $error->message;
            $this->getResponse()->setHttpResponseCode($error->code);
            return;
        }

        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
            $this->view->message = 'Page not found';
            $this->getResponse()->setHttpResponseCode(404);
            break;

            default:
                // application error
            $this->view->message = 'Application error';
            $this->getResponse()->setHttpResponseCode(500);
            break;
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception->getMessage();
        }
    }

    public function deniedAction() {
        $this->view->message = 'Não autorizado';
        $this->getResponse()->setHttpResponseCode(405);
    }
    
    public function authAction() {
        $this->view->message = 'Acesso negado';
        $this->getResponse()->setHttpResponseCode(401);
    }

    /**
     * Catch-All
     * useful for custom HTTP Methods
     *
     * */
    public function __callAction() {
        
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction() {
        
    }

    /**
     * GET Action
     *
     * @return void
     */
    public function getAction() {
        
    }

    /**
     * POST Action
     *
     * @return void
     */
    public function postAction() {
        
    }

    /**
     * PUT Action
     *
     * @return void
     */
    public function putAction() {
        
    }

    /**
     * DELETE Action
     *
     * @return void
     */
    public function deleteAction() {
        
    }

}
