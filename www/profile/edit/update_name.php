<?php
include_once('../../config.php');
include_once(ROOT_DIR . '/php/utils.php');
include_once(ROOT_DIR . '/php/header_util.php');
require_once(ROOT_DIR . '/php/login.php');

$url = API_BASE . "/name?sender=" . getEmail() . "&platform=SITE-CHAT&name=" . $_GET['name'];
$response = \Httpful\Request::patch($url)
    ->send();
