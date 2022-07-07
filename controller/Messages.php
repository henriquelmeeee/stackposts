<?php

class Messages
{
    public function get()
    {
        $messageId=segment(2);
        $where=[
            'id'=>$messageId
        ];
        $message=db()->get('messages', '*', $where);
        if($message){
            $data=[
                'message'=>$message
            ];
            view('message', $data);
        }
    }
    public function post()
    {
        $message=[
            'message'=>$_POST['message'],
            'created_at'=>time()
        ];
        db()->insert('messages', $message);
        header('Location: /');
    }
}
