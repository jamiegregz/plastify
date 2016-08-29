<?php
    if($this->user_input != $_POST[$validator_info['input']]) {
        return true;
    } else {
        return false;
    }
?>