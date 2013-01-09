/******************
Francisco Charrua

Uploads an image to the server. Had to use the jquery.form plugin
Jquery alone did not work.
 ******************/

$(document).ready(
        function() {
            $('#image').ajaxForm({error: function(data) {alert(data.responseText);},
                        complete: function(data) {uploadReady(data.responseText);}});
    
            $('#collapseOne input[type=file]').change(
                    function(filedata) {
                        $('#image').submit();
                
                        /*  Did not work, the $_FILES array in the php file was empty.
                        
                        var filename = $('#collapseOne input[type=file]').val();
                        
                        alert(filedata.target.value);
                        
                        $.ajax(
                                {type: "POST",
                                 url: "/media-upload.ajax.php",
                                 enctype: "multipart/form-data",
                                 data: {file: filename},
                                 success: function(data) {alert(data);},
                                 error: function(data) {alert(data.responseText);}}
                        );*/
                    }
            );
        }
);

function uploadReady(file) {
    var file_url = '/img-uploads/' + file;
    
    $('#collapseOne #img_success').text(file + ' uploaded');
     
    if($('#collapseOne #img_show').length === 0) {
        var html = '<img id="img_show" style="display:block;" src="' + file_url + '" />';    
        $('#collapseOne #img_success').before(html); 
    } else {
        $('#collapseOne #img_show').attr('src', file_url);
    }
}