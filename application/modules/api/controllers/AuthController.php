<?php

/**
 * This file define auth controller system.
 *
 * @package Restful
 * @category Controller
 * @name AuthController
 * @author Douglas Lira <douglas.lira.web@gmail.com>
 * @copyright 2014
 * @license MIT
 * @link https://github.com/douglaslira/restfull
 * @version 0.1
 * @since 28/09/2014
 */

class Api_AuthController extends REST_Controller {

    public function indexAction() {
        $act = $this->_getParam('act', 'logout');
        if ($act == "logout") {
            Zend_Auth::getInstance()->clearIdentity();
        }
        $this->view->result = true;
        $this->_response->ok();
    }

    public function headAction() {
        $this->view->message = 'headAction called';
        $this->_response->ok();
    }

    public function getAction() {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->message = sprintf('Param get #%s', $id);
        $this->_response->ok();
    }

    public function postAction() {

        $login = $this->_getParam('username');
        $senha = $this->_getParam('password');

        $userModel = new User();
        $resultado = $userModel->auth($login, $senha);

        $this->view->resultado = $resultado;
        $this->_response->ok();
    }

    public function putAction() {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->params = $this->_request->getParams();
        $this->view->message = sprintf('Param #%s Updated', $id);
        $this->_response->ok();
    }

    public function deleteAction() {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->message = sprintf('Param #%s Deleted', $id);
        $this->_response->ok();
    }

}
