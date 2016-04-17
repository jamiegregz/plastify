<?php
    class ChangePasswordManager extends EventManager {

        private $new_password = '';

        public function __construct() {

        }

        public function set_input_values($password) {
            $this->password = $password;
        }

        public function change_password() {
            // Update the users password
            if($_SESSION['user']->set_password($this->password)) {
                return true;
            } else {
                // An error occured updating the password, return false
                return false;
            }
        }
    }
?>
