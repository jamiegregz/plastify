<?php
    // Start the session
    session_start();

    // Include dependencies
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/SignupManager.inc.php');

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
    $signup_username = new InputController('signup_username', [
        'empty' => [
            'message' => 'Please create a username!'
        ],
        'format_not_username' => [
            'message' => 'Your username must be at least 6 characters long.'
        ],
        'username_exists' => [
            'message' => 'This username is already taken! Please choose a different one.'
        ]
    ], 'This is all okay!');

    $signup_email = new InputController('signup_email', [
        'empty' => [
            'message' => 'Please enter your email address!'
        ],
        'format_not_email' => [
            'message' => 'This is not a valid email address.'
        ],
        'email_exists' => [
            'message' => 'This email is already registered!'
        ]
    ], 'This is all okay!');

    $signup_password = new InputController('signup_password', [
        'empty' => [
            'message' => 'You must choose a password!'
        ],
        'format_not_password' => [
            'message' => 'Your password must be at least 7 characters long, and contain a mix of numbers and letters'
        ]
    ], '');

    $signup_password_confirm = new InputController('signup_password_confirm', [
        'empty' => [
            'message' => 'You must confirm your password'
        ],
        'does_not_match_string' => [
            'string' => $signup_password->user_input,
            'message' => 'The passwords don\'t match!'
        ]
    ], '');

    if($signup_username->is_submitted_and_valid() &&
       $signup_email->is_submitted_and_valid() &&
       $signup_password->is_submitted_and_valid() &&
       $signup_password_confirm->is_submitted_and_valid()) {
        // Initiate the signup process
        $signup_manager = new SignupManager();
        $signup_manager->set_input_values(
            $signup_username->user_input,
            $signup_email->user_input,
            $signup_password->user_input,
            $signup_password_confirm->user_input
        );
        $signup_manager->signup();
    }
    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/LoginLayout.inc.php');
?>
