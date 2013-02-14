<?php

function post(&$a) {
    //print_r($a);
    
    
    //Youtube videos (11 character id) or uploaded images
    $media1 = '';
    
    if($a['request']['media1'] == 'Video') {
        $media1 = $a['request']['youtube1_id'];
    }
    
    if($a['request']['media1'] == 'Image') {
        $media1 = $a['request']['filename1'];
    }
    
    $media2 = '';
    
    if($a['request']['media2'] == 'Video') {
        $media2 = $a['request']['youtube2_id'];
    }
    
    if($a['request']['media2'] == 'Image') {
        $media2 = $a['request']['filename2'];
    } 
    
    //Are the multiple choice answers in letters or numbers.
    if($a['request']['alpha'] == 'alpha') {
        $alpha = 1;
    }  else {
        $alpha = 0;
    }  
    
    $sql_args = ['media1' => $media1, 'media2' => $media2, 
                'description' => $a['request']['description'],
                'num_choice' => $a['request']['num_choice'],
                'alpha' => $alpha,
                'answer' => $a['request']['answer'],
                'second_choice' => $a['request']['second_choice'],
                'rationale' => $a['request']['rationale']];
    
    //print_r($sql_args);
    
    $connection = \Edu8\Config::initDb();
    $connection->insert('question', $sql_args);
    $connection->close();
 }

?>
