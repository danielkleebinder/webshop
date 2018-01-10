
/* 
 Created on : 01.04.2016
 Author     : Daniel Kleebinder
 */



/**
 * Makes the given element visible.
 * 
 * @param {Element} element Element.
 */
function show(element) {
    element.style.display = "block";
}

/**
 * Hides the given element.
 * 
 * @param {Element} element Element.
 */
function hide(element) {
    element.style.display = "none";
}

/**
 * Initializes the validation UI.
 */
function initialize() {
    // Hide all bootstrap alerts
    hide(document.getElementById("username-alert"));
    hide(document.getElementById("password-alert"));
    hide(document.getElementById("validate-password-alert"));
    hide(document.getElementById("firstname-alert"));
    hide(document.getElementById("lastname-alert"));
    hide(document.getElementById("email-alert"));
}

/**
 * Checks if the given string is valid or not.
 * 
 * @param {type} str String.
 * @returns {Boolean} True if valid otherwise false.
 */
function validString(str) {
    return str && str.length !== 0 && str !== '';
}

/**
 * Checks if the inputs are correct and correspond to the RegEx of the input
 * fields.
 * 
 * @returns {Boolean} True if the form is valid, otherwise false.
 */
function validate() {
    // Fetch all "forms"
    var usernameForm = document.getElementById("username-form");
    var validatePasswordForm = document.getElementById("validate-password-form");
    var firstnameForm = document.getElementById("firstname-form");
    var lastnameForm = document.getElementById("lastname-form");
    var emailForm = document.getElementById("email-form");

    // Fetch all bootstrap feedbacks
    var usernameFeedback = document.getElementById("username-feedback");
    var validatePasswordFeedback = document.getElementById("validate-password-feedback");
    var firstnameFeedback = document.getElementById("firstname-feedback");
    var lastnameFeedback = document.getElementById("lastname-feedback");
    var emailFeedback = document.getElementById("email-feedback");

    // Fetch all bootstrap alerts
    var usernameAlert = document.getElementById("username-alert");
    var validatePasswordAlert = document.getElementById("validate-password-alert");
    var firstnameAlert = document.getElementById("firstname-alert");
    var lastnameAlert = document.getElementById("lastname-alert");
    var emailAlert = document.getElementById("email-alert");

    // Fetch all values from the input fields
    var usernameValue = document.getElementById("username").value;
    var passwordValue = document.getElementById("password").value;
    var validatePasswordValue = document.getElementById("validate-password").value;
    var firstnameValue = document.getElementById("firstname").value;
    var lastnameValue = document.getElementById("lastname").value;
    var emailValue = document.getElementById("email").value;

    // Defines the password and the E-Mail RegEx
    var passwordRegEx = /^(?=.*\d)(?=.*[!@#\$%\^\&*\)\(+=._-])(?=.*[A-Z])[0-9a-zA-Z!@#\$%\^\&*\)\(+=._-]{8,}$/;
    var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    var success = true;

    // Validate name
    if (usernameValue.length < 8 || usernameValue.length > 32) {
        error(usernameForm, usernameFeedback, usernameAlert);
        success = false;
    } else {
        noError(usernameForm, usernameFeedback, usernameAlert);
    }

    // Validate password
    if (passwordValue < 8 || passwordValue > 32 || !passwordRegEx.test(passwordValue) || passwordValue !== validatePasswordValue) {
        error(validatePasswordForm, validatePasswordFeedback, validatePasswordAlert);
        success = false;
    } else {
        noError(validatePasswordForm, validatePasswordFeedback, validatePasswordAlert);
    }

    // Validate firstname
    if (firstnameValue.length < 1 || firstnameValue.length > 32) {
        error(firstnameForm, firstnameFeedback, firstnameAlert);
        success = false;
    } else {
        noError(firstnameForm, firstnameFeedback, firstnameAlert);
    }

    // Validate lastname
    if (lastnameValue.length < 1 || lastnameValue.length > 32) {
        error(lastnameForm, lastnameFeedback, lastnameAlert);
        success = false;
    } else {
        noError(lastnameForm, lastnameFeedback, lastnameAlert);
    }

    // Validate email
    if (!emailRegEx.test(emailValue)) {
        error(emailForm, emailFeedback, emailAlert);
        success = false;
    } else {
        noError(emailForm, emailFeedback, emailAlert);
    }

    // Returns true if the document is valid, otherwise false.
    return success;
}

/**
 * Checks if the inputs are correct and correspond to the RegEx of the input
 * fields.
 * 
 * @returns {Boolean} True if the form is valid, otherwise false.
 */
function validateChange() {
    // Fetch all "forms"
    var validatePasswordForm = document.getElementById("validate-password-form");
    var firstnameForm = document.getElementById("firstname-form");
    var lastnameForm = document.getElementById("lastname-form");
    var emailForm = document.getElementById("email-form");

    // Fetch all bootstrap feedbacks
    var validatePasswordFeedback = document.getElementById("validate-password-feedback");
    var firstnameFeedback = document.getElementById("firstname-feedback");
    var lastnameFeedback = document.getElementById("lastname-feedback");
    var emailFeedback = document.getElementById("email-feedback");

    // Fetch all bootstrap alerts
    var validatePasswordAlert = document.getElementById("validate-password-alert");
    var firstnameAlert = document.getElementById("firstname-alert");
    var lastnameAlert = document.getElementById("lastname-alert");
    var emailAlert = document.getElementById("email-alert");

    // Fetch all values from the input fields
    var passwordValue = document.getElementById("cud-form-password").value;
    var validatePasswordValue = document.getElementById("cud-form-validate-password").value;
    var firstnameValue = document.getElementById("cud-form-firstname").value;
    var lastnameValue = document.getElementById("cud-form-lastname").value;
    var emailValue = document.getElementById("cud-form-email").value;

    // Defines the password and the E-Mail RegEx
    var passwordRegEx = /^(?=.*\d)(?=.*[!@#\$%\^\&*\)\(+=._-])(?=.*[A-Z])[0-9a-zA-Z!@#\$%\^\&*\)\(+=._-]{8,}$/;
    var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!validString(passwordValue)
            && !validString(validatePasswordValue)
            && !validString(firstnameValue)
            && !validString(lastnameValue)
            && !validString(emailValue)) {
        return false;
    }

    // Validate password
    if (passwordValue || validatePasswordValue) {
        if ((!passwordValue || !validatePasswordValue)
                || (passwordValue < 8 || passwordValue > 32 || !passwordRegEx.test(passwordValue) || passwordValue !== validatePasswordValue)) {
            error(validatePasswordForm, validatePasswordFeedback, validatePasswordAlert);
            return false;
        } else {
            noError(validatePasswordForm, validatePasswordFeedback, validatePasswordAlert);
        }
    }

    // Validate firstname
    if (firstnameValue && (firstnameValue.length < 1 || firstnameValue.length > 32)) {
        error(firstnameForm, firstnameFeedback, firstnameAlert);
        return false;
    } else {
        noError(firstnameForm, firstnameFeedback, firstnameAlert);
    }

    // Validate lastname
    if (lastnameValue && (lastnameValue.length < 1 || lastnameValue.length > 32)) {
        error(lastnameForm, lastnameFeedback, lastnameAlert);
        return false;
    } else {
        noError(lastnameForm, lastnameFeedback, lastnameAlert);
    }

    // Validate email
    if (emailValue && (!emailRegEx.test(emailValue))) {
        error(emailForm, emailFeedback, emailAlert);
        return false;
    } else {
        noError(emailForm, emailFeedback, emailAlert);
    }

    return true;
}

/**
 * Logs the error for the given input fields.
 * 
 * @param {Element} element Form.
 * @param {Element} feedback Bootstrap feedback.
 * @param {Element} alert Bootstrap alert.
 */
function error(element, feedback, alert) {
    element.classList.add("has-error");
    element.classList.add("has-feedback");

    feedback.classList.add("glyphicon-remove");

    show(alert);
}

/**
 * Removes the error output from the given input fields.
 * 
 * @param {Element} element Form.
 * @param {Element} feedback Bootstrap feedback.
 * @param {Element} alert Bootstrap alert.
 */
function noError(element, feedback, alert) {
    element.classList.remove("has-error");
    element.classList.remove("has-feedback");

    feedback.classList.remove("glyphicon-remove");

    hide(alert);
}