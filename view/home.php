<?php

view('inc/head', $data);

?>




    <div id="menu" class="text-center">
        <h1>StackPosts</h1>
        <?php
print '<a href="?random">'.__('Aleatório',false).'</a>';

        ?>
    </div>
    <div id="write" class="text-center">
<?php
view('form/message');
?>
    </div>
<?php
if ($message) {
    print '<hr><p>'.e($message['message'],false).'</p>';
    $href='/messages/'.$message['id'];
    print '<a href="'.$href.'">';
    print '<small>'.date('r', $message['created_at']).'</small></a>';
}
?>