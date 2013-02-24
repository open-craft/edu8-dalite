<?php


function post(&$a) {
    if ($a['request']['pathname'] != '/question-part2')
        unset($a['question_num']);
}
?>
