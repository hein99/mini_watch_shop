<?php displayAdminPageHeader('Products', 'products') ?>
<main>
    <h1>Products <a href="<?php echo APP_URL ?>admin/products/create_category">Create Category</a> <a href="<?php echo APP_URL ?>admin/products/create">Create Product</a></h1>

    <?php foreach($data['categories'] as $category) : ?>
        <h2><?php echo $category->getValueEncoded('name') ?> <a href="<?php echo APP_URL ?>admin/products/edit_category/<?php echo $category->getValue('id') ?>">Edit</a> | <a href="<?php echo APP_URL ?>admin/products/delete_category/<?php echo $category->getValue('id') ?>">Delete</a></h2>
        
    <?php endforeach; ?>
</main>
<?php displayAdminPageFooter() ?>