<?php
include_once('../../config.php');
include_once('../../php/utils.php');
require_once '../../php/provider.php';
require_once '../../php/login.php';


function list_nodes() {
    try {
        $url = API_BASE . "/nodes?sender=" . getEmail() . "&platform=SITE-CHAT";
        $response = \Httpful\Request::get($url)
            ->send();
        ?>
        <table id="music-list-table" class="centered bordered">
            <thead>
            <tr>
                <th>Node name</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            <? foreach (array_reverse($response->body) as $node) {
                $button_color = $node->enabled == true ? "light-blue" : "grey";
                $button_text = $node->enabled == true ? "ENABLED" : "DISABLED";
                $button_action = $node->enabled == true ? "false" : "true";
                echo "<tr>
                        <td>" . $node->name . "</td>
                        <td><a class='waves-effect waves-light btn " . $button_color . "' onclick='toggleNode(\"" . $node->name . "\", \"" . $button_action . "\")'>" . $button_text . "</a></td>
                    </tr>
                    ";
            } ?>
            </tbody>
        </table>
        <?php
    } catch (Exception $e) {
        echo "Failed to retrieve message history";
    }
}
