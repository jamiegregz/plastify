<?php
    // Start the session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'marketplace';
    $page->title = 'Plastify Marketplace';

    $user = null;
    // Check if a session is set
    if($page->session_set()) {
        // Create a user model and get the data from the database
        $user = new UserModel();
        $user->fetch_base_data_from_token($page->session_token);
    }

    // Set all of the required form inputs
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/pages/marketplaceController.inc.php');

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/marketplaceView.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/MainLayout.inc.php');
?>
