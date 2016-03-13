<head>
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
    ?>
</head>
