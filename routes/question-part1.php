<?php

function build(&$a) {
    if (!array_key_exists('assignment', $a['request'])) {
        unset($a['question_num']);
        \Edu8\Http::redirect('/');
    }

    $a['alpha'] = ['Z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
    $a['assignment'] = $a['request']['assignment'];
    $connection = \Edu8\Config::initDb();

    if (!array_key_exists('question_num', $a)) {
        $completed_statement = \Edu8\Sql::runStatement($connection, 'completed', ['student' => $a['student']['student_'], 'assignment' => $a['assignment']]);
        $q_completed = $completed_statement->fetchAll();

        $question_statement = \Edu8\Sql::runStatement($connection, 'assignment_question', ['assignment' => $a['assignment']]);
        $a['question'] = $question_statement->fetchAll();

        foreach ($a['question'] as &$q) {
            $q['concepts'] = preg_split('/,/', $q['concepts']);
        }

        $a['question_num'] = $q_completed[0]['q_completed'] ? $q_completed[0]['q_completed']>>1 - 1 : 0; // div 2 minus 1 or 0

        if (count($a['question']) <= $a['question_num']) {
            unset($a['question_num']);
            \Edu8\Http::redirect('/');
        }
    }
}

?>
