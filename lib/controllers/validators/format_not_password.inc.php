<?php
    if(preg_match('/(?=.*\d)(?=.*[a-zA-Z]).{7,}$/', $this->user_input)) {
        // The user input is strong enought to be a password, return false
        return false;
    } else {
        return true;
    }
?>
