$(document).ready(function(e){
    $('.form-initial .stripe-button-el').addClass('animated disabled btn-purchase');
    $(".form-initial .stripe-button-el").attr("disabled", true);
    if(isShoppingPage()){
        initShoppingMessageModal();
    }  

});

//change checkbox terms
function changeAgreeTerms (check) {
	
    if($(check).is(':checked')){
	   	
		/* CORE10-SW-DEC-21 */
	   	$('#purchaseModal').modal('show');	
	   	
        $('.btn-purchase').removeClass('disabled');
        $('.btn-purchase').addClass('tada');
        $(".form-initial .stripe-button-el").attr("disabled", false);
    } else {
        $('.btn-purchase').addClass('disabled');
        $('.btn-purchase').removeClass('tada');
        $(".form-initial .stripe-button-el").attr("disabled", true);
    }
}

function initShoppingMessageModal(){
    var cookieValue = $.cookie("notShowShoppingMessageAgain");
    if(cookieValue == undefined){
        $('#shoppingMessageModal').modal('show');
    }
}

function isShoppingPage(){
    var pathname = window.location.pathname;
    if (pathname.match("/Register/selectDataset")) {
        return true; 
    }
    return false;
}


//function send cart
function sendCart() {
    if($('#checkbox-terms').is(':checked')){
        $('#formShopping').submit();
    } else {
        Lobibox.alert('warning', {
            msg: "Please accept the Terms and Conditions of Use"
        });
    }
}

$('#btnconfirmShoppingMessage').click(function(event){
    var checked = $('#confirmShoppingMessageCheckbox').is(":checked");
    if(checked){
        $.cookie('notShowShoppingMessageAgain', 'true', { path:'/',expires: 20 * 365 });  //This cookie will expire in 20 years.
    }
});





//submit form check coupon
$('#form-check-coupon').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $('#coupon-not-found').hide();

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'found') {

                //recorre shopping cart get price from items, apply discount and modified input
                $.each(shopping_cart, function (index, item) {
                    var price = ( item.Plan.price - ( item.Plan.price * ( data.response.response.coupon.Coupon.percentage /100 ) ) ).toFixed(2);
                    $('.a3'+index).val( price );
                } )

                var newTotal = ( subtotal_shop - ( subtotal_shop * ( data.response.response.coupon.Coupon.percentage /100 ) ) ).toFixed(2) ;
                $('#shop-discount').text( data.response.response.coupon.Coupon.percentage + "%" );
                $('#shop-total').text( "$"+newTotal );

                if (newTotal == 0) {
                    $('#btnShopCoupon').show();
                }

                $('#modalCoupon').modal('hide');
                Lobibox.notify('success', {
                    msg: 'Coupon code correct.'
                });
            } else if (data.response.response.status == 'not_found') {

                //recorre shopping cart get price from items, apply discount and modified input
                $.each(shopping_cart, function (index, item) {
                    var price = ( item.Plan.price );
                    $('a3'+index).val( price );
                } )

                var newTotal = subtotal_shop ;
                $('#shop-discount').text( '0%' );
                $('#shop-total').text( "$"+newTotal );

                if (newTotal > 0) {
                    $('#btnShopCoupon').hide();
                }

                $('#coupon-not-found').text('Coupon not found').show();
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            
        },
        complete: function () {
            
        }
    });

});