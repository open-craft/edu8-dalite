<?php

function build(&$a) {
    $connection = \Edu8\Config::initDb();
    $db_statement = \Edu8\Sql::runStatement($connection, 'student_assignment', ['student_' => $a['student']['student_']]);
    $a['assignments'] = $db_statement->fetchAll();
    unset($a['question_num']);
}

?>
