<?php

if (isset( $loginFormMessage ) === false ) {
    $loginFormMessage = "";
}

return "<form method='post' action='admin.php'>
    <p>Login to access restricted area</p>
    <label>e-mail</label>
    <input type='email' name='email' required />
    <label>password</label>
    <input type='password' name='password' required />
    <input type='submit' value='login' name='log-in' />
    <p id='login-form-message'>$adminFormMessage</p>
</form>";