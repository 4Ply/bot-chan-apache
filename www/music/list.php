<?php
include_once('../config.php');
include_once('../php/utils.php');
require_once '../php/provider.php';
require_once '../php/login.php';

try {
    $url = "https://music.bot-chan.com/api/list";
    $response = \Httpful\Request::get($url)
        ->send();
    ?>
    <table id="music-list-table" style="width:100%" class="centered bordered">

        <? foreach (array_reverse($response->body) as $message) {
            echo "<tr>
                <td>" . $message . "</td>
                <td><a class='quick-play-song' href='#' onclick='playSong(\"" . $message . "\")'>Play</a></td>
            </tr>
        ";
        } ?>
    </table>
    <?php
} catch (Exception $e) {
    echo "Failed to retrieve message history";
}
