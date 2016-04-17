<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    class UserModel extends DBModel {

        public $data = array();

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
            $query = 'SELECT users.user_id AS user_id,
                             users.username AS username,
                             users.email AS email,
                             users.password AS password,
                             users.password_salt AS password_salt
                      FROM users INNER JOIN login_tokens
                      ON users.user_id = login_tokens.user_id
                      WHERE login_tokens.value = ?';

            // Query the database
            $result = $this->db_query($query, 's', $session_token);

            // Save the users data to the model
            if($result != false && $result->num_rows > 0) {
                $this->data = $result->fetch_assoc();
            }
        }

        public function update_model() {
            // Refresh all data stored in the model
            $query = 'SELECT users.user_id AS user_id,
                             users.username AS username,
                             users.email AS email,
                             users.password AS password,
                             users.password_salt AS password_salt
                      FROM users
                      WHERE users.user_id = ?';

            $result = $this->db_query($query, 'i', $this->data['user_id']);

            // Update the data array
            if($result != false && $result->num_rows > 0) {
                $this->data = $result->fetch_assoc();
            }
        }

        public function set_email($email) {
            // Update the users email address to a given value
            $query = 'UPDATE users
                      SET users.email = ?
                      WHERE user_id = ?';

            $this->db_query($query, 'si', $email, $this->data['user_id']);

            // Check if the email was updated correctly
            if($this->affected_rows == 1) {
                // The email was successfully updated, update the data array
                $this->data['email'] = $email;
                return true;
            } else {
                return false;
            }
        }

        public function set_password($password) {
            // Create a secure password and salt
            $secure_password = new SecurePassword();
            $secure_password->create_from($password);

            // Add the new password and salt in the DB
            $query = 'UPDATE users
                      SET users.password = ?,
                          users.password_salt = ?
                      WHERE user_id = ?';

            $this->db_query($query, 'ssi', $secure_password->value, $secure_password->salt, $this->data['user_id']);

            // Check if the password was updated correctly
            if($this->affected_rows == 1) {
                // The password was successfully updated, update the data array
                $this->data['password'] = $secure_password->value;
                $this->data['password_salt'] = $secure_password->salt;
                return true;
            } else {
                // An error occured updating the password, return false
                return false;
            }
        }
    }
?>
