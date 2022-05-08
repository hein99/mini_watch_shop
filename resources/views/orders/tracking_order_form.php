<?php displayPageHeader('Track Order', 'orders') ?>
<div class="order-track-form-wrap">
    <div class="order-track-form-container">
        <h1 class="h4">Track your order</h1>
        <p>Please enter tracking code that you got from product order</p>

        <?php if($data['error_messages']) : ?>
            <ul class="error-container">
                <?php foreach($data['error_messages'] as $error_message) : ?>
                    <li><?php echo $error_message ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="<?php echo APP_URL ?>orders/track" method="get">
            <label for="tracking-code">Tracking Code: </label>
            <input type="text" name="tracking_code" id="tracking-code" required>
            <div class="highlighted-bar"></div>
            <input type="submit" name="action" value="Track">
        </form>
        
        <div class="foget-track-code-field">
            <button>
                Forget Tracking Code
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </button>

            <div>
                <p>
                    If you have forgetten your order's tracking code.<br> 
                    Please contact the following phone numeber to get code.
                </p>
                <p>
                    <a href="tel:+959710000000">+95 9710000000</a> | 
                    <a href="tel:+959720000000">+95 9720000000</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.foget-track-code-field>button').addEventListener('click', _ => {
        let div_element = document.querySelector('.foget-track-code-field>div');
        if(window.getComputedStyle(div_element).display == 'none')
            div_element.style.display = 'block';
        else 
            div_element.style.display = 'none';
    });
</script>
    
<?php displayPageFooter() ?>