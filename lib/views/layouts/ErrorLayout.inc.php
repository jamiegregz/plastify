<!DOCTYPE HTML>
<html>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/HTMLHead.inc.php'); ?>

    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/Navbar.inc.php'); ?>

        <div class="width-1 inline-fix">
            <div class="width-1 width-large-2-12 width-medium-3-12 width-small-3-12 width-tiny-1"></div>
            <div class="content-wrapper width-1 width-large-10-12 width-medium-9-12 width-small-9-12 width-tiny-1">
                <?php echo $page->content; ?>
            </div>
        </div>

        <?php
            // Check if custom body scripts are set
            if($page->has_custom_body_scripts()) {
                echo $page->custom_body_scripts;
            }
        ?>
    </body>
</html>
