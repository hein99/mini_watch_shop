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
// var form_wrap = document.querySelector('.order-form-wrap');
// var form_close_btn = document.querySelector('#close-btn');


// form_close_btn.addEventListener('click', _ => {
//     form_wrap.style.display = 'none';
// });

buy_now_btn.addEventListener('click', e => {
    // form_wrap.style.display = 'block';
    createOrderFormOverlay(e.currentTarget);
});

function createOrderSuccess(tracking_code) {
    // Create close button 'btn_element'
    let btn_element = document.createElement('button');
    btn_element.setAttribute('id', 'close-btn');
    btn_element.textContent = 'X';
    btn_element.addEventListener('click', _ => {
        document.querySelector('.order-form-success-wrap').remove();
    });

    // Create header 'h1_element'
    let h1_element = document.createElement('h1');
    h1_element.setAttribute('class', 'h4');
    h1_element.textContent = 'Sucess Order';

    // Create success body 'success-body'
    let h2_element = document.createElement('h2');
    h2_element.textContent = 'Your Tracking Code';
    
    let tc_p = document.createElement('p');
    tc_p.textContent = tracking_code;

    
    let link = document.createElement('a');
    link.setAttribute('href', '/mini_watch_shop/orders/track');
    link.textContent = 'Track Order';

    let note = document.createElement('p');
    note.textContent = 'Please save this tracking code. You can track your order later with this code in the following link.';
    note.appendChild(link);

    let success_body = document.createElement('div');
    success_body.setAttribute('class', 'success-body');
    success_body.appendChild(h2_element);
    success_body.appendChild(tc_p);
    success_body.appendChild(note);

    // Create order form success container
    let container = document.createElement('div');
    container.setAttribute('class', 'order-form-success-container');
    container.appendChild(btn_element);
    container.appendChild(h1_element);
    container.appendChild(success_body);

    // Create order form success wrap
    let wrap = document.createElement('div');
    wrap.setAttribute('class', 'order-form-success-wrap');
    wrap.appendChild(container);
    document.querySelector('body').appendChild(wrap);
}

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
    let form = createForm(obj.dataset.form_action, obj.dataset.product);


    // Create form container container
    let container = document.createElement('div');
    container.setAttribute('class', 'order-form-container');
    container.appendChild(btn_element);
    container.appendChild(h1_element);
    container.appendChild(product);
    container.appendChild(form);


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
    let img_element = document.createElement('img');
    img_element.setAttribute('src', p_obj.photo_name);
    img_element.setAttribute('alt', p_obj.name);


    // Create h2 'h2_element'
    let h2_element = document.createElement('h2');
    let first_span = document.createElement('span');
    first_span.textContent = category;

    let second_span = document.createElement('span');
    second_span.textContent = p_obj.name;

    h2_element.appendChild(first_span);
    h2_element.appendChild(document.createElement('br'));
    h2_element.appendChild(second_span);

    // Create price 'price'
    let price = document.createElement('p');
    price.setAttribute('class', 'price');
    price.textContent = 'Price: ';

    if(p_obj.discount_percentage) {
        let first_span = document.createElement('span');
        first_span.textContent = p_obj.price;

        let second_span = document.createElement('span');
        second_span.textContent = p_obj.final_price;

        price.appendChild(first_span);
        price.appendChild(second_span);
    } else {
        let first_span = document.createElement('span');

        let second_span = document.createElement('span');
        second_span.textContent = p_obj.final_price;

        price.appendChild(first_span);
        price.appendChild(second_span);
    }


    // Create product field 'product' 
    let product_field = document.createElement('div');
    product_field.setAttribute('class', 'buy-product');
    product_field.appendChild(img_element);
    product_field.appendChild(h2_element);
    product_field.appendChild(price);

    if(p_obj.discount_percentage) {
        let discout = document.createElement('div');
        discout.textContent = '-' + p_obj.discount_percentage + '%'
        discout.setAttribute('class', 'discount');

        product_field.appendChild(discout);
    }
    
    return product_field;
}

function createForm(form_action, product) {
    let p_json = product.replaceAll('\'', '"');
    let p_obj = JSON.parse(p_json);

    // Create product_id 'product_id'
    let product_id = document.createElement('input');
    product_id.setAttribute('type', 'hidden');
    product_id.setAttribute('name', 'product_id');
    product_id.setAttribute('value', p_obj.id);

    // Create highlighted_bar 'highlighted_bar'
    let highlighted_bar = document.createElement('div');
    highlighted_bar.setAttribute('class', 'highlighted-bar');

    // Create name label 'name_label'
    let name_label = document.createElement('label');
    name_label.setAttribute('for', 'customer-name');
    name_label.textContent = 'Name';

    // Create name input 'name_input'
    let name_input = document.createElement('input');
    name_input.setAttribute('type', 'text');
    name_input.setAttribute('name', 'customer_name');
    name_input.setAttribute('id', 'customer-name');
    name_input.setAttribute('required', 'required');

    // Create phone label 'phone_label'
    let phone_label = document.createElement('label');
    phone_label.setAttribute('for', 'customer-phone');
    phone_label.textContent = 'Phone';

    // Create phone input 'phone_input'
    let phone_input = document.createElement('input');
    phone_input.setAttribute('type', 'text');
    phone_input.setAttribute('name', 'customer_phone');
    phone_input.setAttribute('id', 'customer-phone');
    phone_input.setAttribute('required', 'required');

    // Create address label 'address_label'
    let address_label = document.createElement('label');
    address_label.setAttribute('for', 'customer-address');
    address_label.textContent = 'Address';

    // Create address textarea 'address_textarea'
    let address_textarea = document.createElement('textarea');
    address_textarea.setAttribute('name', 'customer_address');
    address_textarea.setAttribute('id', 'customer-address');
    address_textarea.setAttribute('cols', '30');
    address_textarea.setAttribute('rows', '5');
    address_textarea.setAttribute('required', 'required');


    // Create order button 'order_btn'
    let order_btn = document.createElement('button');
    order_btn.setAttribute('type', 'button');
    order_btn.addEventListener('click', submitOrderForm);
    order_btn.textContent = 'Order';

    let form = document.createElement('form');
    form.setAttribute('action', form_action);
    form.setAttribute('method', 'post');
    form.appendChild(product_id);

    form.appendChild(name_label);
    form.appendChild(name_input);
    form.appendChild(highlighted_bar);

    form.appendChild(phone_label);
    form.appendChild(phone_input);
    form.appendChild(highlighted_bar.cloneNode());

    form.appendChild(address_label);
    form.appendChild(address_textarea);

    form.appendChild(order_btn);

    return form;
}

function submitOrderForm(event) {
    event.currentTarget.disabled = true;
    let form = event.currentTarget.parentNode;

    if(validateFormFields(event)) {
        let action = form.getAttribute('action');
        let customer_name = document.querySelector('.order-form-container #customer-name').value;
        let customer_phone = document.querySelector('.order-form-container #customer-phone').value;
        let customer_address = document.querySelector('.order-form-container #customer-address').value;
        let product_id = document.querySelector('.order-form-container input[type="hidden"]').value;


        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response_json = JSON.parse(this.responseText);

                if(response_json.status == 'success') {
                    document.querySelector('.order-form-wrap').remove();
                    createOrderSuccess( response_json.tracking_code);
                } else {
                    displayMissingField(response_json.missing_fields);
                }
                
            }
        };

        let url_query = 'customer_name=' + customer_name + '&customer_phone=' + customer_phone + '&customer_address=' + customer_address + '&product_id=' + product_id;
        xhttp.open("POST", action, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(url_query);
    }
    event.currentTarget.disabled = false;
}

function validateFormFields(event) {
    let form = event.currentTarget.parentNode;

    let required_fields = ['action', 'customer_name', 'customer_phone', 'customer_address', 'product_id'];
    let missing_fields = [];

    let form_fields = [
        form.getAttribute('action'),
        document.querySelector('.order-form-container #customer-name').value,
        document.querySelector('.order-form-container #customer-phone').value,
        document.querySelector('.order-form-container #customer-address').value,
        document.querySelector('.order-form-container input[type="hidden"]').value
    ];

    for(let i = 0; i < form_fields.length; i++) {
        if(form_fields[i] == '') missing_fields.push(required_fields[i]);
    }

    if(missing_fields.length) {
        displayMissingField(missing_fields);
        return false;
    } else {
        return true;
    }
}

function displayMissingField(missing_fields) {
    // display red highlighted border
    for(let i = 0; i < missing_fields.length; i++) {
        let missing_field = document.querySelector('.order-form-container [name="' + missing_fields[i] + '"]');
        missing_field.style.borderBottom = '1px solid var(--danger)';
        let label = missing_field.previousSibling;
        label.style.color = 'var(--danger)';
    }

    // display noticed text.
    let error = document.createElement('p');
    error.setAttribute('class', 'error');
    error.textContent = 'There were some missing fields. Please make sure your filled data and click order again.';
    document.querySelector('.order-form-container').insertBefore(error, document.querySelector('.order-form-container>form'));
}