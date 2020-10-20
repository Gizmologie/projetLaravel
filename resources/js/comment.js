import $ from 'jquery';
import swal from 'sweetalert';

$('#js-submit-comment-form').on('click', (e) => {
    e.preventDefault()
    const product = $('#comment-add').data('product');


    $.get('/storeComment/' + product, $('#comment-add').serialize()).done((response) => {
        document.dispatchEvent(new Event('loadCart'))
        if (response.success){
            swal('C\'est bon', 'Le commentaire a été ajouté ', "success")
        }else(
        swal('Désolé', 'Vous ne pouvez pas ajouter de commentaire', "error")
        )
    }).fail((response) => {
        swal('Oups désolé', 'Une erreur s\'est produite', "error")
    })
})
