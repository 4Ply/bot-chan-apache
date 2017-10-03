<?php
include_once('../config.php');
include_once('../php/utils.php');
require_once '../php/provider.php';
require_once '../php/login.php';

?>

    <!DOCTYPE html>
    <html xmlns="">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>Bot-chan | Chat</title>
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
<?php

if (empty($_GET['message'])) {
    exit("No message found");
}

try {
    $url = API_BASE . "/message";
    $response = \Httpful\Request::put($url)
        ->body('{"message":"' . $_GET['message'] . '","sender":"' . getEmail() . '","platform":"SITE-CHAT","direct":true}')
        ->send();

    echo "Message sent";
} catch (Exception $e) {
    echo "Failed to send message";
}
