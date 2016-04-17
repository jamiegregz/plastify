<?php
    class SecureCookie {

        private $is_valid = false;

        public $value = array();

        public function __construct() {
        }

        public function start() {
            ini_set('session.cookie_httponly', true);

            session_start();
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id();
                $_SESSION['initiated'] = true;
            }

            // Store the users IP in the session (to check for session hijacking)
            if(!isset($_SESSION['user_ip'])) {
                $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
            }

            // Chack for hijacked session
            if($_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {
                // The session (probably) isn't hijacked, return true
                $this->is_valid = true;
                return true;
            } else {
                // Hijacked session!
                $this->is_valid = false;
                $this->destory();
                return false;
            }
        }

        public function is_valid() {
            return $this->is_valid;
        }

        public static function set_value($name, $value) {
            // Stop the user overwriting important variables
            if($name != 'initiated' || $name != 'user_ip') {
                $_SESSION[$name] = $value;
            }
        }

        public static function remove_value($name) {
            // Prevent the deletion of important variables
            if($name != 'initiated' || $name != 'user_ip') {
                unset($_SESSION[$name]);
            }
        }

        public static function get_value($name) {
            // Return the requested value from the session array
            if(isset($_SESSION[$name])) {
                return $_SESSION[$name];
            } else {
                // The requested value isn't set
                return false;
            }
        }

        public static function get() {
            // Return the whole session array
            return $_SESSION;
        }

        public static function destroy() {
            session_unset();
            session_destroy();
        }
    }
?>
