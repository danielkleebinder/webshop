<?php

include_once './php/User.class.php';
include_once './php/Product.class.php';

include_once './php/WebshopDatabase.class.php';
include_once './php/TechnikumLDAP.class.php';

/**
 * Login system for handling LDAP and Database logins.
 *
 * @author Daniel Kleebinder
 */
class UserSystem {

    private $database;
    private $ldap;

    public function get_database() {
        if (!$this->database) {
            $this->database = new WebshopDatabase();
        }
        return $this->database;
    }

    public function get_ldap() {
        if (!$this->ldap) {
            $this->ldap = new TechnikumLDAP();
        }
        return $this->ldap;
    }

    public function login($username, $password) {
        $result_db = $this->get_database()->login($username, $password);
        if ($result_db) {
            return $result_db;
        }

        $result_ldap = $this->get_ldap()->login($username, $password);
        if ($result_ldap) {
            $this->get_database()->create_ldap_user($result_ldap->get_username(), $result_ldap->get_firstname(), $result_ldap->get_lastname(), $result_ldap->get_email());
            return $result_ldap;
        }

        return NULL;
    }

    public function disconnect() {
        $this->get_database()->disconnect();
    }

}
