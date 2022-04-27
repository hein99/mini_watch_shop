<?php displayAdminPageHeader('Admin Create Form', 'admins') ?>
<main>
    <h1>Create Admin</h1>
    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>
    <form action="<?php echo APP_URL ?>admin/admins/create" method="post">
        <label for="email">Email</label>
        <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>

        <label for="password1">Password</label>
        <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password1" name="password1" required>

        <label for="password2">Confirm Password</label>
        <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password2" name="password2" required>

        <label for="name">Admin Name</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" value="<?php echo $data['admin']->getValueEncoded('name') ?>" required>

        <label for="phone">Phone</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="phone" name="phone" value="<?php echo $data['admin']->getValueEncoded('phone') ?>" required>

        <input type="submit" name="action" value="Create">
    </form>
</main>
<?php displayAdminPageFooter() ?>