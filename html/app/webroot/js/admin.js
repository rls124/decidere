//valid special characters
function validSpecialCharacters(event) {
    
    //console.log(event.keyCode )

    var availableKeys = [95, 209, 241, 180, 36, 64, 39, 32, 35, 33, 43, 38, 37];

    if (availableKeys.indexOf(event.keyCode) != -1) {

        event.preventDefault();

    }
}

//functions simple after document ready
$(document).ready(function() {
    $('#table-users').DataTable();
    $('.mask-price').priceFormat({
        centsLimit: 2,
        prefix: '',
        centsSeparator: '.'
    })

});

//form submit for User Plan
function sendFormUserPlan(form) {
	//form.submit()
	$.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.response.response.status  == 'success insert') {
                Lobibox.notify('success', {
	                msg: 'Access to plan correct.'
	            });
            } else if (data.response.response.status == 'success delete') {
                Lobibox.notify('info', {
	                msg: 'Access to plan remove.',
	            });
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
}


//reset password user
function adminResetPassword(id) {
    $.ajax({
        type: "POST",
        url: urlResetPassword,
        data: {id : id},
        success: function (data) {
            if(data.status  == 'The password was changed and was sent to user') {
                Lobibox.notify('success', {
                    msg: data.status
                });
            } else {
                Lobibox.notify('warning', {
                    msg: data.status
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $('.btn-admin-user').attr('disabled', true);
            $('.btn-xs').attr('disabled', true);
        },
        complete: function () {
            $('.btn-admin-user').attr('disabled', false);
            $('.btn-xs').attr('disabled', false);
        }
    });
}

//generate cupon 
function generateCupon(input) {
    
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 20; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    $('#code-' +input ).val(text);
}


//create stripe plans
$('#form-stripe-plan').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: '../createStripePlan.json',
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data)
        }, 
        error: function (err){
            console.log(err)
        },

         beforeSend: function () {
            
        },
        complete: function () {
            
        }
    });
});

//submit form edit category
$('.form-category-edit').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success edit') {
                Lobibox.notify('success', {
                    msg: 'Category saved correct.',
                });
            } else if (data.response.response.status == 'error edit') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Category.',
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

         beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});

//submit form edit provider
$('.form-provider-edit').submit(function (event) {
    
    event.preventDefault();

    var form = this;

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
                    msg: 'Provider saved correct.', 
                });
            } else if (data.response.response.status == 'error') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Provider.', 
                });
            } else if (data.response.response.status == 'provider exists') {
                Lobibox.notify('warning', {
                    msg: 'The provider already exists.', 
                });
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

//submit form edit plan
$('.form-plan-edit').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success edit') {
                Lobibox.notify('success', {
                    msg: 'Plan saved correct.', 
                });
            } else if (data.response.response.status == 'success edit') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Plan.', 
                });
            } else if (data.response.response.status == 'plan exists') {
                Lobibox.notify('warning', {
                    msg: 'The plan already exists.', 
                });
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

//submit form edit coupon
$('.form-coupon-edit').submit(function (event) {
    
    event.preventDefault();

    form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success edit') {
                Lobibox.notify('success', {
                    msg: 'Coupon saved correct.', 
                });
            } else if (data.response.response.status == 'error edit') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Coupon.', 
                });
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


//submit form edit user
$('#form-edit-user').submit(function (event) {
    
    event.preventDefault();

    form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success edit') {
                Lobibox.notify('success', {
                    msg: 'User saved correct.', 
                });
            } else if (data.response.response.status == 'error edit') {
                Lobibox.notify('danger', {
                    msg: 'Error to save User.', 
                });
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


//submit form add dataset ctaegory
$('#form-add-dataset-category').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success add') {
                Lobibox.notify('success', {
                    msg: 'Category saved correct.', 
                });
                location.reload();
            } else if (data.response.response.status == 'success add') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Category.', 
                });
            } else if (data.response.response.status == 'category exists') {
                Lobibox.notify('warning', {
                    msg: 'The category already exists.', 
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});


//submit form add dataset provider
$('#form-add-dataset-provider').submit(function (event) {
    
    event.preventDefault();

    var form = this;

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
                    msg: 'Provider saved correct.', 
                });
                location.reload();
            } else if (data.response.response.status == 'error') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Provider.', 
                });
            } else if (data.response.response.status == 'provider exists') {
                Lobibox.notify('warning', {
                    msg: 'The provider already exists.', 
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});

//submit form add dataset plan
$('#form-add-dataset-plan').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status  == 'success add') {
                Lobibox.notify('success', {
                    msg: 'Plan saved correct.', 
                });
                location.reload();
            } else if (data.response.response.status == 'success add') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Plan.', 
                });
            } else if (data.response.response.status == 'plan exists') {
                Lobibox.notify('warning', {
                    msg: 'The plan already exists.', 
                });
            }
        }, 
        error: function (){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});


//create new user
$("#adminRegisterUser").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#adminRegisterUser .admin-user-register").attr("disabled", true);
    $('.error-input-register-admin').hide();
    $('.input-register').removeClass('has-error');

    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.status_register == 'Error register') {
                
                //check if was email error
                if (data.email == 'unavailable') {
                    /*$('#form-register-email').addClass('has-error');
                    $('#form-register-email .error-input-register-admin').text('This email has already been registered').show();*/
                } 

                //check if was username error
                if (data.username == 'unavailable') {
                    $('#form-register-username').addClass('has-error');
                    $('#form-register-username .error-input-register-admin').text('Username unavailable').show();
                } 

            } else if (data.status_register == 'Register Correct') {
                Lobibox.notify('success', {
                    msg: 'User created successfully.'
                });
                window.location = data.url;
            }
        }, 
        error: function (){
            console.log("error");
        },

        beforeSend: function () {
            $("#adminRegisterUser input").attr("disabled", true);
        },
        complete: function () {
            $("#adminRegisterUser .admin-user-register").attr("disabled", false);
            $("#adminRegisterUser input").attr("disabled", false);
        }
    });
});


//submit form add dataset plan with stripe
$('#form-add-dataset-plan-stripe').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            console.log(data)

            if(data.response  == 'success stripe add') {
                Lobibox.notify('success', {
                    msg: 'Plan saved correct. ', 
                });
                location.reload();
            } else if (data.response == 'error') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Plan.', 
                });
            } else if (data.response == 'plan exists') {
                Lobibox.notify('warning', {
                    msg: 'The plan already exists.', 
                });
            }
        }, 
        error: function (e){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});


//submit form add dataset plan with stripe
$('.form-plan-edit-stripe').submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            console.log(data)

            if(data.response  == 'success stripe edit') {
                Lobibox.notify('success', {
                    msg: 'Plan saved correct.', 
                });
            } else if (data.response == 'error') {
                Lobibox.notify('danger', {
                    msg: 'Error to save Plan.', 
                });
            } else if (data.response == 'plan exists') {
                Lobibox.notify('warning', {
                    msg: 'The plan already exists.', 
                });
            } else if (data.response == 'success stripe add') {
                Lobibox.notify('success', {
                    msg: 'Plan saved correct.', 
                });
                Lobibox.notify('info', {
                    msg: 'The plan did not exist on stripe and was created successfully.', 
                });
            }
        }, 
        error: function (e){
            Lobibox.notify('danger', {
                msg: 'Something went wrong.'
            });
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });

});