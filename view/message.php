<?php

$title=e($message['message'], false);
$data=[
    'title'=>$title
];
view('inc/head', $data);
print '<h1>'.$title.'</h1>';
print '<small>'.date('r', $message['created_at']).'</small>';
?>
<p>
    <a href="/">Voltar</a>
</p>