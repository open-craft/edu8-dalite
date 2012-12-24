<?php

function build(\Symfony\Component\HttpFoundation\Request $request, &$a) {
        $a['request']['postvar'] = '';
        $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,'prof_courses', ['professor' => $a['student'][0]['student_']]);
        $a['courses'] = $db_statement->fetchAll();
        $db_statement = \Edu8\Sql::runStatement($connection,'all_questions');
        $a['all_questions'] = $db_statement->fetchAll();
 }

?>
