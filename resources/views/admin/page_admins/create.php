<?php displayAdminPageHeader('Admin Create Form', 'admins') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/admins">Page Admins Home</a></li>
        <li>Create Admin</li>
    </ul>

    <div class="admin-form-wrap">
        <div>
            <?php if($data['error_messages']) : ?>
                <ul class="error-container">
                    <?php foreach($data['error_messages'] as $error_message) : ?>
                        <li><?php echo $error_message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="admin-form-container">
                <h1>Create Admin</h1>
                <form action="<?php echo APP_URL ?>admin/admins/create" method="post">
                    <label for="email">Email</label>
                    <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>
                    <div class="highlighted-bar"></div>

                    <label for="password1">Password</label>
                    <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password1" name="password1" required>
                    <div class="highlighted-bar"></div>

                    <label for="password2">Confirm Password</label>
                    <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password2" name="password2" required>
                    <div class="highlighted-bar"></div>
                    
                    <label for="name">Admin Name</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" value="<?php echo $data['admin']->getValueEncoded('name') ?>" required>
                    <div class="highlighted-bar"></div>

                    <label for="phone">Phone</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="phone" name="phone" value="<?php echo $data['admin']->getValueEncoded('phone') ?>" required>
                    <div class="highlighted-bar"></div>
                    
                    <input type="submit" name="action" value="Create">
                </form>
            </div>
        </div>

    </div>
</main>
<?php displayAdminPageFooter() ?>