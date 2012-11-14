<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

$session = new Session();
$session->start();

// set and get session attributes
$question_num = $session->get('question_num', 1);

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/../templates');
$twig = new Twig_Environment($loader);

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

$path = rtrim($path, "/");

if ($path == "")
    $path = "/login";

if ($path == "/admin")
    $path = "/admin/index";

if (strstr($path,"question-part4"))
	$session->set('question_num', $question_num+1);

if ($path == "/reset")
	$session->set('question_num', 1);


    echo $twig->render( $path . '.html.twig', [
        'question_num' => $question_num,
        'student' => ['firstname' => 'Dan', 'lastname' => 'Hill'],
        'question' => [
            [
                'title' => 'This is question',
                'concepts' => ['friction', 'matter'],
                'media1' => ['type' => 'jpeg'],
                'media2' => ['type' => 'youtube']
            ],
            [
                'title' => 'This is the another question',
                'concepts' => ['friction', 'whoupie'],
                'media1' => ['type' => 'jpeg'],
                'media2' => ['type' => 'youtube']
            ]
            ]]);
?>
