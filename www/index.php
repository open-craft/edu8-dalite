<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/../templates');
$twig = new Twig_Environment($loader);

echo $twig->render('question-part1.html.twig', [
    'question_num' => '1',
    'student' => ['firstname' => 'Dan', 'lastname' => 'Hill'],
    'question' => [
        [   
            'title' => 'This is the title', 
            'concepts' => ['friction', 'matter'],
            'media1' => ['type' => 'jpeg'],
            'media2' => ['type' => 'youtube']
        ],
        [
            'title' => 'This is the title', 
            'concepts' => ['friction', 'matter'],
            'media1' => ['type' => 'jpeg'],
            'media2' => ['type' => 'youtube']
        ]
        ]]);
?>
