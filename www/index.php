<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
use Twig_Environment;


$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/../templates');
$twig = new Twig_Environment($loader);

echo $twig->render('question-part1.html.twig', [
    'count' => '0',
    'student' => ['firstname' => 'myfirstname', 'lastname' => 'mylastname'],
    'title' => 'This is the title', 
    'questions' => [
        [
            'concepts' => ['friction', 'matter'],
            'media1' => ['type' => 'jpeg'],
            'media2' => ['type' => 'youtube']
        ],
        [
            'concepts' => ['friction', 'matter'],
            'media1' => ['type' => 'jpeg'],
            'media2' => ['type' => 'youtube']
        ]
        ]]);
?>
