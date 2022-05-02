<?php displayAdminPageHeader('Edit Admin', 'admins') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/admins">Page Admins Home</a></li>
        <li>Edit Admin</li>
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
                <h1>Edit Admin - ID:<?php echo $data['admin']->getValue('id') ?></h1>
                <form action="<?php echo APP_URL ?>admin/admins/edit/<?php echo $data['admin']->getValue('id') ?>" method="post">
                    <input type="hidden" name='id' value="<?php echo $data['admin']->getValue('id') ?>">    

                    <label for="email">Email</label>
                    <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>
                    <div class="highlighted-bar"></div>

                    <label for="password">Password</label>
                    <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password" name="password">
                    <div class="highlighted-bar"></div>

                    <label for="name">Admin Name</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" value="<?php echo $data['admin']->getValueEncoded('name') ?>" required>
                    <div class="highlighted-bar"></div>

                    <label for="phone">Phone</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="phone" name="phone" value="<?php echo $data['admin']->getValueEncoded('phone') ?>" required>
                    <div class="highlighted-bar"></div>

                    <input type="submit" name="action" value="Edit">
                </form>
            </div>
        </div>
    </div>
</main>
<?php displayAdminPageFooter() ?>