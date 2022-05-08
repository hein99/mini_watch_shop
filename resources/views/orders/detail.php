<?php displayPageHeader('Track Order', 'orders') ?>
<div class="container">
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

    <div class="order-detail-wrap">
        <div class="order-detail-container">
            <div class="header">
                <h1 class="h4">Order</h1>
                <div class="status <?php echo $data['order']->getValueEncoded('status') ?>"><?php echo $data['order']->getStatusString() ?></div>   
            </div>
        
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

            <div class="order-detail">
                <p><b>Name: </b><?php echo $data['order']->getValueEncoded('customer_name') ?></p>
                <p><b>Phone: </b><?php echo $data['order']->getValueEncoded('customer_phone') ?></p>
                <p><b>Address: </b><?php echo $data['order']->getValueEncoded('customer_address') ?></p>
                <p><b>Tracking Code: </b><?php echo $data['order']->getValueEncoded('tracking_code') ?></p>
                <p><b>Ordered at: </b><?php echo $data['order']->getValueEncoded('created_at') ?></p>
            </div>
        </div>
    </div>
</div>
<?php displayPageFooter() ?>