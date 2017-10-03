<?php
require_once 'provider.php';

function nav_bar() {
    ?>
    <br/>
    <div style="text-align: center;">
        <a href="https://chat.bot-chan.com/">Chat</a>
        <a href="https://music.bot-chan.com/">Music</a>
    </div>
    <br/>
    <br/>
    <?
}

function body_header() {
    $name = 'Unknown';
    try {
        $url = API_BASE . "/name?sender=" . getEmail() . "&platform=SITE-CHAT";
        $response = \Httpful\Request::get($url)
            ->expectsText()
            ->send();

        $new_name = $response->body;
        if ($new_name != null && $new_name != "NULL") {
            $name = $new_name;
        }
    } catch (Exception $e) {
        echo $e;
    }
    echo '<div style="text-align: center;">';
    nav_bar();
    $name = htmlspecialchars($name);
    echo 'Hello <a href="https://profile.bot-chan.com/edit">' . $name . '</a>';
    echo '</div>';
}
