<div class="menu-wrapper width-1 width-large-2-12 width-medium-3-12 width-small-3-12 width-tiny-11-12">
    <ul>
        <?php if(!$login_manager->is_loggedin()): ?>
            <a href="login"><li>Login or Signup</li></a>
        <?php else: ?>
            <a href="logout"><li>Logout</li></a>
        <?php endif ?>
        <a href="marketplace"><li <?php
            if($page->name == "marketplace") echo 'class="selected"';
        ?>>Marketplace</li></a>
        <a href="settings"><li <?php
            if($page->name == "settings") echo 'class="selected"';
        ?>>Account Settings</li></a>
        <hr />
        <a href="addprinter"><li <?php
            if($page->name == "addprinter") echo 'class="selected"';
        ?>>Add a Printer</li></a>
        <a href="addmodel"><li <?php
            if($page->name == "addmodel") echo 'class="selected"';
        ?>>Upload a Model</li></a>
    </ul>
</div>
