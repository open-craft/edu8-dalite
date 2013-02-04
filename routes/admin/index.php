<?php
function build (&$a){
                $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,
                'prof-assignment', ['prof_' => $a['student']['student_']]);
        $a['prof_assignment'] =  $db_statement->fetchAll();
}