<?php

$userId = $request_array['events'][0]['source']['userId'];
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '3r2ohGof69ms4hYeSENpaK8E8fBgGV42UkS/a/gzGc88hTHOpNw5+1E3QkAD4E+ENudqYyIIepXAaPZu1pzPcA82PVd0nSyQGA/TQZcAF4BIZt6i8Nhnqp0Uvc9IzqSyg07kI82CK5yUTktOrq6f2AdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '7bde955df2a0b989334fd1dcab6c8aee';
$url_content='https://api.line.me/v2/bot/message/”.$msg_id.”/content';
$url1 = "https://api.line.me/v2/bot/profile/".$userId;
$url2='https://api.line.me/v2/bot/message/”.$msg_id.”/content';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$POST_HEADER1 = array('cache-control: no-cache', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
$userId = $request_array['events'][0]['source']['userId'];



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];
        $results = getLINEProfile($url1, $POST_HEADER1);
        $arrJson_profile = json_decode($results, true);
        $displayName=$arrJson_profile['displayName'];
        $pictureUrl=$arrJson_profile['pictureUrl'];
        
        $data = [
            'replyToken' => $reply_token,
            
            'messages' => [['type' => 'text', 'text' => json_encode($pictureUrl)]]
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
function getLINEProfile($url1,$post_header)
	{
		$ch = curl_init($url1);		
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");       
        curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result1 = curl_exec($ch);
        curl_close($ch);

    return $result1;
}
//function getimage()
//{
        
       // $headers = array(‘Authorization: Bearer ‘ . $strAccessToken);
       // $ch = curl_init($url_content);
       // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      //  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
       // $data =curl_exec($ch);
//curl_close($ch);
      //  $fp = ‘img_file/’.$msg_id.’.png’;
      //  $url_img=”http://103.40.151.6/line_bot_gts_issue/”.$fp;
      //  file_put_contents( $fp, $data );
//}
echo "200";
    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(\Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig(__DIR__.'/bottest-279517-0dc2d7773a37.json');
    $client->setAccessType('offline');
    // $client->setPrompt('select_account consent');
	
    $service = new \Google_Service_Sheets($client);

    $spreadsheetId = "1bXbuhVlI11loKILLnIFS3efGds8WMEhYqR5STpyyKxg";
echo "400";    
?>