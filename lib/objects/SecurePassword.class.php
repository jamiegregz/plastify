<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/RandomString.class.php');

    class SecurePassword {

        public $password = '';

        public $salt = '';

        public $value = '';

        public function __construct() {
        }

        /**
         * Function to create a secure password to be stored in the DB
         */
        public function create_from($password) {
            // Save the password to a publicly available variable
            $this->password = $password;

            // Generate a salt
            $salt = $this->generate_salt(30);

            // Hash the password with the newly created salt
            $this->value = hash('SHA512', $password . $salt);

            return $this->value;
        }

        public function create_with_salt($password, $salt) {
            $this->salt = $salt;
            $this->value = hash('SHA512', $password . $salt);

            return $this->value;
        }

        private function generate_salt($length) {
            // Generate a salt of length 30
            $salt = new RandomString(30);
            $this->salt = $salt->value;
            return $this->salt;
        }


    }
?>
