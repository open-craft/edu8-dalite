<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;
use \Twig_Autoloader;

$session = new Session();
$session->start();

// set and get session attributes
$question_num = $session->get('question_num', 0);
$session->set('question_num', ++$question_num);


    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/../templates');
    $twig = new Twig_Environment($loader);

    echo $twig->render('question-part1.html.twig', [
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
