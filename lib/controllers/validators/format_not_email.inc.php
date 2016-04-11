<?php
    if(preg_match(
        '/^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/',
        $this->user_input
    )) {
        // The user input is a valid email, return false
        return false;
    } else {
        // The email is invalid
        return true;
    }
?>
