<?php
include_once(ROOT_DIR . '/php/httpful.phar');

use Httpful\Request;

$template = Request::init()
    ->sendsJson()
    ->expectsJson();

Request::ini($template);

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
