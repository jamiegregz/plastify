<?php ob_start(); ?>

<?php /* Include custom head scripts here... */ ?>
<?php $page->custom_head_scripts = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom CSS here... */ ?>
<?php $page->custom_css = ob_get_contents(); ob_clean(); ?>

<?php /* Include body contents here... */ ?>
<div class="content inline-fix">
    <div class="section">
        <div class="progress-wrapper">
            <div class="progress-node-wrapper">
                <div class="progress-node"></div>
            </div>
            <div class="progress-node-wrapper">
                <div class="progress-node"></div>
            </div>
            <div class="progress-node-wrapper">
                <div class="progress-node"></div>
            </div>
            <div class="progress-node-wrapper">
                <div class="progress-node"></div>
            </div>
            <div class="progress-node-wrapper">
                <div class="progress-node"></div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="content-header">
            1. Printer
        </div>

        <form method="post" class="inline-fix" autocomplete="off">
            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $add_printer_manufacturer->name; ?>">Your Printers Manufacturer</label>
                <div class="select-wrapper">
                    <select name="<?php echo $add_printer_manufacturer->name; ?>"
                            id="<?php echo $add_printer_manufacturer->name; ?>"
                            class="select">
                        <option value="-">-- Select a Manufacturer --</option>
                        <?php $add_printer_manufacturer->show_options(); ?>
                    </select>
                </div>
            </div>

            <div class="button block">Next - Materials</div>
        </form>
    </div>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
