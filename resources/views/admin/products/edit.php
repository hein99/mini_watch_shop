<?php displayAdminPageHeader('Edit Product', 'products') ?>
<main>
    <h1>Edit Product - ID:<?php echo $data['product']->getValue('id') ?></h1>
    <?php 
        if((int)$data['product']->getValue('photo_qty')>0) : 
            for($i=0; $i < $data['product']->getValue('photo_qty'); $i++) :
    ?>
        <img src="<?php echo APP_URL . $data['product']->getValue('photo_name') . $i . '.jpg' ?>" alt="<?php echo $data['product']->getValueEncoded('name') ?>">
    <?php 
            endfor;
        ?>
        <a href="<?php echo APP_URL ?>admin/products/delete_photos/<?php echo $data['product']->getValue('id') ?>">Delete All Photos</a>
        <?php
        else: 
    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
            <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V5z"/>
            <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a5.99 5.99 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A5.99 5.99 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667H5.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
        </svg>
    <?php endif; ?>

    <form action="<?php echo APP_URL ?>admin/products/add_photo" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['product']->getValue('id') ?>">
        <input type="file" accept=".jpg" name="photo" required>
        <input type="submit" name="action" value="Add Photo">
    </form>

    <?php foreach($data['error_messages'] as $error_message) : ?>
        <p><?php echo $error_message ?></p>
    <?php endforeach; ?>

    <form action="<?php echo APP_URL ?>admin/products/edit/<?php echo $data['product']->getValue('id') ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $data['product']->getValue('id') ?>">

        <label for="name">Name</label>
        <input type="text" <?php validateField('name', $data['missing_fields']) ?> name="name" id="name" placeholder="EF 550 SP" value="<?php echo $data['product']->getValueEncoded('name') ?>" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" required><?php echo $data['product']->getValueEncoded('description') ?></textarea>

        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            <option value="">--Select--</option>
            <?php foreach($data['categories'] as $category) : ?>
                <option value="<?php echo $category->getValue('id') ?>" <?php setSelected($data['product'], 'category_id', $category->getValue('id')) ?>><?php echo $category->getValueEncoded('name') ?></option>
            <?php endforeach ?>
        </select>

        <label for="price">Price [MMK]</label>
        <input type="number" <?php validateField('price', $data['missing_fields']) ?> name="price" id="price" placeholder="0" value="<?php echo $data['product']->getValueEncoded('price') ?>" required>

        <label for="discount_percentage">Discount [%]</label>
        <input type="number" <?php validateField('discount_percentage', $data['missing_fields']) ?> name="discount_percentage" id="discount_percentage" placeholder="0" value="<?php echo $data['product']->getValueEncoded('discount_percentage') ?>" required>

        <label for="in-stock">In stock</label>
        <input type="radio" id="in-stock" name="is_out_of_stock" <?php setChecked($data['product'], 'is_out_of_stock', 0) ?> value="0" required>

        <label for="out-of-stock">Out of stock</label>
        <input type="radio" id="out-of-stock" name="is_out_of_stock" <?php setChecked($data['product'], 'is_out_of_stock', 1) ?> value="1" required>

        <input type="submit" name="action" value="Edit">
    </form>
</main>
<?php displayAdminPageFooter() ?>