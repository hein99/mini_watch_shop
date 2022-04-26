<?php displayAdminPageHeader('Edit Admin', 'admins') ?>
<main>
    <h1>Edit Admin - ID:<?php echo $data['admin']->getValue('id') ?></h1>
    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>
    <form action="<?php echo APP_URL ?>admin/admins/edit/<?php echo $data['admin']->getValue('id') ?>" method="post">
        <input type="hidden" name='id' value="<?php echo $data['admin']->getValue('id') ?>">    

        <label for="email">Email</label>
        <input type="email" <?php validateField('email', $data['missing_fields']) ?> id="email" name="email" placeholder="abc@example.com" value="<?php echo $data['admin']->getValueEncoded('email') ?>" required>

        <label for="password">Password</label>
        <input type="password" <?php validateField('password', $data['missing_fields']) ?> id="password" name="password">

        <label for="name">Admin Name</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" value="<?php echo $data['admin']->getValueEncoded('name') ?>" required>

        <label for="phone">Phone</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="phone" name="phone" value="<?php echo $data['admin']->getValueEncoded('phone') ?>" required>

        <input type="submit" name="action" value="Edit">
    </form>
</main>
<?php displayAdminPageFooter() ?>