<?php

class Home
{
    public function get()
    {
        $where=[
            'ORDER'=>['created_at'=>'DESC']
        ];
        $message=db()->get('messages', '*', $where);
        $data=[
            'message'=>$message
        ];
        view("home", $data);
    }
}
