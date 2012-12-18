<?php
function build (\Symfony\Component\HttpFoundation\Request $request, &$a){
        
        if($request->request->get('log')=== 'hello')
            $a['auth'] = true;
}
?>
