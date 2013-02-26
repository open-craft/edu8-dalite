<?php

function preg_grep_keys($pattern, $input, $flags = 0) {
    $keys = preg_grep($pattern, array_keys($input), $flags);
    $vals = array();
    $i = 0;
    foreach ($keys as $key) {
        $vals[$i++] = intval(ltrim($key, 'C'));
    }
    return $vals;
}

function preg_grep_keys_return_values($pattern, $input, $flags = 0) {
    $keys = preg_grep($pattern, array_keys($input), $flags);
    $vals = array();
    $i = 0;
    foreach ($keys as $key) {
        $vals[$i++] = $input[$key];
    }
    return $vals;
}

function post(&$a) {
    if ($a['request']['pathname'] != '/question-part4' && $a['request']['pathname'] != '/question-part3') {
        $a['message_dlg'] = 'Please complete this question first.';
        \Edu8\Http::Redirect('/question-part3', $a);
    } else {
        if($a['request']['pathname'] == '/question-part4') {
            unset($a['message_dlg']);
        }
    }
    
    if ($a['request']['pathname'] == '/question-part4') {
        if (array_key_exists('question_num', $a)) {
            $concepts = implode(",", preg_grep_keys_return_values('/^tag/', $a['request']));
            $connection = \Edu8\Config::initDb();
            $a['request']['second_answer'] = preg_grep_keys('/^C/', $a['request'])[0];

            //Testing.
            $a['answered_correct'][0] = 0;
            $a['answered_correct'][0] = 0;
            
            if (!$a['student']['is_professor']) {
                try {
                    $connection->insert('response', ['student_' => $a['student']['student_'], 'assignment_' => $a['assignment'], 'question_' => $a['question'][$a['question_num']]['question_'], 'attempt' => '0', 'answer' => $a['request']['answer'], 'rationale' => $a['request']['rationale'], 'concepts' => $concepts]);
                    $connection->insert('response', ['student_' => $a['student']['student_'], 'assignment_' => $a['assignment'], 'question_' => $a['question'][$a['question_num']]['question_'], 'attempt' => '1', 'answer' => $a['request']['second_answer'], 'rationale' => $a['request']['rationale'], 'concepts' => $concepts]);
                } catch (Exception $e) {
                    unset($e);
                    //echo 'RESUBMIT ignored.';
                }
            }
        }
    }
}

?>