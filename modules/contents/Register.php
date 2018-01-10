<div class="container">
    <h2 class="text-center">Register Account</h2>
    <div class="separator" style="margin-bottom: 50px;"></div>
    <form id="rf" name="caform" class="register-form center-block" onsubmit="return validate();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <!-- Form group for the name input -->
        <div id="username-form" class="form-group">
            <label for="username">Username</label>
            <input id="username" name="username" class="form-control" type="text"/>
            <span id="username-feedback" class="glyphicon form-control-feedback"></span>
            <div id="username-alert" class="alert alert-danger">
                <strong>Username:</strong> Must be between 8 and 32 characters!
            </div>
            <div id="username-alert-duplicate" class="alert alert-danger">
                <strong>Username:</strong> Already in use!
            </div>
        </div>

        <!-- SQL INJECTION, BE CAREFUL -->
        <!-- Form group for the password input -->
        <div id="password-form" class="form-group separator">
            <label for="password">Password</label>
            <input id="password" name="password" class="form-control" type="password"/>
            <span id="password-feedback" class="glyphicon form-control-feedback"></span>
            <div id="password-alert" class="alert alert-danger">
                <strong>Passwort:</strong> Must be between 8 an 32 characters matching the following regex (one uppercase letter, one number and one special character): (!@()#$%^&*+=._-)!
            </div>
        </div>

        <!-- Form group for the validate password input -->
        <div id="validate-password-form" class="form-group">
            <label for="validate-password">Validate Password</label>
            <input id="validate-password" name="validate-password" class="form-control" type="password"/>
            <span id="validate-password-feedback" class="glyphicon form-control-feedback"></span>
            <div id="validate-password-alert" class="alert alert-danger">
                <strong>Passwort:</strong> Must be between 8 an 32 characters matching the following regex (one uppercase letter, one number and one special character): (!@()#$%^&*+=._-)!
            </div>
        </div>

        <!-- Form group for the firstname input -->
        <div id="firstname-form" class="form-group separator">
            <label for="firstname">Firstname</label>
            <input id="firstname" name="firstname" class="form-control" type="text"/>
            <span id="firstname-feedback" class="glyphicon form-control-feedback"></span>
            <div id="firstname-alert" class="alert alert-danger">
                <strong>Firstname:</strong> Must be between 1 and 32 characters!
            </div>
        </div>

        <!-- Form group for the lastname input -->
        <div id="lastname-form" class="form-group">
            <label for="lastname">Lastname</label>
            <input id="lastname" name="lastname" class="form-control" type="text"/>
            <span id="lastname-feedback" class="glyphicon form-control-feedback"></span>
            <div id="lastname-alert" class="alert alert-danger">
                <strong>Lastname:</strong> Must be between 1 and 32 characters!
            </div>
        </div>

        <!-- Form group for the E-Mail input -->
        <div id="email-form" class="form-group separator">
            <label for="email">E-Mail</label>
            <input id="email" name="email" class="form-control" type="text">
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