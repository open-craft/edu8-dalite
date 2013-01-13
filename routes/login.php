<?php
function build (\Symfony\Component\HttpFoundation\Request $request, &$a){
    if (isset($a['auth'])) {
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse('/');
        $response->send();
    }

}
?>
