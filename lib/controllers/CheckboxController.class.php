<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/InputController.class.php');

    class CheckboxController extends InputController {

        public function __construct($name, $error_validation_array, $success_message) {
            parent::__construct($name, $error_validation_array, $success_message);
        }

        public function set_options($options) {
            foreach($options as $option) {

            }
        }
    }
?>
