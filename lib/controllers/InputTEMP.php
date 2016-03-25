<?php
    class InputController {
        /**
         * This holds the system identifier of the input, this is also the value used
         * to populate the name attrubute in the form
         */
        public $name = '';

        /**
         * This holds the user input value of the input
         */
        public $value = '';

        /**
         * Holds the current status of the input: possible values are '', error' and 'success'
         */
        public $status = '';

        /**
         * Variable to hold the error (or success) message to display to the user
         */
        public $message = '';

        /**
         * Boolean value, return true if the input passes all validation tests.
         */
        public $is_valid = false;

        /**
         * This holds an array of strings identifing validation types, these value
         * of the input is tested agains these to calculate the value of $is_valid
         */
        private $validators;

        /**
         * Construction function for the InputController class
         *
         * @param string $name This is used as the system identifier for the input.
         * @param array $validators An array of strings coresponding to validation types to test the input value against.
         *
         * @return {void} Void: This function doesn't return anything
         */
        public function __construct($name, $validators) {
            $this->name = $name;

            $this->validators = $validators;

            // Validate the input
            $this->validate();
        }

        /**
         * This function retrieves the user input from the submitted form
         * <strong>This function does not accept any arguments.</strong>
         *
         * return {string} The value of the user input.
         */
        public function user_input() {
            $user_input = isset($_POST[$this->name]) ? $_POST[$this->name] : '';
            return $user_input;
        }

        /**
         *
         */
        private function get_validation_message()
        {
            $this->value = $_POST[$this->name];
            $validation_error = false;

            // Loop through the error validators and checkagains each one
            foreach($this->validators['error'] as $type => $message)
            {
                switch($type)
                {
                    case 'empty':
                        // Check if the input is empty
                        if($this->value == '') $validation_error = ['type' => 'error', 'message' => $message];
                        break;

                    case 'email':
                        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)) $validation_error = ['type' => 'error', 'message' => $message];
                        break;

                    case 'postcode':
                        // Check if the input matches the postcode regex
                        $postcode_pattern = "^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$^";
                        if(preg_match($postcode_pattern, $this->value) != 1) $validation_error = ['type' => 'error', 'message' => $message];
                        break;
                    case 'match':
                        // Get the value of the input to match
                        $match_value = isset($message[0]->value) ? $message[0]->value : '';

                        // Check that the values match. If not, set the error
                        if($this->value != $match_value) $validation_error = ['type' => 'error', 'message' => $message[1]];
                        break;
                    case 'username-existence':
                        // Check if the username exists on the system
                        $user = new User();
                        if($user->username_exists($this->value)) // The username exists, set the error
                            $validation_error = ['type' => 'error', 'message' => $message];
                        break;
                    case 'email-existence':
                        // Check if the email exists on the system
                        $user = new User();
                        if($user->email_exists($this->value)) // The email is registered, set the error
                            $validation_error = ['type' => 'error', 'message' => $message];
                        break;
                }

                // Check if a validation error has occured
                if($validation_error != false) {
                    break;
                }
            }

            if($validation_error != false) {
                return $validation_error;

            }
            $this->is_valid = true;
            // No validation error was found, return the success message
            return ['type' => 'success', 'message' => $this->validators['success']['message']];
        }

        /**
         *
         */
        private function validate()
        {
            // Validate the user input from the post request
            // Check if a post request has been submitted
            if(!isset($_POST[$this->name])) return ''; // Nothing has been submitted, don't return a message
            else
            {
                $validation = $this->get_validation_message();
                $this->status = $validation['type'];
                $this->message =  '<div class="input-message '.$validation['type'].'">'.$validation['message'].'</div>';
            }
        }

        /**
         *
         */
        public function validation_attributes() {
            // String builder for client side validation data attributes
            $validation_rules_string = '';
            foreach($this->validators as $validator_type => $rules)
            {
                if($validator_type == 'success')
                    $validation_rules_string .= 'data-validation-success-message="' . $rules['message'] . '" '; // Write the validation success message
                else // Validation types are errors
                {
                    foreach($rules as $rule => $message)
                    {
                        // Check for special cases
                        switch($rule)
                        {
                            case 'match':
                                $validation_rules_string .= 'data-validation-' . $rule . '="true" ';
                                $validation_rules_string .= 'data-validation-' . $rule . '-input="' . $message[0]->name . '" ';
                                $validation_rules_string .= 'data-validation-' . $rule . '-message="' . $message[1] . '" ';
                                break;
                            default:
                                // Build the validation data attributes
                                $validation_rules_string .= 'data-validation-' . $rule . '="true" ';
                                $validation_rules_string .= 'data-validation-' . $rule . '-message="' . $message . '" ';
                        }
                    }
                }
            }

            return $validation_rules_string;
        }
    }
?>
