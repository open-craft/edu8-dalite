<?php


function post(&$a) {
    if($a['request']['pathname'] != '/question-part2' && $a['request']['pathname'] != '/question-part1'){
        $a['message_dlg'] = 'Please complete this question first.';
        \Edu8\Http::Redirect('/question-part1', $a);
    }

}
?>
