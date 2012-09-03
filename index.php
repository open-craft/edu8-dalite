<?php
    require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('templates');


    $twig = new Twig_Environment($loader);

    //Variable stubs go here :)

    echo $twig->render('i.html', 
          array('count' => '0', 
                'assignment' => array('title' => 'This is the title', 
                        'concepts' => array('friction', 'matter',),),
                'media1' => array('type' => 'jpeg',),
                'media2' => array('type' => 'youtube',),
                )
            ); 
?>
