var standalone = window.navigator.standalone,
    userAgent = window.navigator.userAgent.toLowerCase(),
    safari = /safari/.test( userAgent ),
    ios = /iphone|ipod|ipad/.test( userAgent );

Lobibox.progress.DEFAULTS = $.extend({}, Lobibox.progress.DEFAULTS, {
    closeButton : false,  // Show close button or not
});

Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
    soundPath: web_root,
    delayIndicator: false
});


//link for R process 2
var urlRProcess2 = 'https://r.decidere.com/cgi-bin/R/process2';

//link for R process
var urlRProcess = 'https://r.decidere.com/cgi-bin/R/process';

//prototype for str replace all
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

//valid repeat pass
var password = document.getElementById("password_register")
  , confirm_password = document.getElementById("confirm_password");

//var for lobibox progress
var request_progress;

//results for scenario from server R
var resultsForScenario;

//saved scenario for execute
var scenarioSavedId;

//saved scenario for map and execute
var run_scenario;

//flag for notify user when exeed 100
var user_notified_exceed_weight = false;

//array var for subgroup active
var subgroupActives = [];

//function for validate password
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

if ( $("#password_register").length > 0 && $("#confirm_password").length > 0) {
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
}

//for auto height iframe
function resizeIframe(obj) {
    obj.style.height = 0;
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    setTimeout(function(){
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }, 3000);
}

var hiddenFavorites = [];

function toggleFavorites(id, event){
    event.preventDefault();
    var favorites = "#scenario-"+id+"-favorites";
    var favorite_id = "scenario-"+id+"-favorites";
    
    $(favorites).toggle("fast", function(){
        if($(favorites).is(":visible")){
            $("#scenario-name-link-" + id).attr('src', '../img/collapse.png');
            var removedItem = hiddenFavorites.indexOf(favorite_id);
            if(removedItem > -1){
                hiddenFavorites.splice(hiddenFavorites.indexOf(favorite_id), 1);
            }
        }else{
            $("#scenario-name-link-" + id).attr('src', '../img/expand.png');
            hiddenFavorites.push(favorite_id);
        }
    });
    return false;
}

$('.btn-expand-all').click(function(event){
    event.preventDefault();
    $(".scenario-favorites").show();
    $(".scenario-name-link").attr('src', '../img/collapse.png');
});

 $('.btn-collapse-all').click(function(event){
    event.preventDefault();
    $(".scenario-favorites").hide();
    $(".scenario-name-link").attr('src', '../img/expand.png');
});

//functions simple after document ready
$(document).ready(function() {

    $('.main-sidebar').show();

    

    //side nav
    $('.main-sidebar').simpleSidebar({
        opener: '.toggle-sidebar',
        wrapper: '#wrapper',
        animation: {
            easing: "easeOutQuint"
        },
        sidebar: {
            align: 'left',
            closingLinks: '.close-sb',
        },
        sbWrapper: {
            display: true
        }
    });

    //remove value for choose select in new scenario form
    $.each( $('select.chosen-select option' ), function (index) {
        if( $( this ).text() != '' ) {
            $(this).val( $( this ).text() );
        } else {
            $(this).remove();
        }
    } );
  
    // variable is undefined
    if (typeof scenario_saved === 'undefined' && typeof run_scenario === 'undefined' ) {
        
        //$(".chosen-select").chosen();
        $(".chosen-select").select2();

        //input range for new scenario form
        $(".input-range").ionRangeSlider({
          type : 'double'
        });
    }


    //disable groups for new scenario form
    $('.content-input-weight-group input').prop('disabled', true);

    //select to last mosth combobox
    $(".combo-dataset").last().addClass('selected'); 

    //run tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
      $('.tooltip-class').tooltip();
    })

    //only numbers in amount item shopping cart
    $(".input-text-shopping").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    //textarea autosize
    $('textarea.auto-size').textareaAutoSize();

    //checkbox toggle
    $('.checkbox-toggle').bootstrapToggle({
      on: 'Yes',
      off: 'No',
      offstyle: 'danger',
      onstyle: 'success',
      size: 'small' 
    });

    //datetime picker
    jQuery('.datetime-picker').datetimepicker();

});


//show alert for flash message
if ( $("#flashMessage").length > 0 ) {
    //alert($("#flashMessage").text());
    $("#flashMessage").remove();
}


//weight indicator desktop version
if ( $("#chart-pie-weight-new-scenario").length > 0 ) {
    
    //hide  indicators
    $('#chart-pie-weight-new-scenario-more-less').hide();
    $('#chart-pie-weight-new-scenario-success').hide();

    $('#chart-pie-weight-new-scenario').easyPieChart({
        barColor : '#FF781F',
        trackColor : '#D4D4D4',
        lineWidth : 20
    });

    $('#chart-pie-weight-new-scenario-more-less').easyPieChart({
        barColor : '#F00000',
        trackColor : '#D4D4D4',
        lineWidth : 20
    });

    $('#chart-pie-weight-new-scenario-success').easyPieChart({
        barColor : '#00BD04',
        trackColor : '#D4D4D4',
        lineWidth : 20
    });
}


// show and hide sidenav
function showNav () {
	$('.collapsed-nav a').toggle();
}

//scroll to section pages
function scrollTo (element) {
  $('html, body').animate({
    scrollTop: $(element).offset().top
  }, 1000);
  
}


//login ajax
$("#formLoginModal").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#formLoginModal .submit-login").attr("disabled", true);
    $('.status-login').hide();
    
    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
	        
            if(data.status_login == 'Login Correct') {
                window.location = data.url;
            } else {
                $('.status-login').text(data.status_login).show();
            }

            /*if(data.status_login == 'Username or password incorrect') {
                $('.status-login').text(data.status_login).show();
            } else if (data.status_login == 'Login Correct') {
                window.location = data.url;
            }*/
        }, 
        error: function (){
            console.log("error");
        },

        beforeSend: function () {
            $("#formLoginModal input").attr("disabled", true);
        },
        complete: function () {
            $("#formLoginModal .submit-login").attr("disabled", false);
            $("#formLoginModal input").attr("disabled", false);
        }
    });
});


//check available username and email
$("#RegisterUser").submit(function (event) {
    event.preventDefault();
    form = this;
    $("#RegisterUser .submit-register").attr("disabled", true);
    $('.error-input-register').hide();
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
                    $('#form-register-email .error-input-register').text('This email has already been registered').show();*/
                } 

                //check if was username error
                if (data.username == 'unavailable') {
                    $('#form-register-username').addClass('has-error');
                    $('#form-register-username .error-input-register').text('Username unavailable').show();
                } 

            } else if (data.status_register == 'Register Correct') {
                window.location = data.url;
            }
        }, 
        error: function (){
            console.log("error");
        },

        beforeSend: function () {
            $("#RegisterUser input").attr("disabled", true);
        },
        complete: function () {
            $("#RegisterUser .submit-register").attr("disabled", false);
            $("#RegisterUser input").attr("disabled", false);
        }
    });
});


//weight general new scenario change indicator
$('.new-scenario-weight').change(function () {
    updateIndicatorWeight();
});

//fnction updated general indicator
function updateIndicatorWeight () {
    var sum = 0;


    $('.new-scenario-weight').each(function() {
        sum += Number($(this).val());
    });

    if(sum <= 100 && !$('#chart-pie-weight-new-scenario-sm').hasClass('progress-bar-success') ){

        //change color and class to progress bar for progrees indicator mobile
        $('#chart-pie-weight-new-scenario-sm').removeClass('progress-bar-danger animated flash infinite');
        $('#chart-pie-weight-new-scenario-sm').addClass('progress-bar-success');
      

    } else if( sum > 100 && !$('#chart-pie-weight-new-scenario-sm').hasClass('progress-bar-danger') ) {

        //change color and class to progress bar for progrees indicator mobile
        $('#chart-pie-weight-new-scenario-sm').removeClass('progress-bar-success');
        $('#chart-pie-weight-new-scenario-sm').addClass('progress-bar-danger animated flash infinite');

    }

    if(sum < 100){
        user_notified_exceed_weight = false;
        //change color for weight indicator desktop
        $('#chart-pie-weight-new-scenario').show();
        $('#chart-pie-weight-new-scenario-more-less').hide();
        $('#chart-pie-weight-new-scenario-success').hide();

        $('#btnSubmitScenario, #saveButton, #saveAsButton, .run-button').attr("disabled", true);

    } else if( sum > 100){
        //change color for weight indicator desktop
        $('#chart-pie-weight-new-scenario-more-less').show();
        $('#chart-pie-weight-new-scenario').hide();
        $('#chart-pie-weight-new-scenario-success').hide();

        $('#btnSubmitScenario, #saveButton, #saveAsButton, .run-button').attr("disabled", true);


 		 // CORE10-SW-DEC-49 Removed Alert 
 		 // ===================================================== 
					
/*
	        //check if user has been notified
	        if (!user_notified_exceed_weight) {
            Lobibox.alert('warning', {
                msg: "Please correct your weighting to equal 100"
            });
        };
*/

        user_notified_exceed_weight = true;

    } else if(sum == 100) {
        user_notified_exceed_weight = false;
        $('#chart-pie-weight-new-scenario-success').show();
        $('#chart-pie-weight-new-scenario-more-less').hide();
        $('#chart-pie-weight-new-scenario').hide();

        $('#btnSubmitScenario, #saveButton, #saveAsButton, .run-button').attr("disabled", false);
    }


    //update indicators 
    //indicator less than 100 desktop
    $('#chart-pie-weight-new-scenario .amount-pie-chart').text(sum + "%");
    $('#chart-pie-weight-new-scenario').data('easyPieChart').update(sum);

    //indicator more than 100 desktop
    $('#chart-pie-weight-new-scenario-more-less .amount-pie-chart').text(sum + "%");
    $('#chart-pie-weight-new-scenario-more-less').data('easyPieChart').update(sum);

    //indicator more equal 100 desktop
    $('#chart-pie-weight-new-scenario-success .amount-pie-chart').text(sum + "%");
    $('#chart-pie-weight-new-scenario-success').data('easyPieChart').update(sum);

    //inditactor mobile
    $('#chart-pie-weight-new-scenario-sm').css('width', sum+'%').attr('aria-valuenow', sum); 
    $('#chart-pie-weight-new-scenario-sm span.sr-only').text(sum + "%");
    
  //  console.log("updateIndicatorWeight: ",sum);
    
    return sum;
}


//weight new scenario group change indicator
//weight new scenario group change indicator
function changeBarChartIndicatorGroup (group) {

    var sum = 0;
    
    $('.new-scenario-weight-group-' + group).each(function() {
        sum += Number($(this).val());
    });

    if(sum <= 100 && !$('#bar-chart-weight-new-scenario-' + group).hasClass('progress-bar-info') ){

        $('#bar-chart-weight-new-scenario-' + group).removeClass('progress-bar-danger  animated flash infinite');
        $('#bar-chart-weight-new-scenario-' + group).addClass('progress-bar-info');

    } else if( sum > 100 && !$('#bar-chart-weight-new-scenario-' + group).hasClass('progress-bar-danger') ) {

        Lobibox.alert('warning', {
            msg: "Please correct your subgroup weighting to equal 100"
        });

        $('#bar-chart-weight-new-scenario-' + group).removeClass('progress-bar-info');
        $('#bar-chart-weight-new-scenario-' + group).addClass('progress-bar-danger  animated flash infinite');

    }

    if (sum < 100) {
        $.each( subgroupActives, function (index, item) {
            if (item.group == group) {
                item.sum = sum;
            }
        } );

        $('#message-progress-bar-' + group).show();
    } else if (sum > 100) {

        $.each( subgroupActives, function (index, item) {
            if (item.group == group) {
                item.sum = sum;
            }
        } );

        $('#message-progress-bar-' + group).show();
    } else if (sum == 100) {
        $.each( subgroupActives, function (index, item) {
            if (item.group == group) {
                item.sum = sum;
            }
        } );

        $('#message-progress-bar-' + group).hide('fast');
    }

    $('#bar-chart-weight-new-scenario-' + group).css('width', sum+'%').attr('aria-valuenow', sum); 
    $('#bar-chart-weight-new-scenario-' + group + ' span.sr-only').text(sum + "%");

    
}


//disable option in combo for match
$(document).ready(function () {
    
    //set text to values combo
    $.each( $('.combo-for-match option' ), function (index) {
        $(this).val( $( this ).text() );
    } );

    //recorre combo for a values
    $('.combo-for-match-a').change(function () {
         
        $('.combo-for-match-a option').show();

        $.each( $('.combo-for-match-a'), function (index) {
            
            if ($(this).val() != 'Unmatched') {
                $(".combo-for-match-a option[value*='"+$(this).val()+"']").hide();
            }
            
        } );

    });

    //recorre combo for a values
    $('.combo-for-match-b').change(function () {
         
        $('.combo-for-match-b option').show();

        $.each( $('.combo-for-match-b'), function (index) {
            
            if ($(this).val() != 'Unmatched') {
                $(".combo-for-match-b option[value*='"+$(this).val()+"']").hide();
            }
            
        } );

    });

});

var formCompare = {
	
	stringify:function(obj) {
		return JSON.stringify(obj)	
	},
	
	hasChanged:function(obj1,obj2) {
		return (formCompare.stringify(obj1) != formCompare.stringify(obj2));	
	},

	matches:function(obj1,obj2) {
		return (formCompare.stringify(obj1) === formCompare.stringify(obj2));	
	},

	
	getFormData : function(form) {
		return $(form).serializeObject();
	},
	
	popCriteria:function(obj) {
		if (typeof obj.favorite != 'undefined') {
			delete obj.favorite;
		}
		return obj;
	},
	popFavorites : function(obj) {
		return (typeof obj.favorite === 'undefined') ? null : obj.favorite;
	}
};



function infoGet(link,callback) {
    $.ajax({
        type: "POST",
        url: '/ajax/infoGet',
        data: {"link":link},
		dataType: "JSON",        
        success: function (data) {
	        if (typeof callback == 'function') {
		        callback(data);
	        }
        }, 
        error: function (){
            console.log("error");
        }
    });
}


$(function(){
	
	$('b.help-icon').on('click',function(){
		var link = $(this).attr('data-link');
		infoGet(link,function(data) {
			
			if (data.length == 0) {
	            Lobibox.alert('warning', {
	                msg: "No information specified for this control."
	            });
			} else {
				
				$('#info-name').empty().html(data.Info.name);
				$('#info-content').empty().html(data.Info.content);
				$('#helpModal').modal('show');	
			}
		});
	});
	
})


function addRemoveRequire (input, id) {
    if ( isNaN( parseFloat( $(input).val() ) ) || parseFloat( $(input).val() ) == 0 ) {
        if ( $("#"+id).length > 0 ) {
            document.getElementById(id).removeAttribute("required");
            $( "#"+id ).parentsUntil( ".form-group" ).removeClass( "has-error" );
        }
    } else {
        if ( $("#"+id).length > 0 ) {
            document.getElementById(id).setAttribute("required", "required");
            $( "#"+id ).parentsUntil( ".form-group" ).addClass( "has-error" );
        }
    }
};

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};



