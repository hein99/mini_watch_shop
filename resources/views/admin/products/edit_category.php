<?php displayAdminPageHeader('Edit Category', 'products') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/products">Products Home</a></li>
        <li>Edit Category</li>
    </ul>

    <div class="cat-photo">
        <?php if($data['category']->getValue('photo_name')) : ?>
            <img src="<?php echo APP_URL . $data['category']->getValue('photo_name') ?>" alt="<?php echo $data['category']->getValueEncoded('name') ?>" width="200">
        <?php else : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
            </svg>
        <?php endif; ?>
    </div>
    
    <div class="cat-form-wrap" style="margin-top: var(--space-5);">
        <div>
            <?php if($data['error_messages']) : ?>
                <ul class="error-container">
                    <?php foreach($data['error_messages'] as $error_message) : ?>
                        <li><?php echo $error_message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <div class="cat-form-container">
                <h1>Edit Category - ID:<?php echo $data['category']->getValue('id') ?></h1>
                <form action="<?php echo APP_URL ?>admin/products/edit_category/<?php echo $data['category']->getValue('id') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data['category']->getValue('id') ?>">
                    <label for="name">Name</label>
                    <input type="text" <?php validateField('name', $data['missing_fields']) ?> id="name" name="name" placeholder="Casio Edifice" value="<?php echo $data['category']->getValueEncoded('name') ?>" required>
                    <div class="highlighted-bar"></div>
                    
                    <label for="photo">Thumbnail</label>
                    <input type="file" id="photo" name="photo">

                    <input type="submit" name="action" Value="Edit">
                </form>
            </div>
        </div>
    </div>

</main>
<?php displayAdminPageFooter() ?>










