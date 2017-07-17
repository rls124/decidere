function showEditNameScenario (id) {
	$('#show-name-scenario-'+id).hide();
	$('#edit-name-scenario-'+id).show();
}

function showNameScenario (id) {
	$('#edit-name-scenario-'+id).hide();
	$('#show-name-scenario-'+id).show();
}

function initDashBoardMessageModal(){
    var cookieValue = $.cookie("notShowDashBoardMessageAgain");
    if(cookieValue == undefined){
        $('#dashboardMessageModal').modal('show');
    }
}

function isDashboardPage(){
    var pathname = window.location.pathname;
    if (pathname.match("/User/dashboard")) {
        return true; 
    }
    return false;
}

//tablesorter
$(function() {

  $(".table-dashboard").tablesorter({

    sortList: [[2,1], [3,1]],
    sortForce: [[2,1], [3,1]],

    textExtraction: {
      2: function(node, table, cellIndex){ return $(node).find("span").text(); }
    }

  });

});


$(document).ready(function (e) {
    $('#tabs').removeClass('ui-widget-content ui-tabs ui-widget ui-corner-all');
    $('#tabs #ulTabsDashboard').removeClass('ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all');
    $('#tabs .tab-pane-newScenario').removeClass('ui-tabs-panel ui-widget-content ui-corner-bottom ');
    if(isDashboardPage()){
        initDashBoardMessageModal();
    }    
});

$(".tr-scenario").hover(function(){
    $(this).find(".btn-edit-name").css('visibility','visible');
    $(this).find(".edit-scenario").css('visibility','visible');
    $(this).find(".delete-scenario").css('visibility','visible');  
},function(){
    $(this).find(".btn-edit-name").css('visibility','hidden');
    $(this).find(".edit-scenario").css('visibility','hidden');
    $(this).find(".delete-scenario").css('visibility','hidden');
});


$(".tr-favorite").hover(function(){
    $(this).find(".rm-favorite").css('color','#23527');
    $(this).find(".edit-scenario").css('visibility','visible');  
},function(){
    $(this).find(".rm-favorite").css('color','#CCCCCC');
    $(this).find(".edit-scenario").css('visibility','hidden');
});

$(".rm-favorite").hover(function(){
    $(this).css('color','#23527');
},function(){
    $(this).css('color','#CCCCCC');
});

//set order tabs from user dashboard
$("#tabs").tabs().find("ul").sortable({
    axis : "x",
    update: function (e, ui) {
        var csv = "";
        var providersOrdered = [];
        $("#tabs > ul > li > a").each(function(i){
            //csv+= ( csv == "" ? "" : "," )+this.id;
            providersOrdered.push({'order':i, 'dataset': this.id.substr(1) });
            //csv+=this.id;

        });

        $.ajax({
            type: "POST",
            url: urlSetOrderUserProvider,
            data: {'providers' : JSON.stringify(providersOrdered)},
            dataType: "json",
            success: function (data) {
                console.log(data)
            }, 
            error: function (){
                console.log("error");
            },

            beforeSend: function () {
                
            },
            complete: function () {
                
            }
        });
    }
});


$('.form-edit-name-scenario').submit(function (event) {
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
	                msg: 'Save Scenario.',
	            });
	            showNameScenario (data.response.response.id);
	            $('#show-name-scenario-'+data.response.response.id).find('span.link-scenario-name').text( data.response.response.name );
            } else if (data.response.response.status == 'scenario not found') {
                Lobibox.notify('error', {
	                msg: 'Scenario not found.',
	            });
            } else if (data.response.response.status == 'unautorized') {
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
        },
        complete: function () {
            $(form).find('input').attr("disabled", false);
        }
    });
});

//delete favorite from dashboard
$('.form-delete-favorite').submit(function (event) {
    event.preventDefault();
    form = this;
    
    Lobibox.confirm({
        title : 'Please confirm',
        msg: "Are you sure you want to delete this favorite?",
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

                        if(data.response.response.status == 'success') {
                            Lobibox.notify('success', {
                                msg: 'Favorite successfully removed.',
                            });
                            deleteFavorite (data.response.response.id);
                        } else if (data.response.response.status == 'favorite not found') {
                            Lobibox.notify('error', {
                                msg: 'Favorite not found.',
                            });
                        } else if (data.response.response.status == 'unautorized') {
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
                    },
                    complete: function () {
                        $(form).find('input').attr("disabled", false);
                    }
                });
                
            }
        }
    });


});


//delete scenario from dashboard
$('.form-delete-scenario').submit(function (event) {
    event.preventDefault();
    form = this;
    
    Lobibox.confirm({
        title : 'Please confirm',
        msg: "Are you sure you want to delete this scenario?",
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

                        if(data.response.response.status == 'success') {
                            Lobibox.notify('success', {
                                msg: 'Scenario successfully removed.',
                            });
                            location.reload();
                        } else if (data.response.response.status == 'scenario not found') {
                            Lobibox.notify('error', {
                                msg: 'Scenario not found.',
                            });
                        } else if (data.response.response.status == 'unautorized') {
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
                    },
                    complete: function () {
                        $(form).find('input').attr("disabled", false);
                    }
                });
                
            }
        }
    });

});

$('#scenario-search-box').on('change keyup paste', function() {
    var searchKeyword = $('#scenario-search-box').val().toLowerCase();
    if(searchKeyword){
        $('span.span-name-scenario').each(function(){
            var scenarioName = $(this).text().toLowerCase();
            if(scenarioName.indexOf(searchKeyword)===-1){
                $(this).closest('tbody').hide();
                $(this).closest('tbody').next('tbody').hide();

            }else{
                $(this).closest('tbody').show();
                if($.inArray($(this).closest('tbody').next('tbody').attr('id'), hiddenFavorites) === -1){
                     $(this).closest('tbody').next('tbody').show();
                }
                
            }
        });
    }else{
        $('tbody').each(function(){
            if($.inArray($(this).attr('id'), hiddenFavorites) === -1){
                $(this).show();
            }
        });
    }   
});




$('#btnDashBoardMessage').click(function(event){
    var checked = $('#confirmCheckbox').is(":checked");
    if(checked){
        $.cookie('notShowDashBoardMessageAgain', 'true', { expires: 20 * 365 , path:'/'});  //This cookie will expires in 20 year.
    }
});

function deleteFavorite (favoriteId) {
    $('.tr-favorite-delete#'+favoriteId).remove();
}