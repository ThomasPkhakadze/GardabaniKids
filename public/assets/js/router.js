async function Router(href = '/home'){
    $.ajax({
        url: `${href}`,
        method: "GET",
        dataType: "html",
        // Insert Loader
        beforeSend: function(){
            $('.overlay').show()            
        },
        // Remove Loader after retrieving data
        complete: function(){
            $('.overlay').hide();
        },
        // Insert Data
        success: function(res){
            $('.content').html(res);
        },
        // Display Errors
        error: function(error){
            alert('Oops, there was an error', error);
        }
    });
}
$(document).ready(() => {
    Router();
})