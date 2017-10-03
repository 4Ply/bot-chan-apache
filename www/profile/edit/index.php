<?php
include_once('../../config.php');
include_once(ROOT_DIR . '/php/utils.php');
include_once(ROOT_DIR . '/php/header_util.php');
require_once(ROOT_DIR . '/php/login.php');
require_once(ROOT_DIR . '/profile/edit/node_list.php');

?>
<!DOCTYPE html>
<html xmlns="">

<head>
    <meta charset="utf-8">
    <!--    <link rel="stylesheet" href="../../css/style.css">-->
    <link rel="stylesheet" href="../../css/materialize.min.css">
    <link rel="stylesheet" href="../../css/palette.css">
    <link rel="stylesheet" href="../../css/profile.css">

    <title>Bot-chan | Profile</title>
    <link rel="icon" type="image/png" href="favicon.png">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />

    <script src="../../js/jquery-3.1.1.min.js"></script>
    <script src="../../js/loadingoverlay.min.js"></script>
    <script src="../../js/loadingoverlay_progress.min.js"></script>
    <script src="../../js/progress_helper.js"></script>
    <script src="../../js/materialize.min.js"></script>
</head>

<body>

<?php
nav_bar();

$name = '';
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

?>

<div class="container">

    <h4 class="header">General Details</h4>
    <br/>
    <div class="row">
        <form onsubmit="updateName(); return false;">
            <label for="name-input" class="s4">Name</label>
            <input id="name-input" placeholder="What's your name?" value="<?php echo $name; ?>"
                   class="s4"
                   autocomplete="false">
        </form>
    </div>


    <br/>
    <h4 class="header">Nodes</h4>
    <div class="row" id="node-container">
        <?php list_nodes() ?>
    </div>
</div>

<script type="application/javascript">
    function updateName() {
        var nameInput = document.getElementById('name-input');
        if (nameInput.value === '') {
            return;
        }
        showProgress();
        $("input").blur();

        var url = "update_name.php";
        $.get(url + "?name=" + nameInput.value, function () {
            Materialize.toast('Name updated!', 3000)
        });
    }

    function toggleNode(node, enabled) {
        showProgress();
        $("input").blur();

        var url = "update_node_status.php";
        $.get(url + "?node=" + node + "&enabled=" + enabled, function () {
            Materialize.toast('Node updated!', 3000)
            window.location.reload();
        });
    }
</script>
</body>
