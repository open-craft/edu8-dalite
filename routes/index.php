<?php
function build (\Symfony\Component\HttpFoundation\Request $request,&$a){
        $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,
                'student_assignment', ['student' => $a['student']['student_']]);
        $a['assignments'] =  $db_statement->fetchAll();
       

}
?>
