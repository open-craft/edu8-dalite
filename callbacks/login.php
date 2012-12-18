<?php
function post (\Symfony\Component\HttpFoundation\Request $request, &$a){
        $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,
                'login', ['login' => $a['request']['log']]);
        $a['student'] =  $db_statement->fetchAll();

        

        if($a['student']['password'] === $a['request']['pass'])
            $a['auth'] = true;
        
}
?>
