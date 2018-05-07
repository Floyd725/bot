<?php

$токен = '28594bfb4c2d6ba852f4dc8f8286a67311372dec3614d22cc5b65f89c17f815694ee7adf7e8fc0c8de731';

##################################################################################################################

date_default_timezone_set ('Europe/Kiev');
$time = date("H:i [d.m.y]");

$getLikes = curl('https://api.vk.com/method/photos.get?album_id=profile&rev=1&extended=1&count=1&access_token='.$токен.'&v=3.0');
$getLikesJson = json_decode($getLikes,1);
$likes = $getLikesJson['response']['0']['likes']['count'];

$Dialogs = curl('https://api.vk.com/method/messages.getDialogs?count&access_token='.$токен);
$json = json_decode($Dialogs,1);
$Dialogs = $json['response']['0'];

$messageGet = curl('https://api.vk.com/method/messages.get?access_token='.$токен);
$json = json_decode($messageGet,1);
$countM = $json['response']['0'];

$banned = curl('https://api.vk.com/method/account.getBanned?access_token='.$access_token);
$json = json_decode($banned,1);
$колво_в_чс = $json['response']['0'];

$data_file="https://yandex.ru/pogoda/$city_id.xml";
$xml = simplexml_load_file($data_file);
$wiz=$xml->fact->temperature;
$cloudiness=$xml->fact->weather_type;
if ($wiz>0) {$wiz='+'.$wiz;}

$getMessages = curl('https://api.vk.com/method/messages.get?lang=ru&v=3.0&count=1&access_token='.$access_token);
$getMessagesJson = json_decode($getMessages,1);
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />Ответ GetMessages<pre>";
print_r($getMessagesJson);
echo "</pre><hr>";
echo "Ответ GetDialogs<pre>";
print_r($getDialogsJson);
echo "</pre><hr>";
settype($userIdLastMessage, 'array');
settype($userIdLastMessage, 'array');
$userIdLastMessage = $getMessagesJson['response']['1']['uid'];
$getDataOfLastUser = curl('https://api.vk.com/method/users.get?lang=ru&v=3.0&user_ids='.$userIdLastMessage.'&name_case=gen&access_token='.$access_token);
$getDataOfLastUserJson = json_decode($getDataOfLastUser,1);
$lastUserName = $getDataOfLastUserJson['response']['0']['first_name'];
$lastUserSurname = $getDataOfLastUserJson['response']['0']['last_name'];

$status = '⌛Сейчас:'.$time.'   ⛅Погода:'.$wiz.'°C('.$cloudiness.')    💛Лайков на аве:'. $likes.'   ⛔В чс:'.$колво_в_чс.'    📝Диалогов:'.$Dialogs.'   📭Входящих:'.$countM.'   Последнее ✉ от '.$lastUserName.' '.$lastUserSurname;
$statusSet = curl('https://api.vk.com/method/status.set?text='.urlencode($status).'&v=3.0&access_token='.$токен);

######################################ФУНКЦИИ######################################
function рандом($text){
$рандом = mt_rand(0,count($text)-1); 
return $text[$рандом]; 
}
function curl( $url ){
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    $response = curl_exec( $ch );
    curl_close( $ch );
    return $response;
}//wWw.Statuses.96.LT
?><!-- Скрипт предоставил http://vk.com/Almazik2015 -->
