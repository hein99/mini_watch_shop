<?php displayAdminPageHeader('Create Category', 'products') ?>
<main>
    <h1>Create Category</h1>
    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>
    <form action="<?php echo APP_URL ?>admin/products/create_category" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" placeholder="Casio Edifice" value="<?php echo $data['category']->getValueEncoded('name') ?>" required>

        <label for="photo">Thumbnail</label>
        <input type="file" id="photo" name="photo">

        <input type="submit" name="action" Value="Create">
    </form>
</main>
<?php displayAdminPageFooter() ?>