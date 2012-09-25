<?php
 require_once '../vendor/autoload.php';
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Twig\Twig;

/*

 use Symfony\Component\Routing;
 use Symfony\Component\Routing\RouteCollection;
 use Symfony\Component\Routing\RequestContext;
 use Symfony\Component\Routing\Matcher\UrlMatcher;




class HelloController
{
    public function indexAction($name)
    {
      return new Response('<html><body>Hello '.$name.'!</body></html>');
    }
}
class MyController
{
    public function indexAction()
    {
      // ...
      */
    $loader = new Twig_Loader_Filesystem('../templates');


    $twig = new Twig_Environment($loader);

    //Variable stubs go here :)
//    $request = Request::createFromGlobals();
//    $response = new Response(
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
/*
	return $response;
    }
}

$routes = new RouteCollection();
//$routes->add('route_name', new Route('/foo', array('controller' => 'HelloController::indexAction')));
$routes->add('hello', new Route('/hello/{name}', array(
    'controller' => 'HelloController',
)));

$context = new RequestContext($_SERVER['REQUEST_URI']);

$matcher = new UrlMatcher($routes, $context);

$resolver = new HttpKernel\Controller\ControllerResolver();
 
try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
 
    $controller = $resolver->getController($request);
    $arguments = $resolver->getArguments($request, $controller);
 
    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}
 
$response->send();
echo $parameters['controller'];
?>
