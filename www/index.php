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
                'title' => 'This is friction question',
                'concepts' => ['friction', 'matter'],
                'media1' => ['type' => 'jpeg', 'data' => '/img-uploads/q1.jpg'],
                'media2' => ['type' => 'youtube', 'data' => 'P0s1hZ-Ru-c'],
                'num_choice' => 5,
                'choice_type' => 'alpha',
                'answer' => 1,
                'second_best' => 2,
                'rationales' => [
                    'Rationale for a',
                    'Rationale for b',
                    'Rationale for c',
                    'Rationale for d',
                    'Rationale for e'
                    ]
                
            ],
            [
                'title' => 'This is another question',
                'concepts' => ['friction', 'tension'],
                'media1' => ['type' => 'jpeg', 'data' => '/img-uploads/q2.jpg'],
                'media2' => ['type' => 'none'],
                'num_choice' => 6,
                'choice_type' => 'numeric',
                'answer' => 3,
                'second_best' => 1,
                'rationales' => [
                    'Rationale for 1',
                    'Rationale for 2',
                    'Rationale for 3',
                    'Rationale for 4',
                    'Rationale for 5',
                    'Rationale for 6',
                    ]
              ]
          ]]);
?>
