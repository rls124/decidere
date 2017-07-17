var currentForm;

//funtion for change checkbox groups new scenario
function showHideWeightGroup (check, group) {
    if ($(check).is(':checked')) {
        $('#content-input-weight-group-' + group ).find(' :input').prop('disabled', false);
        $('#content-input-weight-group-' + group +' #group_weight_' + group ).addClass('new-scenario-weight'); 
        $('#content-input-weight-group-' + group  ).show('slow');
        updateIndicatorWeight();
    } else {
        //$('#content-input-weight-group-' + group +' #group_weight_' + group ).val(0);
        $('#content-input-weight-group-' + group ).find(' :input').prop('disabled', true);
        $('#content-input-weight-group-' + group +' #group_weight_' + group ).removeClass('new-scenario-weight'); 
        $('#content-input-weight-group-' + group ).hide('slow');
        updateIndicatorWeight();
    }  
}


//send form new scenario
$("#newScenario").submit(function (event) {
    
    if (scenarioSavedId > 0) {
        scenarioSavedId = null;
    }

    //no submit form
    event.preventDefault();
    
    //hide link to tab results
    $('#link-tab-results').hide();

    //delte caption for export
    $('#table-results caption').remove();
    
    //empty header table results
    $('#table-results #thead-results tr').html('');

    //empty body table results
    $('#table-results #tbody-results').html('');


    var name = $('#scenario_name').val();
    var form = this;
    currentForm = this;
    var dataValues = $( this ).serialize(); 

    //delete last aquote and set to stringValues 
    var stringValues = (String) ( JSON.stringify(dataValues).slice(0, -1) ) ;

    var urlSaveScenario = form.action
    var urlServer = 'http://lin.decidere.com/cgi-bin/R/process'; //for sending
    var urlForReturn = 'result.json';

    $.ajax({

        type: "POST",
        url: urlServer,
        data: stringValues,
        processData: false,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        crossDomain : true,
        success: function (dataResponse) {

            console.log(dataResponse)
            
            if (dataResponse == '') {
                dataResponse = '{}';
                
            }

            var data = JSON.parse(dataResponse);

            resultsForScenario = data;

            console.log(resultsForScenario);

            $("html, body").animate({ scrollTop: 0 }, "slow");

            //show link to tab results
            $('#link-tab-results').show('slow');

            //show tab with results
            $('#link-tab-results').tab('show');

            //recorre response
            $.each( data, function( index, value ){
                
                //check if is titles
                if(index == 0) {

                    //append to tr header favoites and decidere score
                    $('#table-results #thead-results tr').append('<th> Favorites </th> <th>Decidere Score</th>');

                    //extract key values from object
                    $.each(value, function(key, valueb){
                        //append to tr header each key value
                        $('#table-results #thead-results tr').append('<th> ' + valueb.replaceAll('_', ' ') + ' </th> ');
                    });

                } else {

                    //create new 'tr'
                    var tr = $("<tr class='' ></tr>");

                    //append 'td' with 'checkbox' in 'tr'
                    $( tr ).append('<td> <input type="checkbox" class="checkbox-favorite" name="favorite" value=" ' + index + ' " > </td>');

                    //extract key values from object
                    $.each(value, function(key, valueb){
                        //append one 'td' for each key value in object
                        $( tr ).append('<td> ' + valueb + ' </td> ');
                    });

                    //append 'tr' in tbody
                    $('#table-results #tbody-results').append( $( tr ) );
                }
            });

            //Add functionallity to export
            $("#table-results").tableExport({
                headings: true,                    // (Boolean), display table headings (th elements) in the first row
                formats: ["xlsx", "csv"],    // (String[]), filetypes for the export
                bootstrap: true,                   // (Boolean), style buttons using bootstrap
                position: "top"  
            });

            if ( jQuery.isEmptyObject(data) ) {

                Lobibox.notify('success', {
                    msg: 'Your preferences obtained 0 results.',
                });

            } else {

                Lobibox.notify('success', {
                    msg: 'Your preferences obtained ' + (data.length-1) + ' results.',
                });

            }
        }, 
        error: function (err){
            console.log("error", err);
            Lobibox.alert('error', {
                msg: "Something went wrong please check that the form is properly filled"
            });
        },

        beforeSend: function () {
            request_progress = Lobibox.progress({
                title: 'Please wait'
            });
            request_progress.setProgress(50);
        },
        complete: function () {
            request_progress.setProgress(100);
            setTimeout(function () {
                request_progress.destroy();
                
            }, 2000)
        }
    });

});


//save new scenario
function saveScenario (form) {

    var promp = Lobibox.prompt('text', {
        title: 'Please enter the name for the new scenario',
        attrs: {
            placeholder: "Scenario name",
            required : 'required',
            'value' : 'Scenario name'
        },
        callback: function(box, btn){
            //if ok button save new scenario and send form
            if (btn == 'ok'){

                //chec if name is empty
                if( box.$input[0].value != '' ){
                    $('#newScenario #scenario_name').val( box.$input[0].value );
                } else {
                    $('#newScenario #scenario_name').val( 'Scenario name' );
                }

                $('#newScenario #scenario_val').val('');
                var dataValues = JSON.stringify( $( '#newScenario').serializeObject() );
                $('#newScenario #scenario_val').val(  dataValues  );

                $.ajax({
                    type: "POST",
                    url: form.action,
                    data: new FormData( form ),
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        Lobibox.notify('success', {
                            msg: 'The scenario was successfully saved',
                        });
                        scenarioSavedId = data.response.response.id;
                        saveResultsNew();
                    }, 
                    error: function (){
                        console.log("error to save");
                    },

                    beforeSend: function () {
                        
                    },
                    complete: function () {

                    }
                });

            }
        }
    });


}

//save results from new scenario
function saveResultsNew () {

    if (scenarioSavedId > 0) {

        var checkedItems = [];

        var favoritesForSaveArray = [];

        $('.checkbox-favorite').each(function (index, value) {
            
            if( $(this).is(':checked') ) {
                checkedItems.push( parseInt( $(this).val() ) );
            }

        });

        if (checkedItems.length > 0) {

            request_progress = Lobibox.progress({
                title: 'Please wait, saving the favorites'
            });

            request_progress.setProgress(50);

            $.each( resultsForScenario, function( index, value ){

                if( checkedItems.indexOf(index) != -1){

                    favoritesForSaveArray.push(value);
                }
            });  

            $.ajax({
                type: "POST",
                url : urlSaveResults, 
                data: {'favorites' : JSON.stringify( favoritesForSaveArray ), 'headers' : resultsForScenario[0], 'scenario_id': scenarioSavedId, 'period' : periodFavorite },
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    request_progress.setProgress(100);
                    request_progress.destroy();
                    window.location = data.url;
                }, 
                error: function (){
                    console.log("error to save");
                },

                beforeSend: function () {
                    
                },
                complete: function () {

                }
            });



        } else {
            setTimeout(function () {
                console.log(urlDashboard);
                window.location = urlDashboard;
            }, 2000)
        }


    } else {
        saveScenario(currentForm);
    }
      
}


//serialize form
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

