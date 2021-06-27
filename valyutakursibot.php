<?php


$API_KEY = '1893072132:AAF0DTy3834Apb4c9E1qZRUSzplI51Ys_Sc';

define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$admin = "1682992940"; 
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$us = explode("\n", file_get_contents("us.txt"));
$reklama = file_get_contents("reklama.kho");

if ($message and !in_array($chat_id, $us)) {
    file_put_contents("us.txt", "\n".$chat_id,FILE_APPEND);
}
if ($text == '/us') {
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>count($us)
    ]);
}
if ($text == '/start') {
    mkdir('photos');
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"Assalomu aleykum siz ushbubot orqali valyutalar kursini telegram botdan chiqmasdan bilib olishingiz mumkin.
Dasturchi: @xoldorjonov_ozodjon
Rasmiy kanal: @kholdorjonov_news",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>'Bizning kanal','url'=>'t.me/kholdorjonov_news'],['text'=>'Admin','url'=>'t.me/xoldorjonov_ozodjon']],
        [['text'=>'Valyutalar kursi', 'callback_data'=>'valyuta']],
      ]
    ])
  ]);
}

if ($data == 'valyuta') {


$a = file_get_contents("https://nbu.uz/uz/exchange-rates/");
$a = explode("\n", $a);
$dollar_mb = $a[606];
$dollar_mb = str_replace("<td>", "", $dollar_mb);
$dollar_mb = str_replace("</td>", "", $dollar_mb);
 #so
$dollar_so = $a[607];
$dollar_so = str_replace("<td>", "", $dollar_so);
$dollar_so = str_replace("</td>", "", $dollar_so);
 #s
$dollar_s = $a[608];
$dollar_s = str_replace("<td>", "", $dollar_s);
$dollar_s = str_replace("</td>", "", $dollar_s);


#yevro
 #mb
$yevro_mb = $a[612];
$yevro_mb = str_replace("<td>", "", $yevro_mb);
$yevro_mb = str_replace("</td>", "", $yevro_mb);
 #so
$yevro_so = $a[613];
$yevro_so = str_replace("<td>", "", $yevro_so);
$yevro_so = str_replace("</td>", "", $yevro_so);
 #s
$yevro_s = $a[614];
$yevro_s = str_replace("<td>", "", $yevro_s);
$yevro_s = str_replace("</td>", "", $yevro_s);



#rubl
 #mb
$rubl_mb = $a[618];
$rubl_mb = str_replace("<td>", "", $rubl_mb);
$rubl_mb = str_replace("</td>", "", $rubl_mb);
 #so
$rubl_so = $a[619];
$rubl_so = str_replace("<td>", "", $rubl_so);
$rubl_so = str_replace("</td>", "", $rubl_so);
 #s
$rubl_s = $a[620];
$rubl_s = str_replace("<td>", "", $rubl_s);
$rubl_s = str_replace("</td>", "", $rubl_s);


#tenge
 #mb
$tenge_mb = $a[642];
$tenge_mb = str_replace("<td>", "", $tenge_mb);
$tenge_mb = str_replace("</td>", "", $tenge_mb);
 #so
$tenge_so = $a[643];
$tenge_so = str_replace("<td>", "", $tenge_so);
$tenge_so = str_replace("</td>", "", $tenge_so);
 #s
$tenge_s = $a[644];
$tenge_s = str_replace("<td>", "", $tenge_s);
$tenge_s = str_replace("</td>", "", $tenge_s);


#frank
 #mb
$frank_mb = $a[630];
$frank_mb = str_replace("<td>", "", $frank_mb);
$frank_mb = str_replace("</td>", "", $frank_mb);
 #so
$frank_so = $a[631];
$frank_so = str_replace("<td>", "", $frank_so);
$frank_so = str_replace("</td>", "", $frank_so);
 #s
$frank_s = $a[632];
$frank_s = str_replace("<td>", "", $frank_s);
$frank_s = str_replace("</td>", "", $frank_s); 








$sana = date("d.n.m.Y");
$soat = date("H:i:s");
    bot('sendMessage',[
        'chat_id'=>$chat_id2,

        'text'=>'Bugun'.$sana.' Soat '.$soat.'holatiga ko`ra milliy bank valyutalar kursi. { NBU.UZ }
AQSH Dollari 1USD
 MB:'.$dollar_mb.'
 Sotib olish:'.$dollar_so.'
 Sotish:'.$dollar_s.'

Euro{yevro} 1EUR
 MB:'.$yevro_mb.'
 Sotib olish:'.$yevro_so.'
 Sotish:'.$yevro_s.'

Rossiya rubli 1Rubl 
 MB:'.$rubl_mb.'
 Sotib olish:'.$rubl_so.'
 Sotish:'.$rubl_s.'

Qozog`iston tengesi 1KZT
 MB:'.$tenge_mb.'
 Sotib olish'.$tenge_so.'
 Sotish:'.$tenge_s.'

Shveytsariya franki 1CHF
 MB:'.$frank_mb.'
 Sotib olish:'.$frank_so.'
 Sotish:'.$frank_s.'

Hozirda shular yaqin 1 2 hafta ichida yana yangi funkiyalr qo`shiladi, Jumladan ushbu bot ni kanalingizga admin qilib vaqtini belgilab qo`ysangiz avtomatik har kuni kurslar haqida  tashab turadigan.

Reklama:'.$reklama,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Yangilash','callback_data'=>'valyuta']],
                [['text'=>'Kanlimizga obuna bo`lish','url'=>'t.me/kholdorjonov_news']],
                [['text'=>'Admin','url'=>'t.me/xoldorjonov_ozodjon'],['text'=>'Reklama joylashtirish','url'=>'t.me/xoldorjonov_ozodjon']],
            ]
        ])
        ]);
        bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if (mb_stripos($text, "/rek") !== false AND $chat_id == $admin) {

    $r = explode(" ", $text);
    $r = $r[1];
    file_put_contents("reklama.kho", $r);

    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"Adminjon reklama muvafaqiyatli o`zgartirildi.",
  ]);
    # code...
}
