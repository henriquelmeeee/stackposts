<?php

$title=__("Livro de visitas", false);
$data=[
    'title'=>$title
];
view('inc/head', $data);
print '<h1>'.$title.'</h1>';
view('form/message');
if ($message) {
    print '<hr><p>'.e($message['message'],false).'</p>';
    $href='/messages/'.$message['id'];
    print '<a href="'.$href.'">';
    print '<small>'.date('r', $message['created_at']).'</small></a>';
}
