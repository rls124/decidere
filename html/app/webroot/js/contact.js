//submit form check coupon
$('#form-contact').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $("#form-contact .submit-contact").attr("disabled", true);

    $('#modal-contact').modal('hide');

    $('.content-spinner').show();



    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success') {
                Lobibox.notify('success', {
                    msg: 'Message sent correctly.'
                });
            } else if (data.response.response.status == 'error') {

                Lobibox.notify('danger', {
                    msg: 'Message does not sent.'
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Message does not sent.'
            });
        },
        beforeSend: function () {

            $("#form-contact input").attr("disabled", true);
            
        },
        complete: function () {
            $('.content-spinner').hide();
            $("#form-contact input").attr("disabled", false);
            $("#form-contact .submit-contact").attr("disabled", false);
        }
    });

});