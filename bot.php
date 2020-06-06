<?php
$datas = file_get_contents('php://input');
$deCode = json_decode($datas,true);
$replyToken = $deCode['events'][0]['replyToken'];
$userId = $deCode['events'][0]['source']['userId'];
$type = $deCode['events'][0]['type'];

$token = "3r2ohGof69ms4hYeSENpaK8E8fBgGV42UkS/a/gzGc88hTHOpNw5+1E3QkAD4E+ENudqYyIIepXAaPZu1pzPcA82PVd0nSyQGA/TQZcAF4BIZt6i8Nhnqp0Uvc9IzqSyg07kI82CK5yUTktOrq6f2AdB04t89/1O/w1cDnyilFU=";

$LINEProfileDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
  $LINEProfileDatas['token'] = $token;

  $resultsLineProfile = getLINEProfile($LINEProfileDatas);

  $LINEUserProfile = json_decode($resultsLineProfile['message'],true);
  $displayName = $LINEUserProfile['displayName'];
  if ( sizeof($deCode['events']) > 0 ) {

    foreach ($deCode['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($deCode)]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
?>