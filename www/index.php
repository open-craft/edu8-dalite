<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing;

function main() {
    $request = Request::createFromGlobals();
    $session = new \Symfony\Component\HttpFoundation\Session\Session();
    $session->start();
   
    //Get routes and match with incomming url
    $context = new Routing\RequestContext();
    $context->fromRequest($request);
    $routes = Edu8\Route::getRoutes(__DIR__ . '/../routes/');
    $matcher = new Routing\Matcher\UrlMatcher($routes, $context);

    try {
        $request->attributes->add($matcher->match($request->getPathInfo() ) );
        $file_root = $request->attributes->get('file_root');
        $slug = $request->attributes->get('slug');
    } catch(\Exception $e) {
        $file_root = rtrim($request->getPathInfo(),'/');
        $slug = '';//$request->attributes->get('slug');
    }
    $twig_vars = $session->get('twig_vars', []);
    
   
   if(empty($twig_vars['request']))
        $twig_vars['request'] = $request->request->all();
    else
        $twig_vars['request'] = array_merge($twig_vars['request'],$request->request->all());
  
    $session->set('twig_vars', $twig_vars);
    
    if ($twig_vars['auth'] && $file_root === '/login') {
        $response = new RedirectResponse('/');
        $response->send();
        return;
    }
    
    if (!$twig_vars['auth'] && $file_root !== '/login') {
        $response = new RedirectResponse('/login');
        $response->send();
       return;
    }

    //Merge session and post variables 
  try{
        //Get routes and match with refer url
        $routes2 = Edu8\Route::getRoutes(__DIR__ . '/../callbacks/');
        $matcher2 = new Routing\Matcher\UrlMatcher($routes2, $context);
        $try = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
        $attribs = $matcher2->match($try);

        //Dispatch post() from appropriate file
        if(is_file($attribs['php_file'])){
            include $attribs['php_file'];
            post($request, $twig_vars);
        }
    }catch(Exception $e){}

    //Dispatch build() from appropriate file
    if(is_file($request->attributes->get('php_file'))){
           include $request->attributes->get('php_file');
        build($request, $twig_vars);
    }
    $session->set('twig_vars', $twig_vars);

    //Render twig with varables assembled in build()
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    $twig = new Twig_Environment($loader);

    $response = new Response($twig->render($file_root . $slug . '.html.twig', $twig_vars));
    $response->send();
}

try {
    try {
        //MAIN--------------
        main();
        
        
    } catch (\Doctrine\DBAL\DBALException $e) {
        throw new \Doctrine\DBAL\DBALException(
                'ERROR IN SQL Statement. <br>' . $e->getMessage()
                , preg_filter("/.*?SQLSTATE\[\D*(\d*).*$/s", "$1", $e->getMessage()));

    } catch (Routing\Exception\ResourceNotFoundException $e) {
        throw new \Edu8\Exception('Routing\Exception\ResourceNotFoundException Not Found', 404);

    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage()
                , preg_filter("/.*?SQLSTATE\[\D*(\d*).*$/s", "$1"
                , $e->getMessage()));
    }
} catch (Exception $e) {
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    $twig = new Twig_Environment($loader);
    
    $twig_vars['debug_message'] =
            '=== TOP level Exception DEBUG handler === CLASS:'
            . get_class($e) . 'Code:' . $e->getCode(). $e->getMessage();
    
    $response = new Response($twig->render('error.html.twig', $twig_vars)
            , $e->getCode() == 404 ? 404 : 500);
    
    $response->send();

}

?>
