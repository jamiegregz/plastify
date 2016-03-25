<?php
    // Start the session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'login';
    $page->title = 'Login';

    $user = null;
    // Check if a session is set
    if($page->session_set()) {
        // Redirect the user to the marketplace
        $page->redirect_to('marketplace');
    }

    // Setup the pages forms
    $login_username = new InputController('login_username');
    $login_username->set_error_validation([
        'empty' => [
            'message' => 'Please enter a username!'
        ]
    ]);
    $login_username->set_success_message('');
    $login_username->get_validation_attributes();

    $login_password = new InputController('login_password');
    $login_password->set_error_validation([
        'empty' => [
            'message' => 'Please enter your password!'
        ]
    ]);
    $login_password->set_success_message('');
    $login_password->get_validation_attributes();

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/LoginLayout.inc.php');
?>
