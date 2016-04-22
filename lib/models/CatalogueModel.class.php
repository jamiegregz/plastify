<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/DBModel.class.php');

    class CatalogueModel extends DBModel {

        public $printer_manufacturers = array();

        public $printer_materials = array();

        public $colours = array();

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

        public function get_printer_materials() {
            $query = 'SELECT catalogue_materials.material_id,
                             catalogue_materials.name
                      FROM catalogue_manufacturers';

            $result = $this->db_query($query);

            if($result != false) {
                while($item = $result->fetch_assoc()) {
                    array_push($this->printer_materials, $item);
                }
                return $this->printer_materials;
            } else {
                return false;
            }
        }

        public function get_colours() {
            $query = 'SELECT catalogue_colours.colour_id,
                             catalogue_colours.colour_code,
                             catalogue_colours.name
                      FROM catalogue_colours';

            $result = $this->db_query($query);

            if($result != false) {
                while($item = $result->fetch_assoc()) {
                    array_push($this->colours, $item);
                }
                return $this->colours;
            } else {
                return false;
            }
        }
    }
?>
