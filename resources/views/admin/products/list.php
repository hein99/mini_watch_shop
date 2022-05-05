<?php displayAdminPageHeader('Products', 'products') ?>
<main class="w-80">

    <div class="products-pg-header">
        <h1 class="pg-title">Products</h1>
        
        <div>
            <a href="<?php echo APP_URL ?>admin/products/create_category">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                </svg>&nbsp;Category
            </a>
            
            <a href="<?php echo APP_URL ?>admin/products/create">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
            </svg>&nbsp;Product
            </a>
        </div>
    </div>


    <?php foreach($data['categories'] as $category) : ?>
        <div class="cat-header">
            <h2><?php echo $category->getValueEncoded('name') ?></h2>
            <a href="<?php echo APP_URL ?>admin/products/edit_category/<?php echo $category->getValue('id') ?>">Edit</a> | <a href="<?php echo APP_URL ?>admin/products/delete_category/<?php echo $category->getValue('id') ?>">Delete</a>
        </div>

        <?php 
        $products = Models\Product::getByCategoryID($category->getValue('id'));
        if($products) : 
        ?>
        <div class="products-container">
            <?php foreach($products as $product) : ?>
                <div class="product-card">
                    <a href="<?php echo APP_URL ?>admin/products/edit/<?php echo $product->getValue('id') ?>">
                        <div class="img-container">
                            <?php if($product->getValue('photo_qty') > 0) : ?>
                                <img src="<?php echo APP_URL . $product->getValue('photo_name') . '0.jpg' ?>" alt="<?php echo $product->getValueEncoded('name') ?>">
                            <?php else: ?>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                                        <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V5z"/>
                                        <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a5.99 5.99 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A5.99 5.99 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667H5.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h3><?php echo $product->getValueEncoded('name') ?></h3>
                            <?php if($product->getValue('discount_percentage')) : ?>
                                <p class="price">
                                    <span><?php echo number_format($product->getValueEncoded('price')) ?></span>
                                    <span><?php echo $product->getFinalPrice() ?> MMK</span>
                                </p>
                                <div class="discount">-<?php echo $product->getValueEncoded('discount_percentage') ?>%</div>
                            <?php else : ?>
                                <p class="price">
                                    <span></span>
                                    <span><?php echo $product->getFinalPrice() ?> MMK</span>
                                </p>
                            <?php endif; ?>

                            <?php if($product->getValue('is_out_of_stock')) : ?>
                                <div>Out of Stock</div>
                            <?php endif; ?>
                        </div>
                    </a>

                </div>
            <?php endforeach; ?>
        </div>

        <?php else : ?>
            <div class="empty-product">There are no products in this category</div>
        <?php endif; ?>
    <?php endforeach; ?>
</main>
<?php displayAdminPageFooter() ?>