<?php
    class ChangeEmailManager extends EventManager {

        private $email = '';

        public function __construct() {

        }

        public function set_input_values($email) {
            $this->email = $email;
        }

        public function change_email() {
            // Update the users email address
            if($_SESSION['user']->set_email($this->email)) {
                return true;
            } else {
                // An error occured updating the email address, return false
                return false;
            }
        }
    }
?>
