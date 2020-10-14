$('.js-add-to-cart').on('click', (e) => {
    const { target } = e;
    const { product } = target.dataset;


    $.get('/cart/addLine', {'product_id' : product}).done((response) => {
        document.dispatchEvent(new Event('loadCart'))
    }).fail((response) => {
        console.log(response);
    })
})
