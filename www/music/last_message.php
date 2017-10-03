<?php
include_once('../config.php');
include_once('../php/utils.php');
require_once '../php/provider.php';
require_once '../php/login.php';

$url = API_BASE . "/replies";
$response = \Httpful\Request::post($url)
    ->body('{"platform":"SITE-CHAT","matchers":[".*"]}')
    ->send();

echo array_reverse($response->body)[0]->message;
