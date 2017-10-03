<?php
include_once('../config.php');
include_once('../php/utils.php');
require_once '../php/provider.php';
require_once '../php/login.php';

try {
    $url = API_BASE . "/messages";
    $response = \Httpful\Request::post($url)
        ->body('{"platform":"SITE-CHAT","matchers":[".*"]}')
        ->send();
    ?>
    <table style="width:100%" class="centered bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sender</th>
            <th>Platform</th>
            <th>message</th>
        </tr>
        </thead>

        <? foreach (array_reverse($response->body) as $message) {
            echo "<tr>
                <td class='grey-text'>" . $message->id . "</td>
                <td>" . $message->sender . "</td>
                <td>" . $message->platform . "</td>
                <td>" . $message->message . "</td>
            </tr>
        ";
        } ?>
    </table>
    <?php
} catch (Exception $e) {
    echo "Failed to retrieve message history";
}
