<?php

/**
 * This file define foo controller system.
 *
 * @package Restful
 * @category Controller
 * @name FooController
 * @author Douglas Lira <douglas.lira.web@gmail.com>
 * @copyright 2014
 * @license MIT
 * @link https://github.com/douglaslira/restfull
 * @version 0.1
 * @since 29/09/2014
 */

class Api_FooController extends REST_Controller
{
    public function indexAction()
    {
        $this->view->message = 'indexAction has been called.';
        $this->_response->ok();
    }

    public function headAction()
    {
        $this->view->message = 'headAction has been called';
        $this->_response->ok();
    }

    public function getAction()
    {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->message = sprintf('Resource #%s', $id);
        $this->_response->ok();
    }

    public function postAction()
    {
        $this->view->params = $this->_request->getParams();
        $this->view->message = 'Resource Created';
        $this->_response->created();
    }

    public function putAction()
    {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->params = $this->_request->getParams();
        $this->view->message = sprintf('Resource #%s Updated', $id);
        $this->_response->ok();
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->message = sprintf('Resource #%s Deleted', $id);
        $this->_response->ok();
    }

}
