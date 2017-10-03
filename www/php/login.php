<?php
include_once ROOT_DIR . '/vendor/autoload.php';
require_once 'provider.php';

if (!verifyToken()) {
    setToken(null);
    // Invalid ID token
    setRedirectURL("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    header('Location: https://welcome.bot-chan.com');
    exit("Invalid token");
}
