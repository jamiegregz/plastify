<?php ob_start(); ?>

<?php /* Include custom head scripts here... */ ?>
<?php $page->custom_head_scripts = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom CSS here... */ ?>
<?php $page->custom_css = ob_get_contents(); ob_clean(); ?>

<?php /* Include body contents here... */ ?>
<div class="content inline-fix">
    <div class="section">
        <div class="content-header">
            Change Email
        </div>
        <form method="post" class="inline-fix" autocomplete="off">
            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $change_email_new->name; ?>">New Email</label>
                <input type="email"
                       name="<?php echo $change_email_new->name; ?>"
                       id="<?php echo $change_email_new->name; ?>"
                       placeholder="myemail&#64;example.com"
                       value="<?php echo $change_email_new->user_input; ?>"
                       class="<?php echo $change_email_new->status; ?> text width-1" />
                <?php $change_email_new->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $change_email_password->name; ?>">Password Confirmation</label>
                <input type="password"
                       name="<?php echo $change_email_password->name; ?>"
                       id="<?php echo $change_email_password->name; ?>"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="<?php echo $change_email_password->status; ?> text width-1" />
                <?php $change_email_password->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-1">
                <input type="submit"
                       name="change_email_submit"
                       value="Change email"
                       class="button" />
            </div>
        </form>
    </div>

    <div class="section">
        <div class="content-header">
            Change Password
        </div>
        <form method="post" class="inline-fix" autocomplete="off">
            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $change_password_new->name; ?>">New Password</label>
                <input type="email"
                       name="<?php echo $change_password_new->name; ?>"
                       id="<?php echo $change_password_new->name; ?>"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="<?php echo $change_password_new->status; ?> text width-1" />
                <?php $change_password_new->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $change_password_confirm->name; ?>">Confirm Password</label>
                <input type="password"
                       name="<?php echo $change_password_confirm->name; ?>"
                       id="<?php echo $change_password_confirm->name; ?>"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="<?php echo $change_password_confirm->status; ?> text width-1" />
                <?php $change_password_confirm->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $change_password_current->name; ?>">Current Password</label>
                <input type="password"
                       name="<?php echo $change_password_current->name; ?>"
                       id="<?php echo $change_password_current->name; ?>"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="<?php echo $change_password_current->status; ?> text width-1" />
                <?php $change_password_current->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-1">
                <input type="submit"
                       name="change_password_submit"
                       value="Change password"
                       class="button" />
            </div>
        </form>
    </div>

    <div class="section">
        <div class="content-header">
            De-activate Your Account
        </div>
        <form method="post" class="inline-fix" autocomplete="off">
            <div class="input-wrapper width-large-4-12 width-medium-6-12 width-small-6-12 width-tiny-1">
                <label for="<?php echo $deactivate_account_password->name; ?>">Current Password</label>
                <input type="password"
                       name="<?php echo $deactivate_account_password->name; ?>"
                       id="<?php echo $deactivate_account_password->name; ?>"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="<?php echo $deactivate_account_password->status; ?> text width-1" />
                <?php $deactivate_account_password->display_message_with_view(); ?>
            </div>

            <div class="input-wrapper width-1">
                <input type="submit"
                       name="deactivate_account_submit"
                       value="Deactivate your account"
                       class="button" />
            </div>
        </form>
    </div>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
