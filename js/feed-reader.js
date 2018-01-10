/*
 Created on : 25.05.2017
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */


$('#read-news-feed').click(function (evt) {
    $('#news-feed').html('<div class="loader centered"></div>');
    $.ajax({
        type: 'POST',
        url: './ajax/LoadFeed.php',
        data: 'url=' + $('#feed-url').val(),
        success: function (data) {
            $('#news-feed').html(data);
        }
    });
});
