<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/EventManager.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    class SignupManager extends EventManager {

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
            $query = 'INSERT INTO users (username, email, password, password_salt) VALUES(?, ?, ?, ?)';
            $db_model = new DBModel();
            $db_model->db_query($query, 'ssss', $this->username,
                                                $this->email,
                                                $secure_password->value,
                                                $secure_password->salt);

            // Check if the user was successfully inserted into the database
            if($db_model->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
?>
