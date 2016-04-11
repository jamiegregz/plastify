<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');
    $query = 'SELECT 1 FROM users WHERE username=?';

    $db_model = new DBModel();
    $result = $db_model->db_query($query, 's', $this->user_input);

    // Check if the requested user was returned
    if($result->fetch_assoc()[1] == 1) {
        // The user exists
        return true;
    } else {
        return false;
    }
?>
