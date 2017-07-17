//send form
/*$("#form-post").submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: $.param( $( this ).find('input') ),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        success: function (data) {
            console.log(data);
            document.getElementById("show-result").innerHTML = JSON.stringify(data, undefined, 2);
        }, 
        error: function (){
            console.log("error to save");
        },

        beforeSend: function () {
            
        },
        complete: function () {

        }
    });
});*/

$("#form-post").submit(function (event) {
    
    event.preventDefault();

    var form = this;

    $.ajax({
        type: "POST",
        url: form.action,
        data: new FormData( form ),
        processData: false,
        contentType: false,
        dataType: "json",
        //headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        success: function (data) {
            console.log(data.response);
            document.getElementById("show-result").innerHTML = JSON.stringify(data.response, undefined, 2);
        }, 
        error: function (){
            console.log("error to save");
        },

        beforeSend: function () {
            
        },
        complete: function () {

        }
    });
});