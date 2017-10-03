<?php

include_once './config/credentials.php';
include_once './vendor/autoload.php';
require_once './php/provider.php';


$token = getToken();
if (!empty($_POST['token'])) {
    $token = $_POST['token'];
}

if (!empty($token)) {
    if (validateToken($token)) {
        setToken($token);
        redirect();
        exit("Already logged in");
    } else {
        setToken(null);
        // Invalid ID token
        exit("Invalid token");
    }
} else {
    header('Location: https://welcome.bot-chan.com');
}

function redirect() {
    header('Location: ' . getRedirectURL());
    exit();
}
