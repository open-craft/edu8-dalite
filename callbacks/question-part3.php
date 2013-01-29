<?php

function preg_grep_keys( $pattern, $input, $flags = 0 )
{
    $keys = preg_grep( $pattern, array_keys( $input ), $flags );
    $vals = array();
    $i=0;
    foreach ( $keys as $key )
    {
        $vals[$i++] = $input[$key];
    }
    return $vals;
}

function post(&$a) {
    if($a['request']['pathname'] != '/question-part4' && $a['request']['pathname'] != '/question-part3'){
        $a['message_dlg'] = 'Please complete this question first.';
        \Edu8\Http::Redirect('/question-part3', $a);
    }
    
    if(array_key_exists('question_num', $a)) {
       $concepts = implode(",", preg_grep_keys('/^tag/', $a['request']));
        $connection = \Edu8\Config::initDb();
        try {
        $connection->insert('response', ['student_' => $a['student']['student_'], 'assignment_' => $a['assignment'], 'question_' => $a['question'][$a['question_num']]['question_'], 'attempt' => '0', 'answer' => $a['request']['answer'], 'rationale' => $a['request']['rationale'], 'concepts' => $concepts]);
        $connection->insert('response', ['student_' => $a['student']['student_'], 'assignment_' => $a['assignment'], 'question_' => $a['question'][$a['question_num']]['question_'], 'attempt' => '1', 'answer' => implode(',', preg_grep_keys('/^C/', $a['request'])), 'rationale' => $a['request']['rationale'], 'concepts' => $concepts]);
        }catch(Exception $e){
            echo 'RESUBMIT ignored.';
        }
    }
}
?>
