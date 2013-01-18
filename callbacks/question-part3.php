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
       
    }
}
?>
