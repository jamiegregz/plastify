<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    class CatalogueModel extends DBModel {

        public $printer_manufacturers = array();

        public function __construct() {
            parent::__construct();
        }

        public function get_printer_manufacturers() {
            $query = 'SELECT catalogue_manufacturers.manufacturer_id,
                             catalogue_manufacturers.name
                      FROM catalogue_manufacturers';

            $result = $this->db_query($query);

            if($result != false) {
                while($item = $result->fetch_assoc()) {
                    array_push($this->printer_manufacturers, $item);
                }
                return $this->printer_manufacturers;
            } else {
                return false;
            }
        }
    }
?>
