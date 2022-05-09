<?php displayPageHeader('Detail Product', 'products') ?>
<div class="products-pg-banner">
    <h1 class="h4"><a href="<?php echo APP_URL ?>products">Watches</a> / Product Detail </h1>
    <div class="overlay"></div>
</div>

<div class="product-wrap">
    <div class="container">
        <h1><span><?php echo $data['category']->getValue('name') ?></span><br><span><?php echo $data['product']->getValue('name') ?></span></h1>
        <img src="<?php echo APP_URL . $data['category']->getValue('photo_name') ?>" alt="<?php echo $data['category']->getValue('name') ?>" class="brand-logo" width="80">
        <div class="row">
            <div class="col-12 col-md-6 img-gallary-container">
                <?php if((int)$data['product']->getValue('photo_qty')>0) : ?>
                    <div class="selected-img-container">
                        <img src="<?php echo APP_URL . $data['product']->getValue('photo_name') . '0.jpg' ?>" id="selected-img">
                    </div>
                    <div class="img-list">
                        <?php for($i=0; $i < $data['product']->getValue('photo_qty'); $i++) : ?>
                            <img src="<?php echo APP_URL . $data['product']->getValue('photo_name') . $i . '.jpg' ?>" alt="<?php echo $data['product']->getValueEncoded('name') ?>">
                        <?php endfor; ?>
                    </div>
                <?php else: ?>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="165" height="165" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                            <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V5z"/>
                            <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a5.99 5.99 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A5.99 5.99 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667H5.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6">
                <div class="product-info">
                    <h1><?php echo $data['product']->getValue('name') ?></h1>
                    <?php if($data['product']->getValue('discount_percentage')) : ?>
                        <p class="price">
                            <span><?php echo number_format($data['product']->getValueEncoded('price')) ?></span>
                            <span><?php echo $data['product']->getFinalPrice() ?> MMK</span>
                        </p>
                        <div class="discount"><?php echo $data['product']->getValueEncoded('discount_percentage') ?>% OFF</div>
                    <?php else : ?>
                        <p class="price">
                            <span></span>
                            <span><?php echo $data['product']->getFinalPrice() ?> MMK</span>
                        </p>
                    <?php endif; ?>
                    <button id="buy-now" data-category="<?php echo $data['category']->getValue('name') ?>" data-form_action ="<?php echo APP_URL ?>orders/add"
                        data-product="<?php echo preg_replace('/[\"]/', '\'', json_encode([
                            'id' => $data['product']->getValue('id'), 
                            'name' => $data['product']->getValue('name'), 
                            'photo_name' => APP_URL . $data['product']->getValue('photo_name') . '0.jpg',
                            'discount_percentage' => $data['product']->getValue('discount_percentage'),
                            'price' => $data['product']->getValue('price'),
                            'final_price' => $data['product']->getFinalPrice(),
                            ])) ?>">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container product-description">
    <h2 class="h4">Product Description</h2>
    <p><?php echo $data['product']->getValueEncoded('description') ?></p>
</div>
<!-- 6caa320f968856f8f8e717377e9f55e9 -->
<!-- <div class="order-form-success-wrap">
    
    <div class="order-form-success-container">
        <button id="close-btn">X</button>

        <h1 class="h4">Sucess Order</h1>

        <div class="success-body">
            <h2>Your Traking Code:</h2>
            <p>6caa320f968856f8f8e717377e9f55e9</p>
            <p>Please save this tracking code. You can track your order later with this code in the following link.<a href="orders/track">Track Order</a></p>
        </div>

    </div>

</div> -->

<!-- <div class="order-form-wrap">
    <div class="order-form-container">
        <button id="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </button>

        <h1 class="h4">Order</h1>
        
        <div class="buy-product">
            <img src="<?php echo APP_URL . $data['product']->getValue('photo_name') . '0.jpg' ?>" alt="">
            <h2><span><?php echo $data['category']->getValue('name') ?></span><br><span><?php echo $data['product']->getValue('name') ?></span></h2>

            <?php if($data['product']->getValue('discount_percentage')) : ?>
                <p class="price">
                    Price: 
                    <span><?php echo number_format($data['product']->getValueEncoded('price')) ?></span>
                    <span><?php echo $data['product']->getFinalPrice() ?> MMK</span>
                </p>
                <div class="discount">-<?php echo $data['product']->getValueEncoded('discount_percentage') ?>%</div>
            <?php else : ?>
                <p class="price">
                    Price: 
                    <span></span>
                    <span><?php echo $data['product']->getFinalPrice() ?> MMK</span>
                </p>
            <?php endif; ?>
        </div>

        <form action="<?php echo APP_URL ?>orders/add" method="post">
            <input type="hidden" name="product_id" value="<?php echo $data['product']->getValue('id') ?>">

            <label for="customer-name">Name</label>
            <input type="text" name="customer_name" id="customer-name" required>
            <div class="highlighted-bar"></div>

            <label for="customer-phone">Phone</label>
            <input type="text" name="customer_phone" id="customer-phone" requried>
            <div class="highlighted-bar"></div>

            <label for="customer-address">Address</label>
            <textarea name="customer_address" id="customer-address" cols="30" rows="5"></textarea>

            <input type="submit">
        </form>
    </div>
</div> -->

<script src="<?php echo APP_URL ?>resources/js/product-detail.js"></script>

<?php displayPageFooter() ?>