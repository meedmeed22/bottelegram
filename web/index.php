<?php

define('API_KEY','310049340:AAFxXTn0aSt9iQRnkMoJJpWDSwF-bMqRDdM');

function Bot($method,$datas=[]){

    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    curl_setopt($ch,CURLOPT_TIMEOUT,۳۰۰۰);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{

        return json_decode($res,true);

    }
}

$update = json_decode(file_get_contents('php://input'),true);

if(isset($update['message'])){
    if(isset($update['message']['text'])){
        $text = $update['message']['text'];
        $date = $update['message']['date'];
        $message_id = $update['message']['message_id'];

        $chat_id = $update['message']['chat']['id'];
        $first_name = $update['message']['chat']['first_name'];
        $last_name = @$update['message']['chat']['last_name'];
        $username = @$update['message']['chat']['username'];

        if(isset($update['message']['forward_from'])){

            $f_id = $update['message']['forward_from']['id'];
            $f_first_name = $update['message']['forward_from']['first_name'];
            $f_last_name = $update['message']['forward_from']['last_name'];
            $f_username = $update['message']['forward_from']['username'];

         }elseif(isset($update['message']['forward_sender_name'])){
            $forward_sender_name =$update['message']['forward_sender_name'];
         }
    }
}
Bot('SendMessage',[
    'chat_id'=>$chat_id,
    'text'=>'TEST TEXT',
]);
?>
