<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecurePassword.class.php');

    // Check if the submitted password matched the password in the DB
    $password = $_SESSION['user']->data['password'];
    $salt = $_SESSION['user']->data['password_salt'];

    $secure_password = new SecurePassword();
    $secure_password->create_with_salt($this->user_input, $salt);

    if($secure_password->value == $password) {
        // The password is correct
        return false;
    } else {
        return true;
    }
?>
