<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
$userKey  = 'PI57V9vb8urjMnNl7KnWJ8Olw';
$userSecret = 'zcHG9xq1zUFID0fegFAlAgVATS3SddUWeiSjOuNwgPR7cU0gqu';
$access_token = '822457798055366656-gLruiG221ntfjK7JUwXxnyDpVIHAi6x';
$access_token_secret = 'egX6gK2Vao4wQhUPcG0yWwesUHyyUzIYiISqIgidmDRBP';
$connection = new TwitterOAuth($userKey, $userSecret, $access_token, $access_token_secret);


$html = '';
$lastId = 0;
if($_REQUEST['do'] == 'getTweets25'){
    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

    if(count($statuses) > 0){
        $lastId = $statuses[0]->id;
        foreach ($statuses as $key => $tweet) {
            $aDate = explode(' ',$tweet->created_at);
            $day = $aDate[2].' '.$aDate[1].' '.$aDate[5];
            $arMedia = [];
            if(count($tweet->entities->media) > 0){
                foreach ($tweet->entities->media as $k => $v) {
                    $arMedia[] = $v->media_url;
                }
            }
            $html .= '<div class="panel panel-primary">
                <div class="panel-heading">
                    <img src="'.$tweet->user->profile_image_url.'" class="user-pic"> '.$tweet->user->name.' @'.$tweet->user->screen_name.'
                    <span><i class="glyphicon glyphicon-calendar"></i> '.$day.' <i class="glyphicon glyphicon-time"></i> '.$aDate[3].'</span>
                </div>
                <div class="panel-body">
                    '.$tweet->text.'<br />';
                    foreach ($arMedia as $key => $val) {
                        $html .= '<img src="'.$val.'" class="tweet-pic" />';
                    }
                $html .= '</div>
            </div>';
        }
    }
}
if($html != '' && $lastId > 0){
    $result = array('type' => 'success', 'tweets' => $html, 'lastId' => $lastId);
} else {
    $result = array('type' => 'error');  
}
print json_encode($result);