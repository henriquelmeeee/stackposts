<?php

class Home
{
    public function get()
    {
        $where=[
            'ORDER'=>['created_at'=>'DESC'],
            'LIMIT'=>1,
            'id[>]'=>0
        ];
        $db=db();
        if(isset($_GET['random'])){
            $message=$db->rand('messages', '*', $where);   
        }else{
            $message=$db->select('messages', '*', $where);
        }
        $data=[
            'message'=>$message[0]
        ];
        view("home", $data);
    }
}
