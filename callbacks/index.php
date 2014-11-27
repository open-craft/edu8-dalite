<?php

function post(&$a) {
    if (!isset($a['lti'])) {
        unset($a['question_num']);
    }
    unset($a['message_dlg']);
}

?>
