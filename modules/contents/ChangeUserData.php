<div class="container">
    <h2 class="text-center">Change Account Data</h2>
    <div class="separator" style="margin-bottom: 50px;"></div>
    <form id="cudf" name="cudform" class="register-form center-block" onsubmit="return validateChange();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h4 class="text-muted">You can change all informations about your account, except your username, in this tab. The current account information for <span class="text-danger"><?php echo $user->get_firstname() . ' ' . $user->get_lastname(); ?></span> will be displayed right next to the description!</h4>
        <!-- Form group for the password input -->
        <div id="password-form" class="form-group separator">
            <label for="cud-form-password">Password</label>
            <input id="cud-form-password" name="cud-form-password" class="form-control" type="password"/>
            <span id="password-feedback" class="glyphicon form-control-feedback"></span>
            <div id="password-alert" class="alert alert-danger">
                <strong>Passwort:</strong> Must be between 8 an 32 characters matching the following regex (one uppercase letter, one number and one special character): (!@()#$%^&*+=._-)!
            </div>
        </div>

        <!-- Form group for the validate password input -->
        <div id="validate-password-form" class="form-group">
            <label for="cud-form-validate-password">Validate Password</label>
            <input id="cud-form-validate-password" name="cud-form-validate-password" class="form-control" type="password"/>
            <span id="validate-password-feedback" class="glyphicon form-control-feedback"></span>
            <div id="validate-password-alert" class="alert alert-danger">
                <strong>Passwort:</strong> Must be between 8 an 32 characters matching the following regex (one uppercase letter, one number and one special character): (!@()#$%^&*+=._-)!
            </div>
        </div>

        <!-- Form group for the firstname input -->
        <div id="firstname-form" class="form-group separator">
            <label for="cud-form-firstname">Firstname (<span class="text-info"><?php echo $user->get_firstname(); ?></span>)</label>
            <input id="cud-form-firstname" name="cud-form-firstname" class="form-control" type="text"/>
            <span id="firstname-feedback" class="glyphicon form-control-feedback"></span>
            <div id="firstname-alert" class="alert alert-danger">
                <strong>Firstname:</strong> Must be between 1 and 32 characters!
            </div>
        </div>

        <!-- Form group for the lastname input -->
        <div id="lastname-form" class="form-group">
            <label for="cud-form-lastname">Lastname (<span class="text-info"><?php echo $user->get_lastname(); ?></span>)</label>
            <input id="cud-form-lastname" name="cud-form-lastname" class="form-control" type="text"/>
            <span id="lastname-feedback" class="glyphicon form-control-feedback"></span>
            <div id="lastname-alert" class="alert alert-danger">
                <strong>Lastname:</strong> Must be between 1 and 32 characters!
            </div>
        </div>

        <!-- Form group for the E-Mail input -->
        <div id="email-form" class="form-group separator">
            <label for="cud-form-email">E-Mail (<span class="text-info"><?php echo $user->get_email(); ?></span>)</label>
            <input id="cud-form-email" name="cud-form-email" class="form-control" type="text">
            <span id="email-feedback" class="glyphicon form-control-feedback"></span>
            <div id="email-alert" class="alert alert-danger">
                <strong>Email-Address:</strong> Must match the E-Mail RegEx-Pattern! For example: max.mustermann@provider.com
            </div>
        </div>

        <!-- Form group for the reset and submit button -->
        <div id="submit-form" class="form-group separator">
            <input id="submit" type="submit" class="btn btn-success col-md-7"/>
            <input id="reset" type="reset" class="btn btn-danger col-md-offset-1 col-md-4"/>
        </div>
    </form>
</div>