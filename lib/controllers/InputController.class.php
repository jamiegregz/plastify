<?php
    class InputController {
        /**
         * Holds an associative array of the validators to use and their error messages
         */
        private $validators;

        /**
         * Holds the name of the input, this is also the identifier used by the system
         */
        public $name = '';

        /**
         * Holds the success message if all validation tests are passed
         */
        private $success_message = '';

        /**
         * Stores the data input by the user from the HTTP request.
         */
        public $user_input = null;

        /**
         * Stores the current status of the input, either '' (neutral), 'success' or 'error'
         */
        public $status = '';

        /**
         * Holds the message, if any, to be displayed to the user
         */
        private $user_message = '';

        /**
         * Stores a boolean value of the validity of the user input (true = valid).
         */
        private $is_valid = false;

        /**
         * Holds the validation attributes to be used by the live JS validation
         */
        public $validation_attributes;

        public function __construct($name, $error_validation_array, $success_message) {
            $this->name = $name;

            // Set the error validation and success message
            $this->validators = $error_validation_array;
            $this->success_message = $success_message;

            // Attempt to get the user input
            $this->get_user_input();

            // Get validation attrubutes
            $this->get_validation_attributes();

            // Automatically validate the input if it has been submitted by the user
            if($this->is_submitted()) $this->validate_input();
        }

        public function set_error_validation($validation_array) {
            $this->validators = $validation_array;
        }

        public function set_success_message($message) {
            $this->success_message = $message;
        }

        /**
         * Tests whether the user input is valid or not
         */
        public function validate_input() {
            foreach($this->validators as $validator => $validator_info) {
                if((include $_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/validators/' .
                           $validator . '.inc.php') == false) {
                    // The user input passed validation, set the input message to the success message
                    $this->is_valid = true;
                    $this->status = 'success';
                    $this->user_message = $this->success_message;
                }
                else {
                    // The user input failed validation, set the message to
                    //the error message for this validation type
                    $this->is_valid = false;
                    $this->status = 'error';
                    $this->user_message = $validator_info['message'];
                    return false;
                }
            }

            // Return true when all validation tests have passed
            if($this->is_valid) {
                return true;
            }
        }

        /**
         * Returns where the user input has passed all set validation checks
         * after being submitted by the user.
         */
        public function is_submitted_and_valid() {
            if(isset($this->user_input) && $this->is_valid) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * If the user input has been submitted, return true, otherwise return false.
         */
        public function is_submitted() {
            if(isset($this->user_input)) {
                return true;
            } else {
                return false;
            }
        }

        public function get_name() {
            return $this->name;
        }

        /**
         * Print the view with the inputs data to the screen where the function is called
         */
        public function display_with_view($input_view) {
            include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/inputs/' . $input_view . '.inc.php');
        }

        public function display_message() {
            if(isset($this->user_input)) {
                // Display the error message
                echo $this->user_message;
            }
        }

        public function display_message_with_view($message_view = null) {
            if(isset($this->user_input)) {
                if($this->user_message != '') {
                    if($message_view == null) {
                        include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/messages/StandardMessage.inc.php');
                    } else {
                        include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/messages/' .
                                $message_view . '.inc.php');
                    }
                }
            }
        }

        public function display_input_with_view($input_view = null) {
            if($input_view == null) {
                // Show the standard input layout
                include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/inputs/StandardInput.inc.php');
            } else {
                include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/inputs/' .
                        $input_view . '.inc.php');
            }
        }

        private function get_user_input() {
            if(isset($_POST[$this->name])) {
                // Check if the input was posted first
                $this->user_input = $_POST[$this->name];
                return $this->user_input;
            }
            elseif (isset($_GET[$this->name])) {
                // The input was sent via a GET request
                $this->user_input = $_GET[$this->name];
                return $this->user_input;
            } else {
                // No user input was submitted, return false
                $this->user_input = null;
                return false;
            }
        }

        private function convert_to_data_attribute($attribute) {
            // Replace all '_' with '-'
            $attribute = str_replace('_', '-', $attribute);

            return $attribute;
        }

        public function get_validation_attributes() {
            $attributes = '';

            foreach($this->validators as $validator => $validator_info) {
                $attributes .= 'data-validator-' . $this->convert_to_data_attribute($validator) . '="true" ';

                foreach($validator_info as $info_type => $info_content) {
                    $attributes .= 'data-validator-' . $this->convert_to_data_attribute($validator) .
                        '-' . $this->convert_to_data_attribute($info_type) . '="' . $info_content . '" ';
                }
            }

            $this->validation_attributes = $attributes;
            return $this->validation_attributes;
        }

        public function force_custom_error_message($content = '') {
            $this->status = 'error';
            $this->user_message = $content;
        }
    }
?>
