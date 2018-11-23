<?php

if (isset( $loginFormMessage ) === false ) {
    $loginFormMessage = "";
}

return "<form method='post' action='admin.php' id='login-form'>
    <p>Login to access restricted area</p>
    <label>e-mail</label>
    <input type='email' name='email' required />
    <p id='email-warning'></p>
    <label>password</label>
    <input type='password' name='password' required />
    <input type='submit' value='login' name='log-in' />
    <p id='login-form-message'>$loginFormMessage</p>
</form>";