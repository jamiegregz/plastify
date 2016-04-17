<?php
    // Include all dependencies and classes
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/LoginManager.inc.php');

    // Page Config
    $page = new PageController();
    $page->name = 'login';
    $page->title = 'Login';

    $user = null;

    $page->start_session();

    // Check if the user is loggedin
    $login_manager = new LoginManager();

    if($login_manager->is_loggedin()) {
        // Redirect the user to the marketplace
        $page->redirect_to('marketplace');
    }

    // Setup the pages forms

    $login_username = new InputController('login_username', [
        'empty' => [
            'message' => 'Please enter a username!'
        ]
    ], '');

    $login_password = new InputController('login_password', [
        'empty' => [
            'message' => 'Please enter your password!'
        ]
    ], '');

    // Check if the username is valid
    if($login_username->is_submitted_and_valid() &&
       $login_password->is_submitted_and_valid()) {
        // Access the login event manager and attempt to log the user in
        $login_manager = new LoginManager();

        $login_manager->set_input_values(
            $login_username->user_input,
            $login_password->user_input
        );

        if($login_manager->login_details_are_valid()) {
            // The login details provided by the user are valid, initiate the login process
            if($login_manager->login()) {
                // The user is now logged in, redirect to the marketplace
                $page->redirect_to('marketplace');
            } else {
                $page->error_message = 'We are having a few issues logging you in. Please try again later.';
            }
        } else {
            // The login details are invalid, set the input error messages
            $login_username->force_custom_error_message('The username or password is incorrect!');
            $login_password->force_custom_error_message('');
        }
    }

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/LoginLayout.inc.php');
?>
