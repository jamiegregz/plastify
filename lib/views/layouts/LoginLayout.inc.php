<!DOCTYPE HTML>
<html>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/HTMLHead.inc.php'); ?>

    <body>
        <div class="width-1 inline-fix">
            <div class="width-large-4-12 width-medium-2-12 width-1-12"></div>
            <div class="container width-large-4-12 width-medium-8-12 width-10-12">
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
