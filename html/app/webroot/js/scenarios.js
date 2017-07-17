
var scenarioSavedId = 0;

function getActiveScenarioForm() {
	var currentForm = $('#newScenario')[0];
	if (!currentForm) {
	   currentForm = $('#editScenarioForm')[0];
	   if (!currentForm) {
		   currentForm = $('#runScenarioForm')[0];
		}
	}
	return currentForm;
}


function datasetAutoSave() {

	var currentScenarioForm = getActiveScenarioForm();
	var saveFormObject	= formCompare.getFormData(currentScenarioForm);
		saveFavorites	= formCompare.popFavorites(saveFormObject);
		saveCriteria	= formCompare.popCriteria(saveFormObject);
				
/*
	scenarioSave(saveFormObject,function(data){
        Lobibox.notify('success', {
            msg: 'Dataset changes were detected, your scenario has been updated for your convenience.',
        });
	});
*/
	
}


function scenarioSave(obj,callback,error_callback) {
	scenario_form = getActiveScenarioForm();
	var scenarioValues = JSON.stringify( $( '#' + scenario_form.id).serializeObject() );
    $('#' + scenario_form.id + ' #scenario_val').val(  scenarioValues  );
    	            
    $.ajax({
        type: "POST",
        url: "/User/saveScenario",
        data: new FormData(scenario_form),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            scenarioSavedId = data.response.response.id;
            
            if (typeof callback === 'function') {
	            callback();
            }
        }, 
        error: function (){
            if (typeof error_callback === 'function') {
	            error_callback();
            }				        
        }
	});
   
}

function scenarioSaveAs(obj,callback,error_callback) {
	
	scenario_form = getActiveScenarioForm();
	var promp = Lobibox.prompt('text', {
        title: 'Please enter the name for the new scenario',
        required: true,
        attrs: {
            placeholder: "Scenario name",
        },
        callback: function(box, btn) {
	        
            if (btn == 'ok' && box.$input[0].value != ''){	

                if( box.$input[0].value != '' ){
                    $( '#' + scenario_form.id + ' #scenario_name' ).val( box.$input[0].value );
                } else {
                    $( '#' + scenario_form.id + ' #scenario_name' ).val( 'Scenario name' );
                }
	            
				var scenarioValues = JSON.stringify( $( '#' + scenario_form.id).serializeObject() );
			    $('#' + scenario_form.id + ' #scenario_val').val(  scenarioValues  );
			    	            
			    $.ajax({
			        type: "POST",
			        url: "/User/saveAsScenario",
			        data: new FormData(scenario_form),
			        processData: false,
			        contentType: false,
			        dataType: "json",
			        success: function (data) {
			            scenarioSavedId = data.response.response.id;
			            
			            if (typeof callback === 'function') {
				            callback();
			            }
			        }, 
			        error: function (){
			            if (typeof error_callback === 'function') {
				            error_callback();
			            }				        
			        }
				});
       		}
	    }
	});        
}


function saveResults(callback) {

    var checkedItems = [];
    var favoritesForSaveArray = [];

    $('.checkbox-favorite').each(function (index, value) {
        if( $(this).is(':checked') ) {
            checkedItems.push( parseInt( $(this).val() ) );
        }
    });

    if (checkedItems.length > 0) {

		$.each( resultsForScenario, function( index, value ){
		    if( checkedItems.indexOf(index) != -1){
		        favoritesForSaveArray.push(value);
		    }
		});  

		$.ajax({
		    type: "POST",
		    url : "/User/saveResults", 
		    data: {'favorites' : JSON.stringify( favoritesForSaveArray ), 'headers' : resultsForScenario[0], 'scenario_id': scenarioSavedId, 'period' : periodFavorite },
		    dataType: "json",
		    success: function (data) {
		        request_progress.setProgress(100);
		        request_progress.destroy();
	            if (typeof callback === 'function') {
		            callback();
	            }
		    }, 
		    error: function (){
		        console.log("error to save");
		    }
		});
	}				
}

$(function () {

	var currentScenarioForm = getActiveScenarioForm();
	
	/* Delay injected while form os being updated against the dataset */
	setTimeout(function(){
		var originalFormObject	= formCompare.getFormData(currentScenarioForm);
			originalFavorites	= formCompare.popFavorites(originalFormObject);
			originalCriteria	= formCompare.popCriteria(originalFormObject);
			scenarioSavedId = $('#scenario_id').val();
			
		},500);
		


	
	$('#saveButton').on('click',function(){

		var saveFormObject	= formCompare.getFormData(currentScenarioForm);
			saveFavorites	= formCompare.popFavorites(saveFormObject);
			saveCriteria	= formCompare.popCriteria(saveFormObject);

			scenarioSave(saveFormObject,function(data){

				if (formCompare.hasChanged(originalFavorites,saveFavorites)) { 
					saveResults(function(){
			            Lobibox.notify('success', {
			                msg: 'Your results favorites were successfully saved.',
			            });					
						document.location.replace("/User/dashboard");
					});
				}					
	            Lobibox.notify('success', {
	                msg: 'The scenario was successfully saved.',
	            });
				document.location.replace("/User/dashboard");
				
			});

	});	
	
	$('#saveAsButton').on('click',function(){

		var saveFormObject	= formCompare.getFormData(currentScenarioForm);
			saveFavorites	= formCompare.popFavorites(saveFormObject);
			saveCriteria	= formCompare.popCriteria(saveFormObject);

			scenarioSaveAs(saveFormObject,function(data){

				if (formCompare.hasChanged(originalFavorites,saveFavorites)) { 
					saveResults(function(){
			            Lobibox.notify('success', {
			                msg: 'Your results favorites were successfully saved.',
			            });					
						document.location.replace("/User/dashboard");
					});
				}					
	            Lobibox.notify('success', {
	                msg: 'The scenario was successfully saved.',
	            });
				document.location.replace("/User/dashboard");
				
			});

	});
				
		

	$('#savePrototype').on('click',function(){

		var saveFormObject	= formCompare.getFormData(currentScenarioForm);
			saveFavorites	= formCompare.popFavorites(saveFormObject);
			saveCriteria	= formCompare.popCriteria(saveFormObject);

			// has Criteria been Changed
			if (formCompare.hasChanged(originalCriteria,saveCriteria)) {
				
				scenarioSaveAs(saveFormObject,function(data){

					if (formCompare.hasChanged(originalFavorites,saveFavorites)) { 
						saveResults(function(){
				            Lobibox.notify('success', {
				                msg: 'Your results favorites were successfully saved.',
				            });					
							document.location.replace("/User/dashboard");
						});
					}					
		            Lobibox.notify('success', {
		                msg: 'The scenario was successfully saved.',
		            });
					document.location.replace("/User/dashboard");
					
				});
				
			// has Results Favorites been changed.	
			} else if (formCompare.hasChanged(originalFavorites,saveFavorites)) { 

				saveResults(function(){
		            Lobibox.notify('success', {
		                msg: 'Your results favorites were successfully saved.',
		            });					
					document.location.replace("/User/dashboard");
				});
				
			} else {

	            Lobibox.notify('success', {
	                msg: 'No changes to save...',
	            });					
				
			}
	});
	
});
