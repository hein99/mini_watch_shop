<?php displayAdminPageHeader('Edit Order', 'orders') ?>
<main class="w-80">
    <ul class="products-breadcrumb">
        <li><a href="<?php echo APP_URL ?>admin/orders">Orders Home</a></li>
        <li>Edit Order</li>
    </ul>

    <?php if(isset($_GET['info']) and $_GET['info']) : ?>
        <div class="info">
            Success Edit
            <button>X</button>
        </div>
    <?php endif; ?>

    <div class="order-status-wrap">
        <div class="order-status-container <?php echo $data['order']->getValue('status') ?>">
            <?php if($data['order']->getValue('status') == 'cancelled') : ?>
                <div>Cancelled Order</div>
            <?php else : ?>
                <div class="status-1" title="ordered">1</div>
                <div class="status-2" title="processing">2</div>
                <div class="status-3" title="shipped">3</div>
                <div class="status-4" title="completed">4</div>
                <div class="line"></div>
                <div class="line completed"></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="order-form-wrap">
        <div class="order-form-container">
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

            <div class="order-info">
                <p><b>Tracking Code: </b><?php echo $data['order']->getValue('tracking_code') ?></p>
                <p><b>Ordered at: </b><?php echo $data['order']->getValue('created_at') ?></p>
            </div>

            <?php if($data['error_messages']) : ?>
                <ul class="error-container">
                    <?php foreach($data['error_messages'] as $error_message) : ?>
                        <li><?php echo $error_message ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="<?php echo APP_URL ?>admin/orders/edit/<?php echo $data['order']->getValue('id') ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $data['order']->getValue('id') ?>">
                <input type="hidden" name="product_id" value="<?php echo $data['product']->getValue('id') ?>">

                <label for="customer-name">Customer Name</label>
                <input type="text" name="customer_name" id="customer-name" value="<?php echo $data['order']->getValue('customer_name') ?>" required>
                <div class="highlighted-bar"></div>

                <label for="customer-phone">Customer Phone</label>
                <input type="text" name="customer_phone" id="customer-phone" value="<?php echo $data['order']->getValue('customer_phone') ?>" requried>
                <div class="highlighted-bar"></div>

                <label for="customer-address">Customer Address</label>
                <textarea name="customer_address" id="customer-address" cols="30" rows="5"><?php echo $data['order']->getValue('customer_address') ?></textarea>

                <label for="status">Order Status</label>
                <select name="status" id="status">
                    <option value="ordered" <?php setSelected($data['order'], 'status', 'ordered') ?>>Ordered</option>
                    <option value="processing" <?php setSelected($data['order'], 'status', 'processing') ?>>Processing</option>
                    <option value="shipped" <?php setSelected($data['order'], 'status', 'shipped') ?>>Shipped</option>
                    <option value="completed" <?php setSelected($data['order'], 'status', 'completed') ?>>Completed</option>
                    <option value="cancelled" <?php setSelected($data['order'], 'status', 'cancelled') ?>>Cancelled</option>
                </select>

                <input type="submit" name="action" value="Edit">
            </form>
        </div>
    </div>
</main>
<script>
    document.querySelector('.info>button').addEventListener('click', e => {
        e.currentTarget.parentNode.remove();
    });
</script>
<?php displayAdminPageFooter() ?>