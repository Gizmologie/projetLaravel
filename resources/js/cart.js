const loadCart = new Event('loadCart')

document.addEventListener('loadCart', () => {
    $.get('/cart/loadCart').done((response) => {
        const total = response.total;
        if (total > 0){
            $('.js-cart-total').html(total).removeClass('d-none')
        }else{
            $('.js-cart-total').addClass('d-none')
        }
    }).fail((response) => {
        console.log(response);
    })
})
