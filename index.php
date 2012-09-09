<?php
    require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('templates');


    $twig = new Twig_Environment($loader);

    //Variable stubs go here :)

    echo $twig->render('profs-add-question.html', 
          array('count' => '0', 
                'assignment' => array('title' => 'This is the title', 
                        'concepts' => array('friction', 'matter',),),
                'media1' => array('type' => 'jpeg',),
                'media2' => array('type' => 'youtube',),
                
                //For assignment entry pages
                'concepts' => array ('concept1', 'concept2',),
                //Student or prof names
                'student' => array ('fname' => 'This is the name',),
                )
            ); 
?>
