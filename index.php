<?php
    require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('templates');


    $twig = new Twig_Environment($loader);

    //Variable stubs go here :)

    echo $twig->render('index.html', array('count' => '0', 
                'assignment' => array ('title' => 'This is the title', 'description' => 'This is the description',), 
                'concept','concepts' => array ('friction', 'matter',),
            );
?>
