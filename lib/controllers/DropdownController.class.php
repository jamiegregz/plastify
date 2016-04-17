<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/InputController.class.php');

    class DropdownController extends InputController {

        private $options = array();

        public function __construct($name, $error_validation_array, $success_message) {
            parent::__construct($name, $error_validation_array, $success_message);
        }

        public function set_options($options) {
            foreach($options as $option) {

            }
        }

        public function show_options() {
            foreach($this->options as $value => $description) {
                echo '<option value="' . $value . '">' . $description . '</option>';
            }
        }

        public function add_option($value, $description) {
            $this->options[$value] = $description;
        }
    }
?>
