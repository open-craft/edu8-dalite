<?php
function post (\Symfony\Component\HttpFoundation\Request $request, &$a){

    $uploaded = $request->files;
    if($uploaded->has('file')){
        #do mysql import
        $noerr = 1;
        $file = $uploaded->get('file')->getPathname();
        system('ln -s '. $file . ' /tmp/student.csv');
        system('mysqlimport --ignore-lines=1 -vv --local --fields-terminated-by="," -u root --password=xxxxxx dalite /tmp/student.csv', $noerr);
        system('rm /tmp/student.csv');
        if(!noerr)
            throw new Edu8\Exception("import error");
        
        ## get use the where in (logins) from the file to get the student_ ids to add to student_course
    }
            
}
?>
