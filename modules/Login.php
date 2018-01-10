<div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        // Initialize and define all variables
        $user_system = new UserSystem();
        $username = NULL;
        $password = NULL;
        $user = NULL;

        if (isset($_POST['email'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];

            $user_system->get_database()->create_user($username, $password, $firstname, $lastname, $email);
        }

        // Username is only in lower case
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
        }
        if ($user) {
            $username = $user->get_username();
        }

        $username = strtolower($username);

        $cudf_password = isset($_POST['cud-form-password']) ? $_POST['cud-form-password'] : NULL;
        $cudf_firstname = isset($_POST['cud-form-firstname']) ? $_POST['cud-form-firstname'] : NULL;
        $cudf_lastname = isset($_POST['cud-form-lastname']) ? $_POST['cud-form-lastname'] : NULL;
        $cudf_email = isset($_POST['cud-form-email']) ? $_POST['cud-form-email'] : NULL;

        if ($user_system->get_database()->update_user($username, $cudf_password, $cudf_firstname, $cudf_lastname, $cudf_email)) {
            if (Utils::is_valid_string($cudf_password)) {
                $user->set_password($cudf_password);
            }
            if (Utils::is_valid_string($cudf_firstname)) {
                $user->set_firstname($cudf_firstname);
            }
            if (Utils::is_valid_string($cudf_lastname)) {
                $user->set_lastname($cudf_lastname);
            }
            if (Utils::is_valid_string($cudf_email)) {
                $user->set_email($cudf_email);
            }
        }

        $wrong_login = false;
        $logged_in = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : NULL;
        $https = isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : NULL;

        $cookie = isset($_COOKIE['usr']) && isset($_COOKIE['pwd']);
        $default = isset($_POST['username']) && isset($_POST['password']);
        $session = isset($_SESSION['username']) && isset($_SESSION['loggedin']);

        // Check if HTTPS is enabled
        if (!isset($https) || $https != 'on') {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Read from cookie or from post request
        if ($cookie) {
            $username = $_COOKIE['usr'];
            $password = $_COOKIE['pwd'];
        } else if ($default) {
            $username = $_POST['username'];
            $password = $_POST['password'];
        }

        // Check Login
        if (!$session && Utils::is_valid_string($username) && Utils::is_valid_string($password)) {
            $user = $user_system->login($username, $password);

            $logged_in = !($user === NULL);
            $wrong_login = !$logged_in;
        }

        if (!$logged_in || isset($_GET['i'])) {
            $logged_in = false;
            $username = NULL;

            $user = NULL;
            unset($_SESSION['user']);

            setcookie('usr', '', time() - 1000);
            setcookie('pwd', '', time() - 1000);
            session_destroy();
        }

        $_SESSION['loggedin'] = $logged_in;
        $_SESSION['username'] = $username;


        if ($user) {
            $_SESSION['user'] = serialize($user);
        }
        ?>

        <div class="login pull-right">
            <?php
            if ($logged_in) {
                if (isset($_POST['remember'])) {
                    $expire = time() + 31536000;
                    setcookie('usr', $username, $expire);
                    setcookie('pwd', $password, $expire);
                }
                $realname = $user->get_firstname() . ' ' . $user->get_lastname();
                $realname = Utils::is_valid_string($realname) ? $realname : $username;
                echo "<span class='welcome'>Welcome $realname (<a id='logout' href='index.php?i=logout' onclick='form.submit()'>Logout</a>)!</span>";
                if (!$user->is_ldap()) {
                    ?>
                    <a id="change-data-lnk" class="welcome" href="index.php?section=change">Change Data</a>
                    <?php
                }
            } else {
                if ($wrong_login) {
                    ?>
                    <span class="login-wrong">Wrong Login Data</span>
                    <?php
                }
                ?>
                <input id="username-login" class="login-input" name="username" type="text" placeholder="Username"/>
                <input id="password-login" class="login-input" name="password" type="password" placeholder="Password"/>
                <button class="btn banner-button" type="submit">Login</button>
                <span class="banner-text">
                    <input id="remember" name="remember" type="checkbox" value="1">Remember Me
                </span>
                <a class="banner-text-separated" href="index.php?section=register">Create Account</a>
                <?php
            }
            ?>
        </div>
    </form>
</div>