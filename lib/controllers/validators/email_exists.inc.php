<?php
    // Query the DB to check if the email address exists
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    $query = 'SELECT 1 FROM users WHERE email=?';

    $db_model = new DBModel();
    $result = $db_model->db_query($query, 's', $this->user_input);

    // Check if the requested email was returned
    if($result->fetch_assoc()[1] == 1) {
        // The email is already registered
        return true;
    } else {
        return false;
    }
?>
