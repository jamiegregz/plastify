<?php
    class LoginManager {
        /**
         * Holds the user input username.
         */
        private $username = '';

        /**
         * Holds the user input password.
         */
        private $password = '';

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
            return false;
        }

        /**
         * Function to initialise the session and redirect to the marketplace
         */
        public function login() {

        }
    }
?>
