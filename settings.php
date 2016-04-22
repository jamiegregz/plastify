<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/LoginManager.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/ChangeEmailManager.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/event_managers/ChangePasswordManager.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/models/UserModel.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/objects/SecureSession.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'settings';
    $page->title = 'Account Settings';

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

    // Setup the pages forms
    $change_email_new = new InputController('change_email_new', [
        'empty' => [
            'message' => 'Please enter a new email!'
        ],
        'format_not_email' => [
            'message' => 'This is not a valid email address!'
        ],
        'email_exists' => [
            'message' => 'This email is already registered!'
        ]
    ], 'This is all okay!');

    $change_email_password = new InputController('change_email_password', [
        'empty' => [
            'message' => 'Please enter your password!'
        ],
        'password_not_correct' => [
            'message' => 'The password you have entered is incorrect!'
        ]
    ], '');

    $change_password_new = new InputController('change_password_new', [
        'empty' => [
            'message' => 'You mush choose a new password!'
        ],
        'format_not_password' => [
            'message' => 'Your password must be at least 7 characters long, and contain a mix of numbers and letters'
        ]
    ], '');

    $change_password_confirm = new InputController('change_password_confirm', [
        'empty' => [
            'message' => 'Please confirm your password!'
        ],
        'does_not_match_string' => [
            'string' => $change_password_new->user_input,
            'message' => 'The passwords you have entered don\'t match!'
        ]
    ], '');

    $change_password_current = new InputController('change_password_current', [
        'empty' => [
            'message' => 'Please enter your current password!'
        ],
        'password_not_correct' => [
            'message' => 'The password you have entered is incorrect!'
        ]
    ], '');

    $deactivate_account_password = new InputController('deactivate_account_password', [
        'empty' => [
            'message' => 'Please enter your current password!'
        ]
    ], '');

    if($change_email_new->is_submitted_and_valid() &&
       $change_email_password->is_submitted_and_valid()) {
        $change_email_manager = new ChangeEmailManager();

        $change_email_manager->set_input_values(
            $change_email_new->user_input
        );

        if(!$change_email_manager->change_email()) {
            $page->error_message = 'We are having problems changing your email, please try again later.';
        } else {
            // The email address was changed
            $page->success_message = 'Your email address was successfully changed!';
        }
    }

    if($change_password_new->is_submitted_and_valid() &&
       $change_password_confirm->is_submitted_and_valid() &&
       $change_password_current->is_submitted_and_valid()) {
        $change_password_manager = new ChangePasswordManager();

        $change_password_manager->set_input_values(
            $change_password_new->user_input
        );

        if(!$change_password_manager->change_email()) {
            $page->error_message = 'We are having problems changing your password, please try again later.';
        } else {
            // The email address was changed
            $page->success_message = 'Your password has successfully been changed!';
        }
    }

    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/MainLayout.inc.php');
?>
