<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/braintree-php-3.11.0/lib/Braintree.php');
            
    class PaymentController {
        
        protected $client_token = '';
        
        private $nonce = '';
        
        public function __construct() {
            // Configure Braintree Service
            Braintree_Configuration::environment('sandbox');
            Braintree_Configuration::merchantId('dxw2hygzy4qk8mst');
            Braintree_Configuration::publicKey('9tb27f3k4wmdj9cb');
            Braintree_Configuration::privateKey('65b860404bd1d9d04924e99a6c862ac8');
            
            // Generate a client token and store it as a cookie
            $this->client_token = Braintree_ClientToken::generate();
            $_COOKIE['client_token'] = $this->client_token;
            setrawcookie('client_token', $this->client_token);
        }
        
        public function get_client_token() {
            return $this->client_token;
        }
        
        public function is_submitted_and_valid() {
            if(isset($_POST['payment_method_nonce'])) {
                // A nonce has been submitted, store it
                $this->nonce = $_POST['payment_method_nonce'];
                return true;
            } else {
                // Nothing has been submitted
                return false;
            }
        }
        
        public function create_sale($inputs) {
            $result = Braintree_Transaction::sale([
                'amount' => '100.00',
                'paymentMethodNonce' => $this->nonce
            ]);
        }
        
        public function display_inputs_with_view($input_view) {
            include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/inputs/' . $input_view . '.inc.php');
        }
    }
?>