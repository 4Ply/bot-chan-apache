<?php
include_once('../config.php');
include_once('../php/utils.php');
require_once '../php/provider.php';
require_once '../php/login.php';

try {
    $url = API_BASE . "/autoDeleteRepliesForPlatform?clientID=" . getEmail() . "&platform=SITE-CHAT";
    $response = \Httpful\Request::post($url)
        ->body('{"platform":"SITE-CHAT","matchers":[".*"]}')
        ->send();

    foreach (array_reverse($response->body) as $reply) {
        echo $reply->message . "\n";
    }
} catch (Exception $e) {
}
