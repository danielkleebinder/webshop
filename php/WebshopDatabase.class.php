<?php

/**
 * Utility class for connecting to the webshop database.
 *
 * @author Daniel Kleebinder
 */
class WebshopDatabase {

    // Database information
    private $host = "localhost";
    private $username = "webshopuser";
    private $password = "CxW3b#77e8>.0ZZ^x0=-Qq*~uuz)1;(";
    private $dbname = "webshop";
    private $connection;
    // Create statements
    private $stmt_create_user;
    private $stmt_create_user_admin;
    // Select statements
    private $stmt_get_user_by_id_and_pw;
    private $stmt_get_username_by_id;
    // Aggregation function statements
    private $stmt_username_available;
    // Update statements
    private $stmt_update_user_password;
    private $stmt_update_user_firstname;
    private $stmt_update_user_lastname;
    private $stmt_update_user_email;
    private $stmt_update_product;
    // Delete statements
    private $stmt_delete_product;
    // Save statements
    private $stmt_save_product;

    private function check_connection() {
        if (!$this->is_connected()) {
            $this->connect();
        }
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_errno) {
            echo 'Could not establish connection to database: ' . $this->connection->connect_error;
            exit();
        }
        if (!$this->connection->ping()) {
            echo 'No response from database: ' . $this->connection->error;
            exit();
        }

        $this->stmt_create_user = $this->connection->prepare("Insert Into user (username, pwd, vorname, nachname, email, is_admin, is_ldap) Values (?, ?, ?, ?, ?, false, false)");
        $this->stmt_create_user_admin = $this->connection->prepare("Insert Into user (username, vorname, nachname, email, is_admin, is_ldap) Values (?, ?, ?, ?, true, true)");
        $this->stmt_get_user_by_id_and_pw = $this->connection->prepare("Select username, pwd, vorname, nachname, email, is_admin, is_ldap From user Where username=? And pwd=? Limit 1");
        $this->stmt_get_username_by_id = $this->connection->prepare("Select username From user Where username=? Limit 1");
        $this->stmt_get_product_by_id = $this->connection->prepare("Select id, name, description, rating, imgpath, price From product Where id=? Limit 1");
        $this->stmt_username_available = $this->connection->prepare("Select count(*) From user Where username=?");
        $this->stmt_update_user_password = $this->connection->prepare("Update user Set pwd=? Where username=?");
        $this->stmt_update_user_firstname = $this->connection->prepare("Update user Set vorname=? Where username=?");
        $this->stmt_update_user_lastname = $this->connection->prepare("Update user Set nachname=? Where username=?");
        $this->stmt_update_user_email = $this->connection->prepare("Update user Set email=? Where username=?");
        $this->stmt_update_product = $this->connection->prepare("Update product Set name=?, description=?, rating=?, imgpath=?, price=? Where id=?");
        $this->stmt_delete_product = $this->connection->prepare("Delete From product Where id=?");
        $this->stmt_save_product = $this->connection->prepare("Insert Into product (name, description, rating, imgpath, price) Values (?, ?, ?, ?, ?)");
    }

    public function disconnect() {
        if ($this->is_connected()) {
            $this->stmt_create_user->close();
            $this->stmt_create_user_admin->close();
            $this->stmt_get_user_by_id_and_pw->close();
            $this->stmt_get_username_by_id->close();
            $this->stmt_update_user_password->close();
            $this->stmt_update_user_firstname->close();
            $this->stmt_update_user_lastname->close();
            $this->stmt_update_user_email->close();

            $this->connection->close();
            $this->connection = NULL;
        }
    }

    private function is_connected() {
        return $this->connection;
    }

    public function all_products() {
        $this->check_connection();

        $set = $this->connection->query("Select * From product");
        $result = array();

        while ($line = $set->fetch_object()) {
            $product = new Product($line->name, $line->description, $line->rating, $line->imgpath, $line->price);
            $product->set_id($line->id);
            array_push($result, $product);
        }

        return $result;
    }

    public function update_product($product) {
        $this->check_connection();

        $id = $product->get_id();
        $name = $product->get_name();
        $desc = $product->get_description();
        $rating = $product->get_rating();
        $img = $product->get_imgpath();
        $price = $product->get_price();

        $this->stmt_update_product->bind_param("ssisdi", $name, $desc, $rating, $img, $price, $id);
        $this->stmt_update_product->store_result();
        return $this->stmt_update_product->execute();
    }

    public function delete_product_by_id($id) {
        $this->check_connection();
        $this->stmt_delete_product->bind_param("i", $id);
        return $this->stmt_delete_product->execute();
    }

    public function delete_product($product) {
        $this->check_connection();
        $id = $product->get_id();
        $this->stmt_delete_product->bind_param("i", $id);
        return $this->stmt_delete_product->execute();
    }

    public function save_product($product) {
        $this->check_connection();

        $name = $product->get_name();
        $desc = $product->get_description();
        $rating = $product->get_rating();
        $img = $product->get_imgpath();
        $price = $product->get_price();

        $this->stmt_save_product->bind_param("ssisd", $name, $desc, $rating, $img, $price);
        $result = $this->stmt_save_product->execute();
        if ($result) {
            $product->set_id($this->connection->insert_id);
        }
        return $result;
    }

    public function get_product_by_id($id) {
        $this->check_connection();
        $this->stmt_get_product_by_id->bind_param("i", $id);
        if ($this->stmt_get_product_by_id->execute()) {
            $this->stmt_get_product_by_id->bind_result($i, $n, $d, $r, $imp, $p);
            $this->stmt_get_product_by_id->store_result();
            $this->stmt_get_product_by_id->fetch();

            $product = new Product($n, $d, $r, $imp, $p);
            $product->set_id($i);
            return $product;
        }
        return NULL;
    }

    public function is_username_available($username) {
        $this->check_connection();
        $usr_stl = strtolower($username);
        $this->stmt_username_available->bind_param("s", $usr_stl);
        if ($this->stmt_username_available->execute()) {
            $this->stmt_username_available->bind_result($count);
            $this->stmt_username_available->fetch();
            return $count <= 0;
        }
        return true;
    }

    public function create_user($username, $password, $firstname, $lastname, $email) {
        $this->check_connection();

        $username_stl = strtolower($username);
        $password_md5 = md5($password);

        $this->stmt_create_user->bind_param("sssss", $username_stl, $password_md5, $firstname, $lastname, $email);
        return $this->stmt_create_user->execute();
    }

    public function update_user($username, $password, $firstname, $lastname, $email) {
        $this->check_connection();

        if (!$this->update_user_password($username, $password)) {
            return false;
        }
        if (!$this->update_user_firstname($username, $firstname)) {
            return false;
        }
        if (!$this->update_user_lastname($username, $lastname)) {
            return false;
        }
        if (!$this->update_user_email($username, $email)) {
            return false;
        }

        return true;
    }

    public function update_user_password($username, $password) {
        $this->check_connection();
        if (Utils::is_valid_string($password)) {
            $usr_stl = strtolower($username);
            $pwd_md5 = md5($password);
            $this->stmt_update_user_password->bind_param("ss", $pwd_md5, $usr_stl);
            return $this->stmt_update_user_password->execute();
        }
        return true;
    }

    public function update_user_firstname($username, $firstname) {
        $this->check_connection();
        if (Utils::is_valid_string($firstname)) {
            $usr_stl = strtolower($username);
            $this->stmt_update_user_firstname->bind_param("ss", $firstname, $usr_stl);
            return $this->stmt_update_user_firstname->execute();
        }
        return true;
    }

    public function update_user_lastname($username, $lastname) {
        $this->check_connection();
        if (Utils::is_valid_string($lastname)) {
            $usr_stl = strtolower($username);
            $this->stmt_update_user_lastname->bind_param("ss", $lastname, $usr_stl);
            return $this->stmt_update_user_lastname->execute();
        }
        return true;
    }

    public function update_user_email($username, $email) {
        $this->check_connection();
        if (Utils::is_valid_string($email)) {
            $usr_stl = strtolower($username);
            $this->stmt_update_user_email->bind_param("ss", $email, $usr_stl);
            return $this->stmt_update_user_email->execute();
        }
        return true;
    }

    public function create_ldap_user($username, $firstname, $lastname, $email) {
        $this->check_connection();

        $username_stl = strtolower($username);

        $this->stmt_get_username_by_id->bind_param("s", $username_stl);
        $this->stmt_get_username_by_id->execute();
        $this->stmt_get_username_by_id->store_result();

        // User already in database
        if ($this->stmt_get_username_by_id->num_rows != 0) {
            return false;
        }

        // Write user to database
        $this->stmt_create_user_admin->bind_param("ssss", $username_stl, $firstname, $lastname, $email);
        return $this->stmt_create_user_admin->execute();
    }

    public function login($usr, $password) {
        $this->check_connection();

        $usr_stl = strtolower($usr);
        $pwd_md5 = md5($password);

        $this->stmt_get_user_by_id_and_pw->bind_param("ss", $usr_stl, $pwd_md5);
        if ($this->stmt_get_user_by_id_and_pw->execute()) {
            $this->stmt_get_user_by_id_and_pw->bind_result($username, $pwd, $vorname, $nachname, $email, $is_admin, $is_ldap);
            $this->stmt_get_user_by_id_and_pw->store_result();
            $this->stmt_get_user_by_id_and_pw->fetch();

            if ($this->stmt_get_user_by_id_and_pw->num_rows == 1) {
                $result = new User();
                $result->set_username($username);
                $result->set_password($pwd);
                $result->set_firstname($vorname);
                $result->set_lastname($nachname);
                $result->set_email($email);
                $result->set_admin($is_admin);
                $result->set_ldap($is_ldap);
                return $result;
            }
        }
        return NULL;
    }

    public function fetch_error() {
        return $this->connection->error;
    }

}
