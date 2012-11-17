<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
 
function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    $twig = new Twig_Environment($loader);
    $temp = $_route;
    $temp = str_replace('_','/', $_route);
    echo $twig->render( $temp
            . '.html.twig', $request->attributes->get('_twig_vars'));
    return new Response(ob_get_clean());
}
 
$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';
 
$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
 
try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);

} catch (Routing\Exception\ResourceNotFoundException $e) {
     $response = call_user_func(render_template, $request, []);
    
} catch (Exception $e) {
    $response = new Response('Not Found', 404);   
    //$response = new Response('An error occurred', 500);
}
 
$response->send();

?>