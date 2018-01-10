<?php

/**
 * LDAP connection class.
 *
 * @author Daniel Kleebinder
 */
class TechnikumLDAP {

    private $server_name = 'ldap.technikum-wien.at';
    private $search_base = 'dc=technikum-wien,dc=at';

    public function login($username, $password) {
        $ds = ldap_connect($this->server_name);
        if (!$ds) {
            return NULL;
        }

        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

        if (ldap_start_tls($ds)) {
            $dn = 'ou=People,' . $this->search_base;
            $ldap_bind = @ldap_bind($ds, 'uid=' . $username . ',' . $dn, $password);

            if ($ldap_bind) {
                $filter = "(uid=$username)";
                $user_info = array('ou', 'uid', 'sn', 'givenname', 'mail');
                $search_results = ldap_search($ds, $dn, $filter, $user_info);
                $info = ldap_get_entries($ds, $search_results);

                $result = new User();
                $result->set_username($info[0]['uid'][0]);
                $result->set_firstname($info[0]['givenname'][0]);
                $result->set_lastname($info[0]['sn'][0]);
                $result->set_email($info[0]['mail'][0]);
                $result->set_admin(true);
                $result->set_ldap(true);
                return $result;
            }
            ldap_close($ds);
        }
        return NULL;
    }

}
