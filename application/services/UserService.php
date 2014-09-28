<?php

/**
 * This file define user service system.
 *
 * @package Restful
 * @category Services
 * @name UserService
 * @author Douglas Lira <douglas.lira.web@gmail.com>
 * @copyright 2014
 * @license MIT
 * @link https://github.com/douglaslira/restfull
 * @version 0.1
 * @since 28/09/2014
 */

class UserService extends Zend_Db_Table_Abstract {

  protected $_name = 'tab_user';
  protected $_primary = 'id';

    /**
     * Insert user
     *
     * @param array $fields
     * @return boolean
     */
    public function insert(array $fields) {

      $result = array();

      try {
        $data = $this->rows($fields);
        $result['id'] = parent::insert($data);
        $result['result'] = true;
      } catch (Zend_Db_Exception $e) {
        $result['erromsg'] = $e->getMessage();
        $result['result'] = false;
      }
      return $result;
    }

    /**
     * Update user
     *
     * @param array $fields
     * @return boolean
     */
    public function update(array $fields, $where) {

      $result = array();

      try {
        $data = $this->rows($fields);
        parent::update($data, $where);
        $result['result'] = true;
      } catch (Zend_Db_Exception $e) {
        $result['erromsg'] = $e->getMessage();
        $result['result'] = false;
      }
      return $result;
    }

    /**
     * Get fields
     *
     * @param array $fields
     * @return array $cols
     */
    public function rows(array $fields) {

      $cols = array();

      foreach ($fields as $coluna => $valor) {
        if (in_array($coluna, $this->_getCols())) {
          if ($valor != "") {
            $cols[$coluna] = $valor;
          }
        }
      }
      return $cols;
    }

    /**
     * Auth User
     *
     * @param string $login
     * @param string $senha
     * @return array $arrayResult
     */
    public function auth($login, $senha){

      $db = Zend_Registry::get('DB');
      $key = Zend_Registry::get('KEY');

      $authAdapter = new Zend_Auth_Adapter_DbTable($db);
      $authAdapter->setTableName('tab_user');
      $authAdapter->setIdentityColumn('login');
      $authAdapter->setCredentialColumn('password');
      $authAdapter->setCredentialTreatment('SHA1(?)');
      $authAdapter->setIdentity($login);
      $authAdapter->setCredential($senha);

      $auth = Zend_Auth::getInstance();
      $result = $auth->authenticate($authAdapter);

      $arrayResult = array();

      if ($result->isValid()) {
        $data = $authAdapter->getResultRowObject(null, 'password');
        $auth->getStorage()->write($data);
        //.....................................
        $arrayResult["result"] = true;
        $arrayResult["erromsg"] = null;
        // TOKEN ..............................
        $token = array("id" => $data->id, "profile" => $data->profile);
        $jwt = JWT::encode($token, $key);
        //.....................................
        $arrayResult["token"] = $jwt;
        //.....................................
      } else {
        $arrayResult["result"] = false;
        $arrayResult["erromsg"] = "Invalid login data!";
      }

      return $arrayResult;

    }

  }