<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/LoginManager.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/UserModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecureSession.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'marketplace';
    $page->title = 'Plastify Marketplace';

    $user = null;

    $page->start_session();

    // Check if the user is logged in
    $login_manager = new LoginManager();

    if($login_manager->is_loggedin()) {
        // Create a user model and get the data from the database
        $user = new UserModel();
        $user->fetch_base_data_from_token(SecureSession::get_value('token'));
    }

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/MainLayout.inc.php');
?>
