<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/EventManager.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecurePassword.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecureSession.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecureCookie.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/RandomString.class.php');

    class LoginManager extends EventManager {
        /**
         * Holds the user input username.
         */
        private $username = '';

        /**
         * Holds the user input password.
         */
        private $password = '';

        /**
         * Holds the users user ID
         */
        private $user_id = null;

        public function __construct() {

        }

        /**
         * Function to set the required fields for the login event
         */
        public function set_input_values($username, $password) {
            $this->username = $username;
            $this->password = $password;

            return;
        }

        /**
         * Function used to check if the set username and password relate to a user account
         */
        public function login_details_are_valid() {
            // Check if the users username exists
            $query = 'SELECT user_id, password, password_salt FROM users WHERE username=? OR email=?';
            $db_model = new DBModel();
            $result = $db_model->db_query($query, 'ss', $this->username, $this->username);

            if($result != false && $result->num_rows > 0) {
                // The username exists, check if the password is valid
                $result = $result->fetch_assoc();

                $encrypted_user_password = new SecurePassword();
                $encrypted_user_password->create_with_salt($this->password, $result['password_salt']);

                if($encrypted_user_password->value == $result['password']) {
                    // The password is correct, save the user ID to a global
                    $this->user_id = $result['user_id'];
                    return true;
                }
            }

            // Catch all cases of errors
            return false;
        }

        /**
         * Function to initialise the session (and maybe cookie).
         */
        public function login() {
            // Get the user ID
            // Create the login token and store this in the session
            $token = $this->generate_login_token(false); // Set false to prevent cookie storage

            $db_model = new DBModel();

            // Get the users ID if it isn't already set
            if($this->user_id == '') {
                $query = 'SELECT user_id FROM users WHERE username=?';
                $result = $db_model->db_query($query, 's', $this->username);

                if($result != false && $result->num_rows == 1) {
                    $this->user_id = $result->fetch_assoc()['user_id'];
                } else {
                    // An error occured getting the user's ID
                    return false;
                }
            }

            // Save the new token to the database
            $query = 'INSERT INTO login_tokens (user_id, value, void) VALUES (?, ?, ?)';
            $result = $db_model->db_query($query, 'isi', $this->user_id, $token, '0');

            // Check if the login token was successfully inserted into the database
            if($db_model->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        }

        private function generate_login_token($use_cookie = false) {
            // Generate a random string of length 128
            $token = new RandomString(128);

            // Store the login token
            if($use_cookie) {

            } else {
                SecureSession::set_value('token', $token->value);
            }
            return $token->value;
        }

        private function is_token_valid($token) {
            // Run basic validation on the token
            if(strlen($token) != 0) {

                $query = 'SELECT user_id FROM login_tokens WHERE value=?';

                $db_model = new DBModel();
                $result = $db_model->db_query($query, 's', $token);

                if($result != false && $result->num_rows == 1) {
                    // A login token exists, save the user ID to the object
                    $this->user_id = $result->fetch_assoc()['user_id'];
                    return true;
                }
            }

            // Catch all issues, return false
            return false;
        }

        public function is_loggedin() {
            // Check if a session/cookie login token is valid
            if($this->is_token_valid(SecureSession::get_value('token')) ||
               $this->is_token_valid(SecureCookie::get_value('token'))) {
                // The login token is valid, return true
                return true;
            } else {
                return false;
            }
        }
    }
?>
