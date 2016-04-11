<?php
    if(strlen($this->user_input) < 6) {
        // The username is too short
        return true;
    } else {
        // This is a valid username
        return false;
    }
?>
