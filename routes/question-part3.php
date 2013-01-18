<?php

function build(&$a) {
    $connection = \Edu8\Config::initDb();
    $q = $a['question'][$a['question_num']];

    if($a['request']['answer'] == $q['answer']) 
        $second_choice = $q['second_choice'];
    else
        $second_choice = $a['request']['answer'];

    $db_statement = \Edu8\Sql::runStatement($connection, 'rationales',
            ['question' => $q['question_'],
            'answer' => $second_choice, ]);
    $a['rationales2'] =  $db_statement->fetchAll();

    $db_statement = \Edu8\Sql::runStatement($connection, 'rationales',
            ['question' => $q['question_'],
            'answer' => $q['answer'], ]);
        $a['rationales'] =  $db_statement->fetchAll();

    $a['other'] = $second_choice;        
    $a['swap'] = rand(0, 1);

}

?>
