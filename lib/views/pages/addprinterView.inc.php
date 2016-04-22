<?php ob_start(); ?>

<?php /* Include custom head scripts here... */ ?>
<?php $page->custom_head_scripts = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom CSS here... */ ?>
<?php $page->custom_css = ob_get_contents(); ob_clean(); ?>

<?php /* Include body contents here... */ ?>
<div class="content inline-fix">
    <div class="section">
        <div class="width-large-3-12 width-medium-2-12 width-small-1-12"></div>
        <div class="progress-wrapper inline-fix width-1 width-large-6-12 width-medium-8-12 width-small-10-12 width-tiny-1">
            <div class="progress-node-wrapper width-3-12">
                <div class="progress-node"></div>
                <p>Printer</p>
            </div>
            <div class="progress-node-wrapper width-3-12">
                <div class="progress-node"></div>
                <p>Materials</p>
            </div>
            <div class="progress-node-wrapper width-3-12">
                <div class="progress-node"></div>
                <p>Pricing &amp; Delivery</p>
            </div>
            <div class="progress-node-wrapper width-3-12">
                <div class="progress-node"></div>
                <p>Payment Details</p>
            </div>
        </div>
    </div>
    <form method="post" autocomplete="off">
        <div id="form-section-printer">
            <div class="section inline-fix">
                <div class="content-header">
                    Your Printer
                </div>
                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Your Printer's Manufacturer</label>
                    <div class="select-wrapper">
                        <select name="<?php echo $add_printer_manufacturer->name; ?>"
                                id="<?php echo $add_printer_manufacturer->name; ?>"
                                class="select">
                            <option value="-">-- Select a Manufacturer --</option>
                            <?php $add_printer_manufacturer->show_options(); ?>
                        </select>
                    </div>
                </div>
                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Select Your Printer's Model...</label>
                    <div class="select-wrapper">
                        <select name="<?php echo $add_printer_manufacturer->name; ?>"
                                id="<?php echo $add_printer_manufacturer->name; ?>"
                                class="select">
                            <option value="-">-- Select Your Model --</option>
                            <?php $add_printer_manufacturer->show_options(); ?>
                        </select>
                    </div>

                    <label for="<?php echo $add_printer_manufacturer->name; ?>">... Or Enter It's Name</label>
                    <input type="text"
                           name="<?php echo $add_printer_manufacturer->name; ?>"
                           id="<?php echo $add_printer_manufacturer->name; ?>"
                           placeholder="Model 3D"
                           value="<?php echo $add_printer_manufacturer->user_input; ?>"
                           class="<?php echo $add_printer_manufacturer->status; ?> text width-1" />
                    <?php $add_printer_manufacturer->display_message_with_view(); ?>
                </div>
            </div>

            <div class="section inline-fix">
                <div class="content-header">
                    Technical Details
                </div>
                <div class="input-group width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1 inline-fix
                            <?php echo $add_printer_manufacturer->status; ?>">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Maximum Print Size (mm)</label>
                    <div class="input-wrapper width-5-12">
                        <input type="text"
                               name="<?php echo $add_printer_manufacturer->name; ?>"
                               id="<?php echo $add_printer_manufacturer->name; ?>"
                               placeholder="300"
                               value="<?php echo $add_printer_manufacturer->user_input; ?>"
                               class="text width-1" />
                    </div>
                    <div class="input-wrapper width-2-12">
                    <div class="input-addon width-1">
                        x
                    </div>
                    </div>
                    <div class="input-wrapper width-5-12">
                        <input type="text"
                               name="<?php echo $add_printer_manufacturer->name; ?>"
                               id="<?php echo $add_printer_manufacturer->name; ?>"
                               placeholder="400"
                               value="<?php echo $add_printer_manufacturer->user_input; ?>"
                               class="text width-1" />
                    </div>

                    <?php $add_printer_manufacturer->display_message_with_view(); ?>
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Printer Resolution (mm)</label>
                    <input type="text"
                           name="<?php echo $add_printer_manufacturer->name; ?>"
                           id="<?php echo $add_printer_manufacturer->name; ?>"
                           placeholder="1.5"
                           value="<?php echo $add_printer_manufacturer->user_input; ?>"
                           class="<?php echo $add_printer_manufacturer->status; ?> text width-1" />
                    <?php $add_printer_manufacturer->display_message_with_view(); ?>
                </div>
            </div>

            <div class="section inline-fix">
                <div class="content-header">
                    Customise
                </div>
                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Custom Name</label>
                    <input type="text"
                           name="<?php echo $add_printer_manufacturer->name; ?>"
                           id="<?php echo $add_printer_manufacturer->name; ?>"
                           placeholder="<?php echo $_SESSION['user']->data['username']; ?>'s Printer"
                           value="<?php echo $add_printer_manufacturer->user_input; ?>"
                           class="<?php echo $add_printer_manufacturer->status; ?> text width-1" />
                    <?php $add_printer_manufacturer->display_message_with_view(); ?>
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_manufacturer->name; ?>">Printer's Description</label>
                    <textarea type="text"
                           name="<?php echo $add_printer_manufacturer->name; ?>"
                           id="<?php echo $add_printer_manufacturer->name; ?>"
                           placeholder="<?php echo $_SESSION['user']->data['username']; ?>'s Printer"
                           value="<?php echo $add_printer_manufacturer->user_input; ?>"
                           class="<?php echo $add_printer_manufacturer->status; ?> text width-1">
                    </textarea>
                    <?php $add_printer_manufacturer->display_message_with_view(); ?>
                </div>

                <div class="input-wrapper">
                    <div class="button block">Next - Materials</div>
                </div>
            </div>
        </div>

        <div id="form-section-materials">
            <div class="section inline-fix">
                <div class="content-header">
                    Materials
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <label for="<?php echo $add_printer_material->name; ?>">Select a Printing Material</label>
                    <div class="select-wrapper">
                        <select name="<?php echo $add_printer_material->name; ?>"
                                id="<?php echo $add_printer_material->name; ?>"
                                class="select">
                            <option value="-">-- Select a Material --</option>
                            <?php $add_printer_material->show_options(); ?>
                        </select>
                    </div>
                    <?php $add_printer_material->display_message_with_view(); ?>

                    <label>Select This Material's Colour</label>
                    <div class="material-colours-wrapper inline-fix">
                        <?php
                            // Loop each through each colour
                            $catalogue_model->get_colours();
                            foreach($catalogue_model->colours as $colour) {
                                $add_printer_material_colour->name = 'add_printer_material[0][colours][' . $colour['colour_code'] . ']';
                                $add_printer_material_colour->display_with_view('MaterialColours');
                            }
                        ?>
                    </div>
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <div class="button" id="add-material-button">Add another material</div>
                </div>
            </div>
        </div>

        <div id="form-section-pricing-delivery">
            <div class="section inline-fix">
                <div class="content-header">
                    Pricing &amp; Delivery
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                </div>
            </div>
        </div>

        <div id="form-section-payment-details">
            <div class="section inline-fix">
                <div class="content-header">
                    Payment Details
                </div>

                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                </div>
                <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                    <div class="input-wrapper width-1">
                        <input type="submit"
                               name="add_printer_submit"
                               value="Change email"
                               class="button" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
