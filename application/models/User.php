<?php

/**
 * This file define user model system.
 *
 * @package Restfull
 * @category Model
 * @name User
 * @author Douglas Lira <douglas.lira.web@gmail.com>
 * @copyright 2014
 * @license MIT
 * @link https://github.com/douglaslira/restfull
 * @version 0.1
 * @since 28/09/2014
 */

class User {

    /**
     * Authenticate user in the system.
     *
     * @param string $login
     * @param string $password
     * @return array $result
     */
    public function auth($login, $password) {
        $userService = new UserService();
        $result = $userService->auth($login, $password);
        return $result;
    }

}
