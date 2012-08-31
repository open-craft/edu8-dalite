<?php
    require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('template');


    $twig = new Twig_Environment($loader);

    //Variable stubs go here :)

    echo $twig->render('i.html', array('a_variable' => 'Koya', 'b_variable' => 'Don'));
    

?>
