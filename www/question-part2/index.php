<?php
 require_once '../vendor/autoload.php';
 use Twig\Twig;

    $loader = new Twig_Loader_Filesystem('../templates');


    $twig = new Twig_Environment($loader);

    echo $twig->render('question-part2.html.twig', 
          array('count' => '0', 
                'assignment' => array('title' => 'This is the title', 
                        'concepts' => array('friction', 'matter',),),
                'media1' => array('type' => 'jpeg',),
                'media2' => array('type' => 'youtube',),
                
                //For assignment entry pages
                'concepts' => array ('concept1', 'concept2',),
                //Student or prof names
                'student' => array ('firstname' => 'myfirstname', 'lastname' => 'mylastname'),
                )
            ); 
?>
