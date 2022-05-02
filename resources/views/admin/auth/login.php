<?php displayAdminPageHeader('Login', 'login'); ?>

<main class="login-wrap">
    <div>
        <div class="pg-logo">
            <h1><span class="upper">MINI</span><span class="lower">Watch Shop</span></h1>
        </div>
    
        <?php if($data['error_messages']) : ?>
            <ul class="error-container">
                <?php foreach($data['error_messages'] as $error_message) : ?>
                    <li><?php echo $error_message ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="login-form-container">
            <h1>Login to Admin's Area</h1>
                
            <form action="<?php echo APP_URL ?>auth/login" method=post>
                
                <label for="email">Email</label>
                <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>
                <div class="highlighted-bar"></div>
                
                <label for="password">Password</label>
                <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password" name="password" required>
                <div class="highlighted-bar"></div>

                <input type="submit" name="action" value="Login">
            </form>
        </div>
    </div>
</main>

<?php displayAdminPageFooter(); ?>