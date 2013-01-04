<?php
function post (\Symfony\Component\HttpFoundation\Request $request, &$a){

    $uploaded = $request['files']['file'];
    if($uploaded.isValid()){
        #do mysql import
        echo here;  
    }
            
}
?>
