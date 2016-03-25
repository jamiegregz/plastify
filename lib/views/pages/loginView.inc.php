<?php ob_start(); ?>

<?php /* Include custom head scripts here... */ ?>
<?php $page->custom_head_scripts = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom CSS here... */ ?>
<?php $page->custom_css = ob_get_contents(); ob_clean(); ?>

<?php /* Include body contents here... */ ?>
<div class="login-content">
    <div class="login-logo">
    </div>

    <form method="post">
        <div class="input-wrapper width-1">
            <label for="<?php echo $login_username->name; ?>">Username</label>
            <input type="text"
                   name="<?php echo $login_username->name; ?>"
                   id="<?php echo $login_username->name; ?>"
                   placeholder=""
                   value="<?php echo $login_username->user_input; ?>"
                   class="<?php echo $login_username->status; ?> text width-1"
                   <?php echo $login_username->validation_attributes; ?> />
            <?php $login_username->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <label for="<?php echo $login_password->name; ?>">Password</label>
            <input type="password"
                   name="<?php echo $login_password->name; ?>"
                   id="<?php echo $login_password->name; ?>"
                   placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                   value=""
                   class="<?php echo $login_password->status; ?> text width-1"
                   <?php echo $login_password->validation_attributes; ?> />
            <?php $login_password->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <input type="submit"
                   name="login_submit"
                   value="Login!"
                   class="button" />
        </div>
    </form>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
