<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    class UserModel extends DBModel {

        public function __construct() {
            parent::__construct();
        }

        /**
         * This function will fetch the users data from the the DB based on a set session token
         *
         * @param string $session_token This is the session token of the particular user.
         * @return {array} Array holding the users data (ID, Username, Email, etc.), false if returned if the query fails.
         */
        public function fetch_base_data_from_token($session_token) {
            $query = 'SELECT users.user_id,
                             users.username,
                             users.email,
                             users.password,
                             users.password_salt
                      FROM users INNER JOIN session_tokens
                      ON users.user_id = session_tokens.user_id
                      WHERE session_tokens.value = ?';

            // Query the database
            $result = $this->db_query($query, 's', $session_token);
        }
    }
?>
