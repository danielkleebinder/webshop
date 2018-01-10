/*
 Created on : 25.05.2017
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */


// Weather Zip Code Selection
$('.weather-zip-code').click(function (evt) {
    console.log("TEST");
    $.ajax({
        type: 'POST',
        url: './ajax/LoadWeather.php',
        data: 'zipCode=' + $(this).attr('data'),
        success: function (data) {
            $('#weather').html(data);
        }
    });
});