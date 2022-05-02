<?php displayAdminPageHeader('Banners', 'banners') ?>
<main class="w-80">
    <h1 class="pg-title">Banners</h1>
    <div class="banner-add-form-container">
        <div>
            <div class="banner-preview">
                <h2>Preview Image</h2>
                <img src="" alt="Banner Preview" width="300" height="150">
            </div>

            <form action="<?php echo APP_URL ?>admin/banners/create" method="post" enctype="multipart/form-data">
                <input id="banner-photo" type="file" accept=".jpg,.png,.gif" name="photo" required>
                <input type="submit" name="action" value="Add Photo">
            </form>
        </div>
    </div>

    <div class="banners-container">
        <?php foreach($data['banners'] as $banner) : ?>
            <div class="banner">
                <img src="<?php echo APP_URL . $banner->getValue('photo_name') ?>" width="300" height="150" alt="Banner">
                <a href="<?php echo APP_URL ?>admin/banners/delete/<?php echo $banner->getValue('id') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
    // The following code is for preview image to upload
    const file_element = document.querySelector('#banner-photo');
    
    file_element.addEventListener('change', event => {
        const div_element = document.querySelector('.banner-preview');
        const img_element = document.querySelector('.banner-preview>img');

        img_element.src = URL.createObjectURL(file_element.files[0]);
        div_element.style.display = 'block';
    });
</script>
<?php displayAdminPageFooter() ?>