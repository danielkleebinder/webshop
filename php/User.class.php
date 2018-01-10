<?php

/**
 * Simple user model class.
 *
 * @author Daniel Kleebinder
 */
class User {

    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $email;
    private $admin;
    private $ldap;

    function set_username($username) {
        $this->username = $username;
    }

    function get_username() {
        return $this->username;
    }

    function set_password($password) {
        $this->password = $password;
    }

    function get_password() {
        return $this->password;
    }

    function set_firstname($firstname) {
        $this->firstname = $firstname;
    }

    function get_firstname() {
        return $this->firstname;
    }

    function set_lastname($lastname) {
        $this->lastname = $lastname;
    }

    function get_lastname() {
        return $this->lastname;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function get_email() {
        return $this->email;
    }

    function set_admin($admin) {
        $this->admin = $admin;
    }

    function is_admin() {
        return $this->admin;
    }

    function set_ldap($ldap) {
        $this->ldap = $ldap;
    }

    function is_ldap() {
        return $this->ldap;
    }

}
