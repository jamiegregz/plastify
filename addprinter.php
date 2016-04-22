<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/LoginManager.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/UserModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/PrinterModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/CatalogueModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecureSession.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'addprinter';
    $page->title = 'Add a Printer';

    $_SESSION['user'] = null;

    $page->start_session();

    // Check if the user is logged in
    $login_manager = new LoginManager();

    if($login_manager->is_loggedin()) {
        // Create a user model and get the data from the database
        $_SESSION['user'] = new UserModel();
        $_SESSION['user']->fetch_base_data_from_token(SecureSession::get_value('token'));
    } else {
        // Redirect the user to the login page
        $page->redirect_to('login');
    }

    $catalogue_model = new CatalogueModel();
    $catalogue_model->get_printer_manufacturers();
    $catalogue_model->get_printer_materials();

    // Setup the pages forms
    $add_printer_manufacturer = new DropdownController('add_printer_manufacturer', [
        'empty' => [
            'message' => 'Choose a manufacturer from the list!'
        ]
    ], 'This is all okay!');

    foreach($catalogue_model->printer_manufacturers as $manufacturer) {
        $add_printer_manufacturer->add_option($manufacturer['manufacturer_id'], $manufacturer['name']);
    }

    $add_printer_material = new DropdownController('add_printer_material[0][material]', [
        'empty' => [
            'message' => 'Please choose a material from the list!'
        ]
    ], 'This is all okay!');

    foreach($catalogue_model->printer_materials as $material) {
        $add_printer_material->add_option($material['material_id'], $material['name']);
    }

    $add_printer_material_colour = new CheckboxController('add_printer_material[0][colours]', [
        'empty' => [
            'message' => 'Please select at least one colour!'
        ]
    ], 'This is all okay!');

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/MainLayout.inc.php');
?>
