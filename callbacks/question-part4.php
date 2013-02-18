<?php

function post(&$a) {
    if(array_key_exists('question_num', $a)) {
        $a['question_num']++;
        if ($a['question_num'] >= count($a['question'])) {
            unset($a['question']);
            unset($a['question_num']); 
            $a['message_dlg'] = 'Bravo, you have completed this assignment';
            Edu8\Http::Redirect('/', $a);
        } else {
            unset($a['message_dlg']);
        }
    }
    
}
?>
