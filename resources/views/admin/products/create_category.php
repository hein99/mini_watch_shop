<?php displayAdminPageHeader('Create Category', 'products') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/products">Products Home</a></li>
        <li>Create Category</li>
    </ul>    

    <div class="cat-form-wrap">
        <div>
            <?php if($data['error_messages']) : ?>
                <ul class="error-container">
                    <?php foreach($data['error_messages'] as $error_message) : ?>
                        <li><?php echo $error_message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="cat-form-container">
                <h1>Create Category</h1>
                <form action="<?php echo APP_URL ?>admin/products/create_category" method="post" enctype="multipart/form-data">
                    <label for="name">Name</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" placeholder="Casio Edifice" value="<?php echo $data['category']->getValueEncoded('name') ?>" required>
                    <div class="highlighted-bar"></div>

                    <label for="photo">Thumbnail</label>
                    <input type="file" id="photo" name="photo">

                    <input type="submit" name="action" Value="Create">
                </form>
            </div>
        </div>
    </div>
</main>
<?php displayAdminPageFooter() ?>