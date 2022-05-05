<?php displayPageHeader('Home', '') ?>

<div class="container-fluid">
    <ul class="carousel">
        <?php foreach($data['banners'] as $banners) : ?>
            <li class="carousel-item">
                <img src="<?php echo APP_URL . $banners->getValue('photo_name') ?>" alt="Banner">
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="brands-wrap">
    <div class="container">
        <h1 class="h3">Brands</h1>
        <ul class="row brands-container">
            <?php foreach($data['categories'] as $category) : ?>
                <li class="col-4 col-lg-3 col-xxl-2">
                    <img src="<?php echo APP_URL . $category->getValue('photo_name') ?>" alt="<?php echo $category->getValueEncoded('name') ?>" width="200">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="container-fluid quote-wrap">
    <div class="quote-container">
        <div class="quote-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-quote-fill" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm7.194 2.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 4C4.776 4 4 4.746 4 5.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 7.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 4c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z"/>
            </svg>
        </div>
        <p class="h4 quote-text">
            Time and tide wait for no man.<br>
            So, don't waste your precious time.
        </p>
    </div>
    <div class="overlay"></div>
</div>

<div class="container services">
    <h1 class="h3">Our confortable services</h1>
    <ul class="row">
        <li class="col-4 col-lg-3 service-card">
            <div>
                <div class="service-icon" style="background: var(--primary)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                    </svg>
                </div>
                <h2 class="service-title">Provide Warranty</h2>
                <div class="service-body">
                    <p>Nam reprehenderit provident error veritatis doloribus?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti nisi unde quam?</p>
                </div>
            </div>
        </li>

        <li class="col-4 col-lg-3 service-card">
            <div>
                <div class="service-icon" style="background: var(--danger)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                        <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
                    </svg>
                </div>
                <h2 class="service-title">Lifetime Free Service</h2>
                <div class="service-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti nisi unde quam?</p>
                    <p>Suscipit praesentium molestiae delectus quaerat nemo, nobis ipsa accusamus doloribus doloremque error.</p>
                    
                </div>
            </div>
        </li>

        <li class="col-4 col-lg-3 service-card">
            <div>
                <div class="service-icon" style="background: var(--success)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                </div>
                <h2 class="service-title">Fast Delivery</h2>
                <div class="service-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti nisi unde quam?</p>
                    <p>Nam reprehenderit provident error veritatis doloribus?</p>
                </div>
            </div>
        </li>

    </ul>
</div>

<div class="faq-wrap">
    <h1 class="h3">Frequenty asked questions</h1>
    <ul class="faq-container col-12 col-sm-9 col-md-7">
        <li>
            <div class="question">
                <h2 class="h6">Question 1</h2>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
            <p class="answer">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. A, distinctio? Dolor similique rem, excepturi at fugit explicabo beatae voluptate unde amet sint laudantium assumenda fuga tenetur repudiandae perferendis corporis laborum!
            </p>
        </li>

        <li>
            <div class="question">
                <h2 class="h6">Question 2</h2>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
            <p class="answer">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. A, distinctio? Dolor similique rem, excepturi at fugit explicabo beatae voluptate unde amet sint laudantium assumenda fuga tenetur repudiandae perferendis corporis laborum!
            </p>
        </li>

        <li>
            <div class="question">
                <h2 class="h6">Question 3</h2>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
            <p class="answer">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. A, distinctio? Dolor similique rem, excepturi at fugit explicabo beatae voluptate unde amet sint laudantium assumenda fuga tenetur repudiandae perferendis corporis laborum!
            </p>
        </li>

        <li>
            <div class="question">
                <h2 class="h6">Question 4</h2>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
            <p class="answer">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. A, distinctio? Dolor similique rem, excepturi at fugit explicabo beatae voluptate unde amet sint laudantium assumenda fuga tenetur repudiandae perferendis corporis laborum!
            </p>
        </li>

        <li>
            <div class="question">
                <h2 class="h6">Question 5</h2>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
            <p class="answer">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. A, distinctio? Dolor similique rem, excepturi at fugit explicabo beatae voluptate unde amet sint laudantium assumenda fuga tenetur repudiandae perferendis corporis laborum!
            </p>
        </li>

        

        
    </ul>
</div>

<script>
    var carousel_imgs = document.querySelectorAll('.carousel-item');
    var displayed_img_index = 0;

    setInterval(() => {
        carousel_imgs[displayed_img_index++].style.display = "none";

        if(displayed_img_index >= carousel_imgs.length)
            displayed_img_index = 0;

        carousel_imgs[displayed_img_index].style.display = "block";
        
    }, 3000);

</script>
<?php displayPageFooter() ?>