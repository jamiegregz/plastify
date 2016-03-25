<?php
    // Start the session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'signup';
    $page->title = 'Signup';

    $user = null;
    // Check if a session is set
    if($page->session_set()) {
        // Redirect the user to the marketplace
        $page->redirect_to('marketplace');
    }

    // Setup the pages forms
    $signup_username = new InputController('signup_username');
    $signup_username->set_error_validation([
        'empty' => [
            'message' => 'Please create a username!'
        ],
        'format_not_username' => [
            'message' => 'Your username must be at least 6 characters long.'
        ],
        'username_exists' => [
            'message' => 'This username is already taken! Please choose a different one.'
        ]
    ]);
    $signup_username->set_success_message('This is all okay!');
    $signup_username->get_validation_attributes();

    $signup_email = new InputController('signup_email');
    $signup_email->set_error_validation([
        'empty' => [
            'message' => 'Please enter your email address!'
        ],
        'format_not_email' => [
            'message' => 'This is not a valid email address.'
        ],
        'email_exists' => [
            'message' => 'This email is already registered!'
        ]
    ]);
    $signup_email->set_success_message('This is all okay!');
    $signup_email->get_validation_attributes();

    $signup_password = new InputController('signup_password');
    $signup_password->set_error_validation([
        'empty' => [
            'message' => 'You must choose a password!'
        ],
        'format_not_password' => [
            'message' => 'Your password must be at least 7 characters long, and contain a mix of numbers and letters'
        ]
    ]);
    $signup_password->get_validation_attributes();

    $signup_password_confirm = new InputController('signup_password');
    $signup_password_confirm->set_error_validation([
        'empty' => [
            'message' => 'You must confirm your password'
        ],
        'does_not_match_string' => [
            'string' => $signup_password->user_input,
            'message' => 'The passwords don\'t match!'
        ]
    ]);
    $signup_password_confirm->get_validation_attributes();

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/LoginLayout.inc.php');
?>
