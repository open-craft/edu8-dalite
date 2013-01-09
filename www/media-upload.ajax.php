<?php
//Handles file uploads. May have to be relocated.
//If the location is changed, so should $image_file,
//since the path is relative to this script.

$tmp_name = $_FILES['media1']['tmp_name'];

$image_name = $_FILES['media1']['name'];
$image_file = 'img-uploads/' . $image_name;
   
try {
    move_uploaded_file($tmp_name, $image_file);
}
catch (Exception $e) {
    print_r($e);    
}

echo($image_name);
?>
