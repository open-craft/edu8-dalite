<?php
function post (\Symfony\Component\HttpFoundation\Request $request, &$a){

    $uploaded = $request.files;
    if($uploaded.isValid()){
        #do mysql import
        $err = 0;
        system('mysql -u root -p xxxxxx < '.$uploaded, $err);
        if(err)
            throw new Edu8\Exception("import error");
    }
            
}
?>
