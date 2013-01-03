<?php
function post (\Symfony\Component\HttpFoundation\Request $request, &$a){
    if($a['request']['log']){
        $connection = \Edu8\Config::initDb();
        $db_statement = \Edu8\Sql::runStatement($connection,
                'login', ['login' => $a['request']['log']]);
        $a['student'] =  $db_statement->fetchAll()[0];
        
        if($a['student'] && $a['student']['password'] === $a['request']['pass'])
            $a['auth'] = true;
    }
}
?>
