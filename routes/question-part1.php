<?php

function build(\Symfony\Component\HttpFoundation\Request $request, &$a) {
 
    if(!array_key_exists('question_num',$a)){
        $a['assignment'] = $a['request']['assignment'];
        $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,
                'assignment_question', ['assignment' => $a['assignment']]);
        $a['question'] =  $db_statement->fetchAll();

        foreach ($a['question'] as &$q) {
            $q['concepts'] = preg_split('/,/',$q['concepts']);
        }
        $a['question_num'] = 0; 
    } 
}

?>
