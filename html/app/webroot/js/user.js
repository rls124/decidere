//valid repeat pass
var new_password = document.getElementById("new_password")
  , confirm_password = document.getElementById("confirm_password");

//function for validate password
function validatePassword(){
  if(new_password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

function loadTab(){
    var tab = window.location.hash;
    if(tab){
        $('a[href="' + tab + '"]').trigger('click');
        $("html, body").animate({ scrollTop: 0 }, "slow");
    }
}

$(document).ready(function() {
    loadTab();
});

if ( $("#new_password").length > 0 && $("#confirm_password").length > 0) {
    new_password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}

//hide and show user provider
$('.form-switchShow-userprovider').submit(function (event) {
	event.preventDefault();
    form = this;
    
    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.response.response.status == 'success') {
                Lobibox.notify('success', {
	                msg: 'Save Dataset Provider.',
	            });	            
            } else if (data.response.response.status == 'user_provider not found') {
                Lobibox.notify('error', {
	                msg: 'Dataset Provider not found.',
	            });
            } else if (data.response.response.status == 'unautorized') {
                Lobibox.notify('error', {
	                msg: 'You have not access.',
	            });
            }
        }, 
        error: function (){
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });
});


//change default source user
$('.form-setDefaultSource').submit(function (event) {
    event.preventDefault();
    form = this;
    
    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.response == 'success') {
                Lobibox.notify('success', {
                    msg: 'Save Default Credit Card successfully.',
                });             

                location.reload();

            } else if (data.response == 'error') {
                Lobibox.notify('error', {
                    msg: 'Error during set default credit card.',
                });
            } else if (data.response == 'unautorized') {
                Lobibox.notify('error', {
                    msg: 'You have not access.',
                });
            }
        }, 
        error: function (){
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
            $(form).find("button").attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
            $(form).find("button").attr("disabled", false);
        }
    });
});


//delete customer card
$('.form-deleteCustomerCard').submit(function (event) {
    event.preventDefault();
    form = this;
    
    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.response == 'success') {
                Lobibox.notify('success', {
                    msg: 'Credit Card deleted successfully.',
                });             

                location.reload();

            } else if (data.response == 'error') {
                Lobibox.notify('error', {
                    msg: 'Error during deleting credit card.',
                });
            } else if (data.response == 'unautorized') {
                Lobibox.notify('error', {
                    msg: 'You have not access.',
                });
            }
        }, 
        error: function (){
            console.log("error");
        },

        beforeSend: function () {
            $(form).find('input').attr("disabled", true);
            $(form).find("button").attr("disabled", true);
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
            $(form).find("button").attr("disabled", false);
        }
    });
});

//delete user provider
$('.form-delete-userprovider').submit(function (event) {
    event.preventDefault();
    form = this;
    
    Lobibox.confirm({
        title : 'Please confirm',
        msg: "Are you sure you want to delete this Dataset? Note: If you have a paid subscription to this dataset, the subscription payment will be cancelled.",
        callback: function ($this, type, ev) {
            
            if (type == 'yes') {
                $.ajax({
                    type: "POST",
                    url: form.action,
                    data: new FormData( form ),
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {

						console.log(data);	

                        if(data.response.response.status == 'success') {
                            Lobibox.notify('success', {
                                msg: 'Dataset Provider successfully removed.',
                            });
                            deleteDatasetProvider (data.response.response.id);
                        } else if (data.response.response.status == 'favorite not found') {
                            Lobibox.notify('error', {
                                msg: 'Dataset Provider not found.',
                            });
                        } else if (data.response.response.status == 'unautorized') {
                            Lobibox.notify('error', {
                                msg: 'You have not access.',
                            });
                        }
                    }, 
                    error: function (e){
                        console.log("error",e);
                    },

                    beforeSend: function () {
                        $(form).find('input').attr("disabled", true);
                    },
                    complete: function () {
                        $(form).find('input').attr("disabled", false);
                    }
                });
                
            }
        }
    });


});


//check available username and email
$("#form-update-info").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#form-update-info .submit-edit-info").attr("disabled", true);
    $('.error-input-edit-info-contact').hide();
    $('.form-group').removeClass('has-error');

    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status == 'error edit') {

                Lobibox.notify('error', {
                    msg: 'An error occurred while trying to update your contact information.',
                });
                
                //check if was email error
                if (data.email == 'unavailable') {
                    /*$('#form-register-email').addClass('has-error');
                    $('#form-register-email .error-input-register').text('This email has already been registered').show();*/
                } 

                //check if was username error
                if (data.username == 'unavailable') {
                    $('#form-edit-username').addClass('has-error');
                    $('#form-edit-username .error-input-edit-info-contact').text('Username unavailable').show();
                } 

            } else if (data.response.response.status == 'success edit') {
                Lobibox.notify('success', {
                    msg: 'Your contact info was updated successfully.',
                });
                location.reload();
            }
        }, 
        error: function (){
            Lobibox.notify('error', {
                msg: 'An error occurred while trying to update your contact information.',
            });
        },

        beforeSend: function () {
            $("#form-update-info input").attr("disabled", true);
        },
        complete: function () {
            $("#form-update-info .submit-edit-info").attr("disabled", false);
            $("#form-update-info input").attr("disabled", false);
        }
    });
});


//form for change password
$("#form-update-password").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#form-update-password .submit-edit-info").attr("disabled", true);
    $('.error-input-edit-password').hide();
    $('.form-group').removeClass('has-error');

    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status == 'password wrong') {

                Lobibox.notify('error', {
                    msg: 'An error occurred while trying to update your password.',
                });
                
                $('#input-password-update').addClass('has-error');
                $('#input-password-update .error-input-edit-password').text('Password wrong!').show();

            } else if (data.response.response.status == 'success') {
                Lobibox.notify('success', {
                    msg: 'Your password was updated successfully.',
                });

                $('#form-update-password').trigger('reset');
            }
        }, 
        error: function (){
            Lobibox.notify('error', {
                msg: 'An error occurred while trying to update your password.',
            });
        },

        beforeSend: function () {
            $("#form-update-password input").attr("disabled", true);
        },
        complete: function () {
            $("#form-update-password .submit-edit-info").attr("disabled", false);
            $("#form-update-password input").attr("disabled", false);
        }
    });
});


//deactivate account
$("#form-deactivate-account").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#form-deactivate-account .submit-edit-info").attr("disabled", true);

    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            if(data.response.response.status == 'user not found') {

                Lobibox.notify('error', {
                    msg: 'An error occurred while trying to deactivate your account.',
                });

            } else if (data.response.response.status == 'success') {
                Lobibox.notify('success', {
                    msg: 'Your account was deactivate successfully.',
                });
                window.location = data.url;
            }
        }, 
        error: function (){
            Lobibox.notify('error', {
                msg: 'An error occurred while trying to deactivate your account.',
            });
        },

        beforeSend: function () {
            $("#form-deactivate-account input").attr("disabled", true);
        },
        complete: function () {
            $("#form-deactivate-account .submit-edit-info").attr("disabled", false);
        }
    });
});

//function for delete tr from dataset/providers table
function deleteDatasetProvider (providerId) {
    console.log(providerId)
    $('.tr-datasetProvider#'+providerId).hide('slow');
}

