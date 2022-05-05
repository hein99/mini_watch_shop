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

buy_now_btn.addEventListener('click', _ => {
    form_wrap.style.display = 'flex';
})

form_close_btn.addEventListener('click', _ => {
    form_wrap.style.display = 'none';
})