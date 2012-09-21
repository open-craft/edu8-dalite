<?php
require_once 'vendor/autoload.php';
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('route_name', new Route('/foo', array('controller' => 'MyController')));

$context = new RequestContext($_SERVER['REQUEST_URI']);

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
/*
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
                'student' => array ('firstname' => 'myfirstname', 'lastname' => 'mylastname'),
                )
            ); 
*/
?>
