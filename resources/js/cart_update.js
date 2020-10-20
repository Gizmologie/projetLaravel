import swal from 'sweetalert';
import $ from 'jquery'

$.noConflict()

$('.js-add-to-cart').on('click', (e) => {
    const { target } = e;
    const { product } = target.dataset;


    $.get('/cart/updateLine', {'product_id' : product}).done((response) => {
        document.dispatchEvent(new Event('loadCart'))
        if (response.quantity){
            $(target).html('Ajouter au panier (' + response.quantity + ' actuellement)')
            swal('C\'est bon', 'Le produit a été ajouté à votre panier', "success")

        }
    }).fail((response) => {
        swal('Oups désolé', 'Une erreur s\'est produite', "error")
    })
})


$('.js-delete-product-line').on('click', (e) => {
    const { target } = e;
    let { product } = target.dataset;
    if (!product){
        product = $(target).parent().get(0).dataset.product;
    }

    $.get('/cart/deleteLine', {'product_id' : product}).done((response) => {
        document.dispatchEvent(new Event('loadCart'))
        refreshTotalPrice(response)
        $('#product-line-' + product).remove()
        swal(response.success ? 'Panier modifié' : 'Oups désolé', response.message, response.success ? "success" : "warning")
    }).fail((response) => {
        swal('Oups désolé', 'Une erreur s\'est produite', "error")
    })
})


$('.js-update-product-line').on('change', (e) => {
    const { target } = e;
    const { product } = target.dataset;
    const quantity = $(target).val();

    $.get('/cart/updateLine', {'product_id' : product, 'quantity': quantity}).done((response) => {
        document.dispatchEvent(new Event('loadCart'))
        $(target).val(response.quantity)
        swal(response.success ? 'Panier modifié' : 'Oups désolé', response.message, response.success ? "success" : "warning")
        refreshTotalPrice(response)
    }).fail((response) => {
        swal('Oups désolé', 'Une erreur s\'est produite', "error")
    })
})


function refreshTotalPrice(response){
    if (response.nbObjects !== 'undefined'){
        $('#cart-total-objects').html(response.nbObjects);
    }
    if (response.totalPrice !== 'undefined'){
        $('#cart-total-price').html(response.totalPrice);
    }
}
