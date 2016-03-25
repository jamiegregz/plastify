<?php
    // Start the session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/controllers/PageController.class.php');

    // Page Config
    $page = new PageController();
    $page->name = 'error';
    $page->title = 'Error 404';


    // Get all of the specified contents, scripts, CSS, etc. to be displayed into the PageController
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/pages/' . $page->name . 'View.inc.php');

    // Finally, build the page with the layout
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/layouts/ErrorLayout.inc.php');
?>
