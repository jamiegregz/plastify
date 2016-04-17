<?php
    class RandomString {
        public $value = '';

        public function __construct($length, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $string = '';

            // Generate a random string of length $length using the
            // character set specified.
            $charactersLength = strlen($characters);
            for ($i = 0; $i < $length; $i++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }

            $this->value = $string;
            return $string;
        }
    }
?>
