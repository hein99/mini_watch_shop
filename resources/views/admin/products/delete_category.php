<?php displayAdminPageHeader('Delete Category', 'products') ?>
<main>
    <h1>Delete Category - ID:<?php echo $data['category']->getValue('id') ?></h1>
    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>
    <p>Are you sure? If you delete <b><?php echo $data['category']->getValue('name') ?></b>, its respective all products will be deleted.
        If you are confim, please type <b>'I am sure. Delete this category and its respective data.'</b> in the following text box to confirm</p>
    <form action="<?php echo APP_URL ?>admin/products/delete_category/<?php echo $data['category']->getValue('id') ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $data['category']->getValue('id') ?>">
        <input type="text" name="confirm-text" autocomplete="off" required>
        <input type="submit" name="action" value="Delete">
    </form>
</main>
<?php displayAdminPageFooter() ?>