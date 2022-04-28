<?php displayAdminPageHeader('Banners', 'banners') ?>
<main>
    <?php foreach($data['banners'] as $banner) : ?>
        <div>
            <img src="<?php echo APP_URL . $banner->getValue('photo_name') ?>" alt="Banner">
            <a href="<?php echo APP_URL ?>admin/banners/delete/<?php echo $banner->getValue('id') ?>">Delete</a>
        </div>
    <?php endforeach; ?>
    <form action="<?php echo APP_URL ?>admin/banners/create" method="post" enctype="multipart/form-data">
        <input type="file" accept=".jpg,.png,.gif" name="photo" required>
        <input type="submit" name="action" value="Add Photo">
    </form>
</main>
<?php displayAdminPageFooter() ?>