/* select image to show on a selected area */
var img_list = document.querySelectorAll('.img-list>img');
var selected_img = document.querySelector('#selected-img');

for(img of img_list) {
    img.addEventListener('click', e => {
        selected_img.src = e.currentTarget.src;
        for(i of img_list) i.style.border = '0';
        e.currentTarget.style.border = '2px solid #024492';
    });
}

var buy_now_btn = document.querySelector('#buy-now');
var form_wrap = document.querySelector('.order-form-wrap');
var form_close_btn = document.querySelector('#close-btn');


form_close_btn.addEventListener('click', _ => {
    form_wrap.style.display = 'none';
});

buy_now_btn.addEventListener('click', e => {
    // form_wrap.style.display = 'block';
    createOrderFormOverlay(e.currentTarget);
});


function createOrderFormOverlay(obj) {
    // Create button 'btn_element'
    let btn_element = document.createElement('button');
    btn_element.setAttribute('id', 'close-btn');
    btn_element.textContent = 'X';
    btn_element.addEventListener('click', _ => {
        document.querySelector('.order-form-wrap').remove();
    });

    // Create h1 'h1_element'
    let h1_element = document.createElement('h1');
    h1_element.setAttribute('class', 'h4');
    h1_element.textContent = 'Order';

    // Create product field 'product'
    let product = createProductfield(obj.dataset.category, obj.dataset.product);

    // Create form 'form'
    let form = createForm(obj.dataset.product);


    // Create form container container
    let container = document.createElement('div');
    container.setAttribute('class', 'order-form-container');
    container.appendChild(btn_element);
    container.appendChild(h1_element);
    container.appendChild(product);
    // container.appendChild(form);


    // Create container wrap wrap and display
    let wrap = document.createElement('div');
    wrap.setAttribute('class', 'order-form-wrap');
    wrap.appendChild(container);
    document.querySelector('body').appendChild(wrap);
}

function createProductfield(category, product) {
    let p_json = product.replaceAll('\'', '"');
    let p_obj = JSON.parse(p_json);
    // Create img 'img_element'
    var img_element = document.createElement('img');
    img_element.setAttribute('src', p_obj.photo_name);
    img_element.setAttribute('alt', p_obj.name);


    // Create h2 'h2_element'
    var h2_element = document.createElement('h2');
    var first_span = document.createElement('span');
    first_span.textContent = category;

    var second_span = document.createElement('span');
    second_span.textContent = p_obj.name;

    h2_element.appendChild(first_span);
    h2_element.appendChild(document.createElement('br'));
    h2_element.appendChild(second_span);

    // Create price 'price'
    var price = document.createElement('p');
    price.setAttribute('class', 'price');
    price.textContent = 'Price: ';

    if(p_obj.discount_percentage) {
        var first_span = document.createElement('span');
        first_span.textContent = p_obj.price;

        var second_span = document.createElement('span');
        second_span.textContent = p_obj.final_price;

        price.appendChild(first_span);
        price.appendChild(second_span);
    } else {
        var first_span = document.createElement('span');

        var second_span = document.createElement('span');
        second_span.textContent = p_obj.final_price;

        price.appendChild(first_span);
        price.appendChild(second_span);
    }


    // Create product field 'product' 
    var product = document.createElement('div');
    product.setAttribute('class', 'buy-product');
    product.appendChild(img_element);
    product.appendChild(h2_element);
    product.appendChild(price);

    if(product.discount_percentage) {
        var discout = document.createElement('div');
        discout.setAttribute('class', 'discount');

        product.appendChild(discout);
    }
    
    return product;
}

function createForm(product) {

}

