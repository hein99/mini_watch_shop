<?php displayAdminPageHeader('Create Product', 'products') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/products">Products Home</a></li>
        <li>Create Product</li>
    </ul>

    <div class="product-form-wrap">
        <div>
            <?php if($data['error_messages']) : ?>
                <ul class="error-container">
                    <?php foreach($data['error_messages'] as $error_message) : ?>
                        <li><?php echo $error_message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <div class="product-form-container">
                <h1>Create Product</h1>
            
                <form action="<?php echo APP_URL ?>admin/products/create" method="post">
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

                    <div class="inline-field">
                        <div>
                            <label for="price">Price [MMK]</label>
                            <input type="number" <?php validateField('price', $data['missing_fields']) ?> name="price" id="price" placeholder="0" value="<?php echo $data['product']->getValueEncoded('price') ?>" required>
                        </div>

                        <div>
                            <label for="discount_percentage">Discount [%]</label>
                            <input type="number" <?php validateField('discount_percentage', $data['missing_fields']) ?> name="discount_percentage" id="discount_percentage" placeholder="0" value="<?php echo $data['product']->getValueEncoded('discount_percentage') ?>" required>
                        </div>
                    </div>

                    <div class="inline-field">
                        <div>
                            <label for="in-stock">In stock</label>
                            <input type="radio" id="in-stock" name="is_out_of_stock" <?php setChecked($data['product'], 'is_out_of_stock', 0) ?> value="0" required>
                        </div>

                        <div>
                            <label for="out-of-stock">Out of stock</label>
                            <input type="radio" id="out-of-stock" name="is_out_of_stock" <?php setChecked($data['product'], 'is_out_of_stock', 1) ?> value="1" required>
                        </div>
                    </div>

                    <input type="submit" name="action" value="Create">        
                </form>
            </div>
        </div>
    </div>
</main>
<?php displayAdminPageFooter() ?>