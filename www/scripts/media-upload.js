/****************************************************************
Francisco Charrua

Uploads an image to the server. Had to use the jquery.form plugin
Jquery alone did not work.

Also embeds a youtube video in an iframe.

*****************************************************************/

$(document).ready(
        function() {
            $('#collapseOne input[type=radio][name=media1]').change(
                    function(data) {
                        switch(data.target.value) {
                            case 'Video':
                                $('#collapseOne #img_success').hide();
                                $('#collapseOne #img_show').hide();
                                
                                $('#collapseOne #youframe').show();
                                break;
                                
                            case 'Image':
                                $('#collapseOne #img_success').show();
                                $('#collapseOne #img_show').show();
                                
                                $('#collapseOne #youframe').hide();
                                break;
                        }
                    }
                );
                
            $('#collapseOne #youtube').change(
                    function(data) {
                        var html = '<iframe id="youframe" width="420" height="345" src="http://youtube.com/embed/' + getVar('v', data.target.value) + '"></iframe>';
                        
                        $('#collapseOne #youtube').after(html);
                    }
                );
    
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

/**************************
 Displays an uploaded image.
                
 **************************/
function uploadReady(file) {
    var file_url = '/img-uploads/' + file;
    var ext = file.substr(file.lastIndexOf('.') + 1);

    $('#collapseOne #filename').val(file);
    
    $('#collapseOne #img_success').text(file + ' uploaded');
    
    if(ext != 'jpg' && ext != 'png' && ext != 'gif') {
        return;
    }
     
    if($('#collapseOne #img_show').length === 0) {
        var html = '<img id="img_show" style="display:block;" src="' + file_url + '" />';    
        $('#collapseOne #img_success').before(html); 
    } else {
        $('#collapseOne #img_show').attr('src', file_url);
    }
}

/*********************************************************
 Used to properly display a youtube video, by getting its
 id from the query string.

 *********************************************************/
function getVar(name, get_string)
         {
         return_value = '';
         
         do { //This loop is made to catch all instances of any get variable.
            name_index = get_string.indexOf(name + '=');
            
            if(name_index != -1)
              {
              get_string = get_string.substr(name_index + name.length + 1, get_string.length - name_index);
              
              end_of_value = get_string.indexOf('&');
              if(end_of_value != -1)                
                value = get_string.substr(0, end_of_value);                
              else                
                value = get_string;                
                
              if(return_value == '' || value == '')
                 return_value += value;
              else
                 return_value += ', ' + value;
              }
            } while(name_index != -1)
            
         //Restores all the blank spaces.
         space = return_value.indexOf('+');
         while(space != -1)
              { 
              return_value = return_value.substr(0, space) + ' ' + 
              return_value.substr(space + 1, return_value.length);
							 
              space = return_value.indexOf('+');
              }
          
         return(return_value);        
         }