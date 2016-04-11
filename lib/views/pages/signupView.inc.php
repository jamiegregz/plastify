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
            <label for="<?php echo $signup_username->name; ?>">Username</label>
            <input type="text"
                   name="<?php echo $signup_username->name; ?>"
                   id="<?php echo $signup_username->name; ?>"
                   placeholder="username123"
                   value="<?php echo $signup_username->user_input; ?>"
                   class="<?php echo $signup_username->status; ?> text width-1" />
            <?php $signup_username->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <label for="<?php echo $signup_email->name; ?>">Email</label>
            <input type="email"
                   name="<?php echo $signup_email->name; ?>"
                   id="<?php echo $signup_email->name; ?>"
                   placeholder="myemail&#64;example.com"
                   value="<?php echo $signup_email->user_input; ?>"
                   class="<?php echo $signup_email->status; ?> text width-1" />
            <?php $signup_email->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <label for="<?php echo $signup_password->name; ?>">Password</label>
            <input type="password"
                   name="<?php echo $signup_password->name; ?>"
                   id="<?php echo $signup_password->name; ?>"
                   placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                   class="<?php echo $signup_password->status; ?> text width-1" />
            <?php $signup_password->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <label for="<?php echo $signup_password_confirm->name; ?>">Confirm Password</label>
            <input type="password"
                   name="<?php echo $signup_password_confirm->name; ?>"
                   id="<?php echo $signup_password_confirm->name; ?>"
                   placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                   class="<?php echo $signup_password_confirm->status; ?> text width-1" />
            <?php $signup_password_confirm->display_message_with_view(); ?>
        </div>

        <div class="input-wrapper width-1">
            <input type="submit"
                   name="signup_submit"
                   value="Signup!"
                   class="button" />
        </div>
    </form>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
