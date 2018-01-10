/*
 Created on : 20.04.2015
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */


/**
 * Initializes the validation UI.
 */
$('.lnk-remove-from-cart').click(function (evt) {
    var id = $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: './ajax/RemoveProductFromCart.php',
        data: 'id=' + id,
        success: function (data) {
            var result = data.split(':');
            $('#cart-item-count').html(result[0]);
            $('#count-' + id).html(result[1]);
            if (!result[2]) {
                $('#prod-' + id).remove();
            }
            $('#total-price').html(result[3]);

            if (result[0] <= 0) {
                $('#go-shopping-dialog').removeClass('hidden');
                $('#shopping-cart-table').hide();
            }
        }
    });
});