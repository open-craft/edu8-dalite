<?php

function readLogins($path) {
    foreach (file($path) as $row) {
        $logins[] = ltrim(rtrim(explode(',', $row)[1],"\""),"\"");
    }
    array_shift($logins); //drop the first element

    return $logins;
}

function post(\Symfony\Component\HttpFoundation\Request $request, &$a) {
    $uploaded = $request->files;

    if ($uploaded->has('file')) {
        #do mysql import
        $noerr = 1;
        $filename = $uploaded->get('file')->getPathname();
        system('chmod 644 '.$filename);
        system('ln -s ' . $filename . ' /tmp/student.csv');
        $file = file_get_contents('/tmp/student.csv');
        $fileout = str_replace('^,', '^"",', $file);
        // write the file
        file_put_contents('/tmp/student.csv', $fileout);
        system('mysqlimport --ignore-lines=1 -vv --local --fields-enclosed-by="\\"" --fields-terminated-by="," -u root --password=xxxxxx dalite /tmp/student.csv', $noerr);
        $params = readLogins('/tmp/student.csv');
        system('rm /tmp/student.csv');
        if (!noerr || !count($params))
            throw new Edu8\Exception("import error");

        $connection = \Edu8\Config::initDb();
        $connection->insert('course', ['professor_' => $a['student']['student_'], '`name`' => $a['request']['name'], '`accessible`' => '1']);
        $course_id = $connection->lastInsertId();

        ## get use the where in (logins) from the file to get the student_ ids to add to student_course
            $sql = Edu8\Sql::getStatement('insert-students-by-login');
        $connection->executeQuery($sql, [$course_id, $params], [\PDO::PARAM_INT, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY]);
    }
}

?>
