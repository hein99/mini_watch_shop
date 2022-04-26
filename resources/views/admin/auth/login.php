<?php displayAdminPageHeader('Login', 'login'); ?>

<main>
    <h1>Login</h1>
    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>
            
    <form action="<?php echo APP_URL ?>auth/login" method=post>

        <label for="email">Email</label>
        <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>

        <label for="password">Password</label>
        <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password" name="password" required>
        <input type="submit" name="action" value="Login">
    </form>
</main>

<?php displayAdminPageFooter(); ?>