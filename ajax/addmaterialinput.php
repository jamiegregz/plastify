<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/InputController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/DropdownController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/CheckboxController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/CatalogueModel.class.php');

    if(isset($_POST['index'])) {
        // Get the colour list from the DB
        $catalogue_model = new CatalogueModel();
        $catalogue_model->get_printer_materials();
        $catalogue_model->get_colours();

        // Create the new inputs
        $add_printer_material = new DropdownController('add_printer_material[' . $_POST['index'] . '][material]', [
            'empty' => [
                'message' => 'Please choose a material from the list!'
            ]
        ], 'This is all okay!');

        foreach($catalogue_model->printer_materials as $material) {
            $add_printer_material->add_option($material['material_id'], $material['name']);
        }

        $add_printer_material_colour = new CheckboxController('add_printer_material[' . $_POST['index'] . '][colours]', [
            'empty' => [
                'message' => 'Please select at least one colour!'
            ]
        ], 'This is all okay!');

        // Print the inputs
?>
<div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
    <label for="<?php echo $add_printer_material->name; ?>">Select a Printing Material</label>
    <div class="select-wrapper">
        <select name="<?php echo $add_printer_material->name; ?>"
                id="<?php echo $add_printer_material->name; ?>"
                class="select">
            <option value="-">-- Select a Material --</option>
            <?php $add_printer_material->show_options(); ?>
        </select>
    </div>
    <?php $add_printer_material->display_message_with_view(); ?>

    <label>Select This Material's Colour</label>
    <div class="material-colours-wrapper inline-fix">
        <?php
            foreach($catalogue_model->colours as $colour) {
                $add_printer_material_colour->name = 'add_printer_material[' . $_POST['index'] . '][colours][' . $colour['colour_code'] . ']';
                $add_printer_material_colour->display_with_view('MaterialColours');
            }
        ?>
    </div>
</div>
<?php
    }
?>
