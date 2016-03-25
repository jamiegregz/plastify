<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <title><?php echo $page->title; ?></title>

    <link rel="stylesheet" type="text/css" href="/css/core-v1.css" />

    <script src="/js/jquery-v1.12.1.min.js"></script>
    <script src="/js/core-v1.js"></script>

    <?php
        // Include any custom scripts/css files
        if($page->has_custom_head_scripts()) {
            echo $page->custom_head_scripts;
        }
        if($page->has_custom_css()) {
            echo $page->custom_css;
        }

        // Check if the page specific CSS/script files exist, then display them
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/js/pages/' . $page->name . '.js')) {
            echo '<script type="text/javascript" src="/js/pages/' . $page->name . '.js"></script>';
        }
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/css/pages/' . $page->name . '.css')) {
            echo '<link rel="stylesheet" type="text/css" href="/css/pages/' . $page->name . '.css" />';
        }
    ?>
</head>
