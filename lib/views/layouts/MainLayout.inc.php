<!DOCTYPE HTML>
<html>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/HTMLHead.inc.php'); ?>

    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/Navbar.inc.php'); ?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/Sidebar.inc.php'); ?>

        <div class="width-1 inline-fix">
            <div class="width-1 width-large-2-12 width-medium-3-12 width-small-3-12 width-tiny-1"></div>
            <div class="content-wrapper width-1 width-large-10-12 width-medium-9-12 width-small-9-12 width-tiny-1">
                <?php if($page->error_message_exists()): ?>
                    <div class="width-1page-error-wrapper">
                        <div class="page-error-content">
                            <?php echo $page->error_message; ?>
                        </div>
                    </div>
                <?php endif ?>

                <?php if($page->success_message_exists()): ?>
                    <div class="width-1 page-success-wrapper">
                        <div class="page-success-content">
                            <?php echo $page->success_message; ?>
                        </div>
                    </div>
                <?php endif ?>

                <?php echo $page->content; ?>

                <?php include($_SERVER['DOCUMENT_ROOT'] . '/lib/views/includes/Footer.inc.php'); ?>
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
