<?php

require_once __DIR__ . '/../config/credentials.php';

//date_default_timezone_set('Africa/Johannesburg');

$currentCookieParams = session_get_cookie_params();
session_set_cookie_params(
    $currentCookieParams["lifetime"],
    $currentCookieParams["path"],
    ROOT_DOMAIN
);

session_name('login_session');
session_start();


function setToken($token) {
    $_SESSION['token'] = serialize($token);
    $_COOKIE['token'] = serialize($token);
    setcookie('token', serialize($token), time() + 60 * 60 * 1000, '/', ROOT_DOMAIN);
}

function getToken() {
    $token = $_SESSION['token'];
    if (!empty($token)) {
        return unserialize($token);
    }
    return unserialize($_COOKIE['token']);
}

function setRedirectURL($url) {
    setcookie('redirect_url', $url, time() + 60 * 60 * 100, '/', ROOT_DOMAIN);
}

function getRedirectURL() {
    $redirect_url = $_COOKIE['redirect_url'];
    setRedirectURL(null);

    if (!empty($redirect_url)) {
        return $redirect_url;
    } else {
        return DEFAULT_SERVICE_URL;
    }
}

function verifyToken() {
    $idToken = getToken();
    if (empty($idToken)) {
        return false;
    }

    return validateToken($idToken);
}

function validateToken($idToken) {
    $client = new Google_Client();
    $payload = $client->verifyIdToken($idToken);
    if ($payload) {
        $userid = $payload['sub'];
        // If request specified a G Suite domain:
        //$domain = $payload['hd'];
        return true;
    }
    return false;
}

function getEmail() {
    $client = new Google_Client();
    $payload = $client->verifyIdToken(getToken());
    if ($payload) {
        $userid = $payload['sub'];

        return $userid;
        // If request specified a G Suite domain:
        //$domain = $payload['hd'];
    }
    return null;
}
