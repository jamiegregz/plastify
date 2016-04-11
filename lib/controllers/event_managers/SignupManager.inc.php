<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/EventManager.class.php');

    class SignupManager extends EventManager{

        private $username = '';

        private $email = '';

        private $password = '';

        private $confirm_password = '';

        public function __construct() {

        }

        public function set_input_values($username, $email, $password, $confirm_password) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->confirm_password = $confirm_password;
        }

        public function signup() {
            // Generate a secure password to store in the DB
            $secure_password = new SecurePassword();
            $secure_password->create_from($this->password);

            // Prepare the insertion query
        }
    }
?>
