<?php
    class DBModel {
        private $DBHost = 'localhost';
        private $DBUser = 'root';
        private $DBPassword = '';
        private $DBName = 'plastify';

        /**
         * This is the mysqli object holding the database connection
         */
        protected $connection = null;

        public function __construct() {
            // Establish a connection to the database
            $this->connection = $this->create_connection();
        }

        /**
         * Function to create a connection to the database <br />
         * <strong>This function does not accept any arguments.</strong>
         *
         * @return {mysqli} $connection The newly created database connection. Returns false on failure
         */
        private function create_connection() {
            $connection = new mysqli($this->DBHost, $this->DBUser, $this->DBPassword, $this->DBName);

            if($connection->connect_errno) {
                // The connection to the database failed, return false
                return false;
            } else {
                // The connection was successful, return the connection instance
                return $connection;
            }
        }

        private function ref_values($arr) {
            $refs = array();

            foreach ($arr as $key => $value) {
                $refs[$key] = &$arr[$key];
            }

            return $refs;
        }

        /**
         * This function will query the database with the specified query and parameters.
         *
         * @param string $query The prepared query to be used to access the database.
         * @param string $params_type The data types of the parameters to be passed.
         * @param mixed $param1,... The parameters to be passed throught into the query,
         * an unlimited number of items can be passed.
         *
         * @return {mysqli_result} $result The data returned from the database after the query has completed
         */
        public function db_query() {
            // Use the func_get_args function to get the first 2 params
            $arguments = func_get_args(); //implode(', ', func_get_args());
            $query = $arguments[0];
            if(isset($arguments[1])) $params_type = $arguments[1];
            else $params_type = '';

            if($this->connection != false) {
                // Attempt to prepare the query
                if($stmt = $this->connection->prepare($query)) {
                    // Remove the query from the arguments list
                    $params = array_slice($arguments, 1);

                    // Bind the parameters to the statement, using the call_user_func_array
                    // function to allow the passing of multiple parameters from an array
                    $bind_result = null;

                    if($params_type != '') {
                        $bind_result = call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($params));
                    }

                    if($params_type == '' || $bind_result !== false) {
                        // Attempt to execute the query
                        $execute_result = $stmt->execute();

                        if($execute_result !== false) {
                            // The query succeeded, return the data returned from the DB
                            $result = $stmt->get_result();

                            // Store the number of affected rows in a variable
                            $this->affected_rows = $this->connection->affected_rows;

                            // Return the result to the user
                            return $result;
                        }
                    }
                }
            }

            // An error occured preparing the query, return false
            return false;
        }
    }
?>
