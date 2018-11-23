function checkLoginForm (event) {
    var email = document.querySelector("input[name='email']");
    var warning = document.querySelector("#login-form-message");
    var password = document.querySelector("input[name='password']");
    if (email.value === "" && password.value === "") {
        event.preventDefault();
        warning.innerHTML = "* You must write e-mail and password";
    } else if (email.value === "") {
        //preventDefault, ie don't submit the form
        event.preventDefault();
        warning.innerHTML = "* You must write e-mail";
    } else if (password.value === "") {
        event.preventDefault();
        warning.innerHTML = "* You must write password";
    }
}

function updateLoginMessage() {
    var p = document.querySelector("#login-form-message");
    p.innerHTML = "* Java-script works!";
}

function init() {
    var loginForm = document.querySelector("form#login-form");
    var email = document.querySelector("input[name='email']");
    email.required = false;
    var password = document.querySelector("input[name='password']");
    password.required = false;
    email.addEventListener("keyup", updateLoginMessage, false);
    password.addEventListener("keyup", updateLoginMessage, false);
    loginForm.addEventListener("submit", checkLoginForm, false);
}

document.addEventListener("DOMContentLoaded", init, false);