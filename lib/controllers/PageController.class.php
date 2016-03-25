<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/InputController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/ValidationController.class.php');

    class PageController {

        /**
         * The name of the document to be used by the system as an identifier
         */
        public $name;

        /**
         * This is the title of the document that will be displayed in the users tab bar
         */
        public $title = '';

        /**
         * This variable holds the custom header scripts to be displayed in the
         * head of the document.
         */
        public $custom_head_scripts = '';

        /**
         * This variable holds the custom CSS files to be included in the head
         * of the document.
         */
        public $custom_css = '';

        /**
         * Holds the HTML contents to be displayed on the page.
         */
        public $content = '';

        /**
         * This variable holds the custom body scripts to be displayed at the bottom
         * of the document.
         */
        public $custom_body_scripts = '';


        public function __construct() {

        }

        /**
         * Function to redirect the user to the required page
         *
         * @param string $page_name The page identifier to redirect the user to
         *
         * @return {void} Void: This function doesn't return anything
         */
        public function redirect_to($page_name) {
            header('Location: /' . $page_name);
        }

        /**
         * This function will check if a session or cookie is set on the current page <br />
         * If a cookie token is set, this will be converted to a session token <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {bool} True is returned if a session is set.
         */
        public function session_set() {
            // Check if a session is set
            if(isset($_SESSION['session_token'])) {

            } elseif(isset($_COOKIE['session_token'])) { // Check if a cookie is set
                // save the cookie as a session
                $_SESSION['session_token'] = $_COOKIE['session_token'];
            }
        }

        /**
         * This function will check if a session isn't set on the current page <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {bool} True is returned if no session exists.
         */
        public function session_not_set() {
            return !$this->session_set();
        }

        /**
         * Function to check if any custom header scripts have been set <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {bool} True is returned if custom head scripts are available.
         */
        public function has_custom_head_scripts() {
            if($this->custom_head_scripts == '') {
                return false;
            } else {
                return true;
            }
        }

        /**
         * Function to check if any custom css files have been set <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {bool} True is returned if custom css files are available.
         */
        public function has_custom_css() {
            if($this->custom_css == '') {
                return false;
            } else {
                return true;
            }
        }

        /**
         * Function to check if any custom body scripts have been set <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {bool} True is returned if custom body scripts are available.
         */
        public function has_custom_body_scripts() {
            if($this->custom_body_scripts == '') {
                return false;
            } else {
                return true;
            }
        }
    }
?>
