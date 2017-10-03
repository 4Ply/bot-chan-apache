<?php
include_once('../../config.php');
include_once(ROOT_DIR . '/php/utils.php');
include_once(ROOT_DIR . '/php/header_util.php');
require_once(ROOT_DIR . '/php/login.php');

$url = API_BASE . "/nodeStatus?sender=" . getEmail() . "&platform=SITE-CHAT&node=" . $_GET['node'] . "&enabled=" . $_GET['enabled'];
$response = \Httpful\Request::patch($url)
    ->send();
